<?php
require '../vendor/autoload.php';
require '../models/conexion.php'; // Asegúrate de que este archivo conecta correctamente a la base de datos.

// La clave secreta de tu cuenta de Stripe
\Stripe\Stripe::setApiKey('sk_test_51PW9ic04RCXZmKru1sOIVEsuSzuoUY8Pe17Eu3BDLIFqjDKg5jr71wYRBuQUHwBZrtoEYGrtDIDkJMpbkki1bu3b00miNJ9ndj');

// La clave de webhook que Stripe usa para firmar los eventos
$endpoint_secret = 'whsec_d1194914f3e2c9f31c39cded85f2c305cb6fd6fe82d59a86e42b75402a7b9b91';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

session_start();

try {
    // Verificar la firma del webhook
    $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
    error_log("Evento recibido: " . $event->type);  // Log para verificar el evento recibido
} catch (\UnexpectedValueException $e) {
    // Payload inválido
    error_log("Payload inválido: " . $e->getMessage());
    http_response_code(400);
    exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    // Firma inválida
    error_log("Firma inválida: " . $e->getMessage());
    http_response_code(400);
    exit();
}

// Manejar el evento recibido
switch ($event->type) {
    case 'checkout.session.completed':
        $session = $event->data->object;
        error_log("Evento checkout.session.completed recibido, ID de la sesión: " . $session->id);
        handleSuccessfulPayment($session);
        break;

    case 'payment_intent.payment_failed':
        $paymentIntent = $event->data->object;
        error_log("Evento payment_intent.payment_failed recibido, ID del PaymentIntent: " . $paymentIntent->id);
        handleFailedPayment($paymentIntent);
        break;

    default:
        error_log('Evento desconocido: ' . $event->type);
        echo 'Evento desconocido ' . $event->type;
}

http_response_code(200);

// Función para manejar un pago exitoso
function handleSuccessfulPayment($session) {
    // Crear una conexión a la base de datos
    $conn = Conexion::conectar();
    $conn->beginTransaction();

    try {
        $id_cliente = $session->client_reference_id;
        $monto_total = $session->amount_total / 100;  // Stripe devuelve el monto en centavos
        // Registrar los valores en el archivo de logs
        error_log("ID del cliente: " . $id_cliente);
        error_log("Monto total: " . $monto_total);

        // Insertar la nueva orden en la base de datos
        $stmt = $conn->prepare("INSERT INTO ordenes (id_cliente, total_orden, estado_orden, metodo_pago_orden) VALUES (:id_cliente, :total_orden, '1', 'stripe')");
        if (!$stmt->execute([':id_cliente' => $id_cliente, ':total_orden' => $monto_total])) {
            error_log("Error al insertar la orden: " . print_r($stmt->errorInfo(), true));
        }
        $id_orden = $conn->lastInsertId();

        // Insertar un nuevo registro en la tabla envios
        $stmt = $conn->prepare("INSERT INTO envios (id_orden) VALUES (:id_orden)");
        if (!$stmt->execute([':id_orden' => $id_orden])) {
            error_log("Error al insertar el envío: " . print_r($stmt->errorInfo(), true));
        }

        // Mover los ítems del carrito a detalles_orden
        error_log("Moviendo ítems del carrito a la tabla detalles_orden...");
        $stmt = $conn->prepare("
            INSERT INTO detalles_orden (id_orden, id_repuesto, cantidad, precio)
            SELECT :id_orden, dc.id_repuesto, dc.cantidad, r.precio_repuesto
            FROM detalles_carrito dc
            INNER JOIN carrito c ON dc.id_carrito = c.id_carrito
            INNER JOIN repuestos r ON dc.id_repuesto = r.id_repuesto
            WHERE c.id_cliente = :id_cliente
        ");
        if (!$stmt->execute([':id_orden' => $id_orden, ':id_cliente' => $id_cliente])) {
            error_log("Error al mover los ítems del carrito a detalles_orden: " . print_r($stmt->errorInfo(), true));
        }

        // Eliminar los detalles del carrito
        $stmt = $conn->prepare("
            DELETE FROM detalles_carrito WHERE id_carrito = (
                SELECT id_carrito FROM carrito WHERE id_cliente = :id_cliente
            )
        ");
        if (!$stmt->execute([':id_cliente' => $id_cliente])) {
            error_log("Error al eliminar los detalles del carrito: " . print_r($stmt->errorInfo(), true));
        }

        // Eliminar el carrito en sí
        $stmt = $conn->prepare("
            DELETE FROM carrito WHERE id_cliente = :id_cliente
        ");
        if (!$stmt->execute([':id_cliente' => $id_cliente])) {
            error_log("Error al eliminar el carrito: " . print_r($stmt->errorInfo(), true));
        }

        $_SESSION['id_orden'] = $id_orden;

        // Confirmar la transacción
        $conn->commit();
        error_log("Orden creada exitosamente. ID de la orden: " . $id_orden);

        exit;

    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        error_log("Error al procesar el pago: " . $e->getMessage());
    }
}

// Función para manejar un fallo en el pago
function handleFailedPayment($paymentIntent) {
    error_log("Pago fallido para PaymentIntent: " . $paymentIntent->id);
}
