<?php
// Incluir los controladores y modelos necesarios
require_once "../controllers/carrito.controller.php";
require_once "../models/carrito.model.php";

// Verificar que la solicitud sea POST y que se haya enviado el ID del producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idProducto'])) {
        $idProducto = $_POST['idProducto'];

        // Aquí puedes agregar la lógica para añadir el producto al carrito
        // Por ejemplo, podrías llamar a un método en el controlador para manejar esto:
        $resultado = CarritoController::agregarProductoAlCarrito($idProducto);

        // Si el resultado es exitoso, enviar una respuesta JSON
        if ($resultado['status'] === 'success') {
            echo json_encode([
                'status' => 'success',
                'message' => 'Producto añadido al carrito',
                'product_id' => $idProducto
            ]);
        } else {
            // En caso de error, devolver un mensaje de error
            echo json_encode([
                'status' => 'error',
                'message' => 'No se pudo añadir el producto al carrito'
            ]);
        }
    } else {
        // Si no se envió el ID del producto, devolver un error
        echo json_encode([
            'status' => 'error',
            'message' => 'ID del producto no especificado'
        ]);
    }
} else {
    // Si no es una solicitud POST, devolver un error
    echo json_encode([
        'status' => 'error',
        'message' => 'Método de solicitud no permitido'
    ]);
}
