<?php
session_start();

// Capturar las rutas de la URL
$routesArray = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
foreach ($routesArray as $key => $value) {
  $routesArray[$key] = explode("?", $value)[0]; // Remueve los parámetros de la URL
}

// Inicio de HTML (head y apertura de body)
include "layouts/admin_head_top.php";

echo '<div id="wrapper">';
echo '<div id="page" class="">';

if (!isset($_SESSION["usuario"])) {
  
echo '<div class="layout-wrap">';
// Contenido del body (navbar y cualquier otro componente global)
include 'partials/preloader.php';
include "partials/admin_sidebar.php";

echo '<div class="section-content-right">';
include "partials/admin_navbar.php";

// Contenido de la página
/*=============================================
Filtro de lista blanca
=============================================*/
$pages = array(
  "home" => "pages/home/home.php"
  
);

if (!empty($routesArray[0])) {
  if (!empty($routesArray[1])) {
    include "pages/home/home.php";
  } else if (array_key_exists($routesArray[1], $pages)) {
    include $pages[$routesArray[1]];
  } else {
    include "pages/home/home.php";
  }
}




// Fin del contenido de la página
//
echo '</div>';
echo '</div>';

} else {
  include "pages/login/login.php";
}
echo '</div>';
echo '</div>';
include "layouts/admin_footer_end.php";
