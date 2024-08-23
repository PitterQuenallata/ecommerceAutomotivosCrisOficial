<?php

session_start();
require_once "../controllers/carrito.controller.php";
require_once "../models/carrito.model.php";
require_once "../models/repuestos.model.php";
// Asegúrate de tener un modelo para manejar los repuestos
if (isset($_SESSION['id_cliente'])) {
    $response = ["success" => true, "alerts" => [], "error" => "", "clearLocalStorage" => true];

    if (isset($_POST["carrito_local"])) {

        $carrito_local = json_decode($_POST["carrito_local"], true);
        //print_r($carrito_local);
        $id_cliente = $_SESSION['id_cliente']; // Asumiendo que el ID del cliente está en la sesión
        //print_r($id_cliente);
        // Sincronizar el carrito
        $syncResponse = ControladorCarrito::ctrSincronizarCarrito($carrito_local, $id_cliente);
        // echo '<pre>';
        // print_r($syncResponse);
        // echo '</pre>';
        if (!$syncResponse["success"]) {
            $response["success"] = false;
            $response["error"] = $syncResponse["error"];
            $response["clearLocalStorage"] = false;
        } else {
            if (isset($syncResponse["alerts"]) && !empty($syncResponse["alerts"])) {
                $response["alerts"] = $syncResponse["alerts"];
                $response["clearLocalStorage"] = true;
            }
        }
    } else {
        $response["success"] = false;
        $response["error"] = "No se recibió ningún carrito para sincronizar.";
        $response["clearLocalStorage"] = false;
    }
} else {
    // Respuesta en caso de sesión no válida
    $response["success"] = false;
    $response["error"] = "noSession";
    $response["clearLocalStorage"] = false;

}

echo json_encode($response);
