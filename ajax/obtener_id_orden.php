<?php
require_once '../models/ordenes.model.php';

if (isset($_GET['idCliente'])) {
    $idCliente = (int)$_GET['idCliente'];
    $idOrden = ModeloOrdenes::mdlObtenerUltimaOrdenPorCliente($idCliente);

    if ($idOrden) {
        echo json_encode(['success' => true, 'idOrden' => $idOrden]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>