<?php

require_once "../controllers/carrito.controller.php";

if (isset($_POST['action'])) {
  $action = $_POST['action'];

  switch ($action) {
    case 'agregarProducto':
      if (isset($_POST['idRepuesto']) && isset($_POST['cantidad'])) {
        ControladorCarrito::ctrAgregarProducto($_POST['idRepuesto'], $_POST['cantidad']);
      } else {
        echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
      }
      break;

    case 'obtenerCarrito':
      ControladorCarrito::ctrObtenerCarrito();
      break;

    case 'actualizarCantidad':
      ControladorCarrito::ctrActualizarCantidad();
      break;

    case 'eliminarProducto':
      ControladorCarrito::ctrEliminarProducto();
      break;

    case 'vaciarCarrito':
      ControladorCarrito::ctrVaciarCarrito();
      break;

    default:
      echo json_encode(["status" => "error", "message" => "Acción no válida"]);
      break;
  }
} else {
  echo json_encode(["status" => "error", "message" => "No se recibió ninguna acción"]);
}
