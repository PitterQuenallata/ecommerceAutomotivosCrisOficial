<?php
session_start();
require_once "../controllers/carrito.controller.php";
require_once "../models/carrito.model.php";

if (isset($_SESSION['id_cliente'])) {
// Obtener el carrito desde el controlador esto para que se actualice el carrito en la base de datos solo traer
$carrito = ControladorCarrito::ctrObtenerCarrito();

}else{

  $carrito["error"] = "noSession";
}



// Devolver los datos en formato JSON
echo json_encode($carrito);
?>
