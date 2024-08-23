<?php
//deputar errores
ini_set("display_errors", 1);
ini_set("log-errors", 1);
ini_set("error-log", "C:/xampp/htdocs/ecommerceAutomotivosCris/php_error.log");

define('BASE_URL', ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http") . "://".$_SERVER['HTTP_HOST']."/");
define('BASE_URL_ADMIN', BASE_URL . 'admin/');
/*=============================================
Require
=============================================*/


require_once "controllers/categorias.controller.php";
require_once "controllers/repuestosCards.controller.php";
require_once "controllers/filtros.controller.php";
require_once "controllers/clientes.controller.php";
require_once "controllers/carrito.controller.php";
require_once "controllers/carrito.session.controller.php";
require_once "controllers/repuestos.controller.php";


require_once "models/categorias.model.php";
require_once "models/repuestosCards.model.php";
require_once "models/filtros.model.php";
require_once "models/clientes.model.php";
require_once "models/carrito.model.php";
require_once "models/carrito.session.model.php";
require_once "models/repuestos.model.php";


// Capturar las rutas de la URL
$routesArray = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
foreach ($routesArray as $key => $value) {
    $routesArray[$key] = explode("?", $value)[0]; // Remueve los parámetros de la URL
}

$pages = array("admin/login");

if (isset($routesArray[0]) && in_array($routesArray[0], $pages)) {
    // Login de Administrador
    if ($routesArray[0] == "admin/login") {
        include "views/admin/login.php";
    }
} else {
    // Rutas para clientes
    include "public/template_cliente.php";
}
