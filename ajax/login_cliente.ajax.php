<?php

session_start();
require_once "../controllers/clientes.controller.php";
require_once "../models/clientes.model.php";

$response = ["success" => false, "error" => "", "redirect_url" => ""];

// Verificar si se han recibido los datos del formulario
if (isset($_POST["ingClienteUsuario"]) && isset($_POST["ingClientePassword"])) {
    $usuario = $_POST["ingClienteUsuario"];
    $password = $_POST["ingClientePassword"];

    // Llamar al controlador para procesar el inicio de sesión
    $loginResponse = ControladorClientes::ctrIngresoCliente($usuario, $password);

    if ($loginResponse["success"]) {
        $response["success"] = true;
        $response["redirect_url"] = $_SESSION['return_to'] ?? "home";
    } else {
        $response["error"] = $loginResponse["error"];
    }
} else {
    $response["error"] = "Datos de inicio de sesión incompletos.";
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
