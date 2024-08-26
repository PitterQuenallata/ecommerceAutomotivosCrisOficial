<?php
require_once "../controllers/ordenes.controller.php";
require_once "../models/ordenes.model.php";

if (isset($_POST['idOrden']) && isset($_POST['idCliente'])) {
    $id_orden = $_POST['idOrden'];
    $id_cliente = $_POST['idCliente'];

    // Llamar al controlador para obtener los detalles de la orden
    $detalleOrden = ControladorOrdenes::ctrMostrarDetalleOrden($id_cliente, $id_orden);

    // Devolver la respuesta en formato JSON
    echo json_encode($detalleOrden);
} else {
    echo json_encode(array("error" => "Faltan parámetros en la solicitud."));
}
?>
