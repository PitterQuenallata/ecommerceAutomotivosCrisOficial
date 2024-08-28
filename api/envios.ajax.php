<?php
session_start();
require_once 'ApiController.php';
require_once '../models/ordenes.model.php';

$api = new ApiController();

// Capturar los datos enviados por el método POST
$envioData = json_decode($_POST['envioData'], true);
$idOrden = $_POST['idOrden'] ?? "";

// Asegurarse de que ambos datos están presentes
if ($envioData && $idOrden) {
    // Preparar los datos para enviar a la API
    $data = [
        'cedula_remitente' => $envioData['ciEnvio'],
        'nombre_remitente' => $envioData['nombreEnvio'] . ' ' . $envioData['apellidoEnvio'],
        'telefono_remitente' => $envioData['celularEnvio'],
        'direccion_remitente' => $envioData['direccionEnvio'],
        'sucursalPartida' => 1,  // Valor fijo
        'sucursalLlegada' => $envioData['sucursalLlegada'],
        'tipoEnvio' => 1,  // Valor predeterminado para tipo de envío
        'descripcion' => $envioData['descripcion'],
        'cantidad' => $envioData['cantidad'],
        'pesoPaquete' => $envioData['pesoPaquete'],
        'tipoPaquete' => $envioData['tipoPaquete']
    ];

    // Enviar los datos a la API usando el controlador
    $response = $api->postEnvio($data);

    // Verificar la respuesta de la API
    if (isset($response['nro_registro'])) {
        // Guardar el nro_registro en la base de datos con el idOrden
        $resultado = ModeloOrdenes::mdlGuardarNroRegistro($idOrden, $response['nro_registro']);

        if ($resultado) {
            echo json_encode([
                'success' => true,
                'nro_registro' => $response['nro_registro'],
                'message' => 'Número de registro guardado correctamente'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al guardar el número de registro en la base de datos'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al obtener el número de registro de la API'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Datos insuficientes para procesar el envío'
    ]);
}
