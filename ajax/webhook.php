<?php
require '../vendor/autoload.php';
require '../models/conexion.php';

\Stripe\Stripe::setApiKey('sk_test_51PW9ic04RCXZmKru1sOIVEsuSzuoUY8Pe17Eu3BDLIFqjDKg5jr71wYRBuQUHwBZrtoEYGrtDIDkJMpbkki1bu3b00miNJ9ndj');

$endpoint_secret = 'whsec_d1194914f3e2c9f31c39cded85f2c305cb6fd6fe82d59a86e42b75402a7b9b91'; // Reemplaza con tu secreto de webhook

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
} catch(\UnexpectedValueException $e) {
    http_response_code(400);
    exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
    http_response_code(400);
    exit();
}

switch ($event->type) {
    case 'checkout.session.completed':
        $session = $event->data->object;
        handleSuccessfulPayment($session);

        break;

    case 'payment_intent.payment_failed':
        $paymentIntent = $event->data->object;
        handleFailedPayment($paymentIntent);
        break;

    default:
        echo 'Evento desconocido ' . $event->type;
}

http_response_code(200);

function handleSuccessfulPayment($session) {

  

  // Crear una conexión a la base de datos
  $conn = Conexion::conectar();  // Usar la clase Conexion para conectarse a la base de datos
  $conn->beginTransaction();

  try {
      $id_cliente = $session->client_reference_id;
      $monto_total = $session->amount_total / 100;  // Stripe devuelve el monto en centavos

      // Insertar la nueva orden en la base de datos
      $stmt = $conn->prepare("INSERT INTO ordenes (id_cliente, total_orden, estado_orden) VALUES (:id_cliente, :total_orden, 'Pagada')");
      $stmt->execute([':id_cliente' => $id_cliente, ':total_orden' => $monto_total]);
      $id_orden = $conn->lastInsertId();

      // Mover los ítems del carrito a detalles_orden
      $stmt = $conn->prepare("
          INSERT INTO detalles_orden (id_orden, id_repuesto, cantidad, precio)
          SELECT :id_orden, dc.id_repuesto, dc.cantidad, r.precio_repuesto
          FROM detalles_carrito dc
          INNER JOIN carrito c ON dc.id_carrito = c.id_carrito
          INNER JOIN repuestos r ON dc.id_repuesto = r.id_repuesto
          WHERE c.id_cliente = :id_cliente
      ");
      $stmt->execute([':id_orden' => $id_orden, ':id_cliente' => $id_cliente]);

      
        // Eliminar los detalles del carrito
        $stmt = $conn->prepare("
            DELETE FROM detalles_carrito WHERE id_carrito = (
                SELECT id_carrito FROM carrito WHERE id_cliente = :id_cliente
            )
        ");
        $stmt->execute([':id_cliente' => $id_cliente]);

        // Eliminar el carrito en sí
        $stmt = $conn->prepare("
            DELETE FROM carrito WHERE id_cliente = :id_cliente
        ");
      $stmt->execute([':id_cliente' => $id_cliente]);


      // Confirmar la transacción
      $conn->commit();
      
  } catch (Exception $e) {
      // Revertir la transacción en caso de error
      $conn->rollback();
      error_log("Error al procesar el pago: " . $e->getMessage());
  }
}


function handleFailedPayment($paymentIntent) {
    // Aquí puedes manejar el fallo en el pago, por ejemplo, notificando al cliente o registrando el error
    $id_cliente = $paymentIntent->metadata->client_reference_id;
    // Realizar cualquier acción de limpieza si es necesario
}