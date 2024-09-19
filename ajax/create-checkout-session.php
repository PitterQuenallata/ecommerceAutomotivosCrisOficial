<?php
require '../vendor/autoload.php';

session_start();

\Stripe\Stripe::setApiKey('sk_test_51PW9ic04RCXZmKru1sOIVEsuSzuoUY8Pe17Eu3BDLIFqjDKg5jr71wYRBuQUHwBZrtoEYGrtDIDkJMpbkki1bu3b00miNJ9ndj');

// Recibir los datos del carrito desde el frontend
$carrito = $_POST['carrito'];
$id_cliente = $_SESSION['id_cliente']; // Recuperar idCliente de la sesión

// Verificar si el ID del cliente está presente en la sesión
if (!$id_cliente) {
    error_log("ID del cliente no encontrado en la sesión.");
    exit("Error: ID del cliente no encontrado.");
} else {
    error_log("ID del cliente: " . $id_cliente);
}

// Verificar si el carrito tiene ítems
if (empty($carrito)) {
    error_log("El carrito está vacío o no se recibieron datos.");
    exit("Error: El carrito está vacío.");
} else {
    error_log("Carrito recibido: " . print_r($carrito, true));
}

// Inicializa el monto total a cero
$montoTotal = 0;

$line_items = [];
foreach ($carrito as $item) {
    $montoTotal += $item['precio'] * $item['cantidad'];

    $line_items[] = [
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => $item['nombre'],
            ],
            'unit_amount' => $item['precio'] * 100, // Stripe maneja montos en centavos
        ],
        'quantity' => $item['cantidad'],
    ];
}

error_log("Monto total calculado para Stripe: " . $montoTotal);

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $line_items,
        'mode' => 'payment',
        'success_url' => 'http://cris.local/profile/success?session_id={CHECKOUT_SESSION_ID}&idCliente=' . $id_cliente,
        'client_reference_id' => $_SESSION['id_cliente'], 
        'metadata' => [
            'order_id' => uniqid(), 
        ]
    ]);

    error_log('Session ID: ' . $checkout_session->id);

    echo json_encode(['id' => $checkout_session->id]);

} catch (Exception $e) {
    error_log('Error al crear la sesión de Stripe: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
