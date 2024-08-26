<?php
require '../vendor/autoload.php';

session_start();

\Stripe\Stripe::setApiKey('sk_test_51PW9ic04RCXZmKru1sOIVEsuSzuoUY8Pe17Eu3BDLIFqjDKg5jr71wYRBuQUHwBZrtoEYGrtDIDkJMpbkki1bu3b00miNJ9ndj');

// Recibir los datos del carrito desde el frontend
$carrito = $_POST['carrito'];
$id_cliente = $_SESSION['id_cliente']; // Recuperar idCliente de la sesión

// Inicializa el monto total a cero
$montoTotal = 0;

// Arreglo para los ítems de Stripe Checkout
$line_items = [];

foreach ($carrito as $item) {
    // Calcula el monto total
    $montoTotal += $item['precio'] * $item['cantidad'];

    // Añade el ítem al arreglo de line_items de Stripe
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

try {
    // Crear la sesión de Stripe Checkout
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $line_items,
        'mode' => 'payment',
        'success_url' => 'http://cris.local/profile/success?session_id={CHECKOUT_SESSION_ID}&idCliente=' . $id_cliente, // Agregar idCliente a la URL
        'client_reference_id' => $_SESSION['id_cliente'], // Envía el ID del cliente como referencia
        'metadata' => [
            'order_id' => uniqid(), // ID único de la orden
        ]
    ]);

    // Verificar que se está generando el sessionId
    error_log('Session ID: ' . $checkout_session->id);

    echo json_encode(['id' => $checkout_session->id]);

} catch (Exception $e) {
    error_log('Error al crear la sesión de Stripe: ' . $e->getMessage()); // Log del error
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
