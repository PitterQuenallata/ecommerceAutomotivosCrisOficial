<?php
session_start();
require_once "public/assets/shop/funciones_generales.php";
// Capturar las rutas de la URL
$routesArray = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
foreach ($routesArray as $key => $value) {
  $routesArray[$key] = explode("?", $value)[0]; // Remueve los parámetros de la URL
}

// Inicio de HTML (head y apertura de body)
include "views/layouts/shop_head_top.php";

include "views/partials/shop_preloader.php";
// Contenido del body (navbar y cualquier otro componente global)
include "views/partials/shop_navbar.php";
include "views/shop/modals/carrito.php";
/*=============================================
Filtro de lista blanca
=============================================*/
if (empty($routesArray[0])) {
  // Si la ruta está vacía, cargar la página de inicio
  include "views/shop/home/home.php";
} elseif (
  $routesArray[0] == "home" ||
  $routesArray[0] == "categorias" ||
  $routesArray[0] == "repuestos" ||
  $routesArray[0] == "cart" ||
  $routesArray[0] == "profile" ||
  $routesArray[0] == "wishlist"
) {

  include "views/shop/" . $routesArray[0] . "/" . $routesArray[0] . ".php";
} elseif ($routesArray[0] == "checkout") {

  // Verificar si el cliente ha iniciado sesión
  if (isset($_SESSION["id_cliente"])) {
    include "views/shop/checkout/checkout.php";
  } else {
    // Redirigir a la página de login si el usuario no ha iniciado sesión
    header("Location: " . BASE_URL . "login");
    exit();
  }
} else {
  // Página 404 si no se encuentra la ruta
  include "views/shop/404/404.php";
}

include "views/shop/modals/ver_repuesto.php";

// Footer y cierre del HTML (incluye scripts al final)
include "views/partials/shop_footer.php";
include "views/layouts/shop_footer_end.php";
