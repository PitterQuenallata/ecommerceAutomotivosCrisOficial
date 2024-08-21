<?php

session_start();
require_once "../controllers/carrito.controller.php";
require_once "../models/carrito.model.php";
require_once "../models/repuestos.model.php"; // Asegúrate de tener un modelo para manejar los repuestos

$response = ["success" => true, "alerts" => [], "error" => ""];

if (isset($_POST["carrito_local"])) {
    $carrito_local = json_decode($_POST["carrito_local"], true);
    $id_cliente = $_SESSION['id_usuario']; // Asumiendo que el ID del cliente está en la sesión

    // Sincronizar el carrito
    $syncResponse = ControladorCarrito::ctrSincronizarCarrito($carrito_local, $id_cliente);

    if (!$syncResponse["success"]) {
        $response["success"] = false;
        $response["error"] = $syncResponse["error"];
    } else {
        if (isset($syncResponse["alerts"]) && !empty($syncResponse["alerts"])) {
            $response["alerts"] = $syncResponse["alerts"];
        }
    }
} else {
    $response["success"] = false;
    $response["error"] = "No se recibió ningún carrito para sincronizar.";
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
