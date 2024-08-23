<?php
require '../vendor/autoload.php';
session_start();

\Stripe\Stripe::setApiKey('sk_test_51PW9ic04RCXZmKru1sOIVEsuSzuoUY8Pe17Eu3BDLIFqjDKg5jr71wYRBuQUHwBZrtoEYGrtDIDkJMpbkki1bu3b00miNJ9ndj'); // Tu clave secreta de Stripe
// Recibir los datos del carrito desde el frontend
// Recibir los datos del carrito desde el frontend
$carrito = $_POST['carrito'];

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
        'success_url' => 'http://cris.local/success', // URL de redirección en caso de éxito
        'cancel_url' => 'http://cris.local/cancel',
        'client_reference_id' => $_SESSION['id_cliente'], // Puedes enviar el ID del cliente como referencia
        'metadata' => [
            'order_id' => uniqid(), // Por ejemplo, puedes generar un ID de orden único
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