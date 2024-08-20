<?php
require_once "../controllers/repuestosCards.controller.php";
require_once "../models/repuestosCards.model.php";

// Validar y sanitizar el parámetro GET 'idRepuesto'
$idRepuesto = filter_input(INPUT_GET, 'idRepuesto', FILTER_VALIDATE_INT);

if ($idRepuesto) {
    // Llama al controlador para obtener los detalles del repuesto
    $repuesto = ControladorRepuestosCards::ctrMostrarRepuestoPorId($idRepuesto);
    //echo json_encode($repuesto);

    if ($repuesto) {
        // Preparar los datos a devolver en formato JSON
        $response = [
            'id' => $repuesto['id_repuesto'],
            'nombre' => $repuesto['nombre_repuesto'],
            'precio_actual' => $repuesto['precio_repuesto'],
            'precio_anterior' => $repuesto['precio_repuesto'] * 1.5, // Precio anterior ficticio
            'descripcion' => $repuesto['descripcion_repuesto'],
            'marca' => $repuesto['fabricante_repuesto'], // Cambiado a 'fabricante_repuesto' según la nueva estructura
            'imagen' => $repuesto['img_repuesto'],
            'stock' => $repuesto['stock_repuesto']
        ];

        // Devolver los detalles del repuesto en formato JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Si no se encuentra el repuesto, devolver un error
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Repuesto no encontrado']);
    }
} else {
    // Si no se pasa un id_repuesto válido, devolver un error
    header('Content-Type: application/json');
    echo json_encode(['error' => 'ID de repuesto no válido']);
}
