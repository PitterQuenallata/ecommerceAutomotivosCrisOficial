<?php
session_start();
require_once '../api/ApiController.php'; // Asegúrate de ajustar la ruta según tu estructura de archivos

// Verifica que la solicitud es POST
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $usuario = $_SESSION['cliente'];

  // Captura los datos enviados por AJAX
  $nombreEnvio = $_POST['nombreEnvio'];
  $apellidoEnvio = $_POST['apellidoEnvio'];
  $ciEnvio = $_POST['ciEnvio'];
  $celularEnvio = $_POST['celularEnvio'];
  $departamento = $_POST['departamento'];
  $sucursal = $_POST['sucursal'];

  // Preparar los datos para enviar a la API en formato JSON
  $dataEnvio = [
      "cedula_remitente" => $ciEnvio,
      "nombre_remitente" => $nombreEnvio . ' ' . $apellidoEnvio,
      "telefono_remitente" => $celularEnvio,
      "direccion_remitente" => "santa", // Cambia esto según sea necesario
      "sucursalPartida" => $departamento,
      "sucursalLlegada" => $sucursal,
      "tipoEnvio" => "Normal",  // Cambia esto según sea necesario
      "descripcion" => "Repuesto",  // Cambia esto según sea necesario
      "cantidad" => 1,  // Cambia esto según sea necesario
      "precio" => 10.00,  // Cambia esto según sea necesario
      "tipoPaquete" => "caja"  // Cambia esto según sea necesario
  ];

  // Crear el objeto de la API
  $api = new ApiController();

  // Enviar los datos a la API
  $response = $api->postEnvio($dataEnvio);
    print_r($response);
    echo "hola";
    // Verificar la respuesta y retornar un JSON
    // if ($response  == 'true') {
    //     echo json_encode(['status' => 'success', 'message' => 'Envío procesado exitosamente']);
    // } else {
    //     echo json_encode(['status' => 'error', 'message' => 'Error al procesar el envío']);
    // }
// } else {
//     // Si no es una solicitud POST, retornar un error
//     echo json_encode(['status' => 'error', 'message' => 'Solicitud inválida']);
// }
?>
