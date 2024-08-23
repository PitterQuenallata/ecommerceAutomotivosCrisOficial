<?php
session_start();
require_once "../controllers/carrito.session.controller.php";
require_once "../models/carrito.session.model.php";
require_once "../models/repuestos.model.php";

// Verificar si la sesión está presente
$response = ["success" => true, "error" => "","alerts" => ""];
if (isset($_SESSION['id_cliente'])) {
    $id_cliente = $_SESSION['id_cliente'];

    // Verificar la acción solicitada
    if (isset($_POST['action']) && $_POST['action'] == 'vaciar') {
        // Acción: Vaciar el carrito
        $response = ControladorCarritoSesion::ctrVaciarCarrito($id_cliente);
        $response = ["success" => true, "error" => "","alerts" => "Carrito vaciado."];
    } elseif (isset($_POST['id_repuesto']) && isset($_POST['cantidad'])) {
        $id_repuesto = $_POST['id_repuesto'];
        $cantidad = $_POST['cantidad'];

        // Determinar si se agrega/actualiza o se elimina un ítem
        if ($cantidad > 0) {
            $response = ControladorCarritoSesion::ctrAgregarAlCarrito($id_cliente, $id_repuesto, $cantidad);
            $response = ["success" => true, "error" => "","alerts" => "Repuesto actualizado en el carrito."];
        } else {
            $response = ControladorCarritoSesion::ctrEliminarItemCarrito($id_cliente, $id_repuesto);
            $response = ["success" => true, "error" => "","alerts" => "Repuesto eliminado del carrito."];
        }
    } else {
        // Respuesta en caso de datos incompletos o sesión no válida
        $response = ["success" => false, "error" => "Datos incompletos o sesión no válida."];
    }

    // Enviar la respuesta de éxito o error
    echo json_encode($response);
} else {
    // Respuesta en caso de sesión no válida
    echo json_encode(["success" => false, "error" => "noSession"]);
}
