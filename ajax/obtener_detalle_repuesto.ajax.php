<?php
require_once "../controllers/repuestosCards.controller.php";
require_once "../models/repuestosCards.model.php";

if (isset($_GET['idRepuesto'])) {
    $idRepuesto = $_GET['idRepuesto'];

    
    // Llama al controlador para obtener los detalles del repuesto
    $repuesto = ControladorRepuestosCards::ctrMostrarRepuestoPorId($idRepuesto);

    if ($repuesto) {
        // Devolver los detalles del repuesto en formato JSON
        echo json_encode([
            'id' => $repuesto['id_repuesto'],
            'nombre' => $repuesto['nombre_repuesto'],
            'precio_actual' => $repuesto['precio_repuesto'],
            'precio_anterior' => $repuesto['precio_repuesto']*1.5,
            'descripcion' => $repuesto['descripcion_repuesto'],
            'marca' => $repuesto['marca_repuesto'],
            'imagen' => $repuesto['img_repuesto'],
            'stock' => $repuesto['stock_repuesto']
        ]);
    } else {
        // Si no se encuentra el repuesto, devolver un error
        echo json_encode(['error' => 'Repuesto no encontrado']);
    }
} else {
    // Si no se pasa un id_repuesto, devolver un error
    echo json_encode(['error' => 'No se ha proporcionado un ID de repuesto']);
}
?>
