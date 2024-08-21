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
$pages = array(
  "home" => "home/home.php",
  "contactos" => "contactos/contactos.php",
  "categorias" => "categorias/categorias.php",
  "repuestos" => "repuestos/repuestos.php",
  "profile" => "profile/profile.php",
  "wishlist" => "wishlist/wishlist.php",
  "about" => "about/about.php",
  "privacy-policy" => "privacy-policy/privacy-policy.php",
  "cart" => "cart/cart.php",
  "product-details" => "product-details/product-details.php",
  "checkout" => "checkout/checkout.php",
  "login" => "login/login.php"
);

if (empty($routesArray[0])) {
  include "views/shop/home/home.php";
} elseif (array_key_exists($routesArray[0], $pages)) {
  if ($routesArray[0] == "checkout" && !isset($_SESSION["cliente"])) {
      $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
      //include "views/shop/login/login.php";
      echo '<script>
              window.location = "login";
            </script>';
      //header("Location: " . BASE_URL . "login");
      
  } else {
      include "views/shop/" . $pages[$routesArray[0]];
  }
} else {
  include "views/shop/404/404.php";
}


include "views/shop/modals/ver_repuesto.php";

// Footer y cierre del HTML (incluye scripts al final)
include "views/partials/shop_footer.php";
include "views/layouts/shop_footer_end.php";
