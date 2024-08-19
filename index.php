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
// require_once "models/conexion.php";
// require_once "controllers/template.controller.php";

// require_once "controllers/marcas.controller.php";
// require_once "controllers/modelos.controller.php";
// require_once "controllers/motores.controller.php";
require_once "controllers/categorias.controller.php";
require_once "controllers/repuestosCards.controller.php";
require_once "controllers/filtros.controller.php";
// require_once "controllers/recambios.controller.php";
// require_once "controllers/repuestosCards.controller.php";
// require_once "controllers/clientes.controller.php";
require_once "controllers/carrito.controller.php";

// require_once "models/marcas.model.php";
// require_once "models/modelos.model.php";
// require_once "models/motores.model.php";
require_once "models/categorias.model.php";
require_once "models/repuestosCards.model.php";
require_once "models/filtros.model.php";
// require_once "models/recambios.model.php";
// require_once "models/repuestosCards.model.php";
// require_once "models/clientes.model.php";
require_once "models/carrito.model.php";


// Capturar las rutas de la URL
$routesArray = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
foreach ($routesArray as $key => $value) {
    $routesArray[$key] = explode("?", $value)[0]; // Remueve los parámetros de la URL
}

// Lista blanca de rutas
$pages = array(
    "home","categorias","repuestos","profile","wishlist","contactos","about","privacy-policy","cart","product-details"
);

// Verificación de permisos y rutas
if (isset($routesArray[0]) && in_array($routesArray[0], $pages)) {
    
    // Rutas para el administrador
    if ($routesArray[0] == "admin" || $routesArray[0] == "dashboard") {
        if (!isset($_SESSION['admin'])) {
            header("Location: " . BASE_URL . "admin/login");
            exit();
        }
        include "public/template_admin.php";
    
    // Rutas para el lado del cliente
    } else {
        include "public/template_cliente.php";
    }

} else {
    // Página 404 si no se encuentra la ruta
    include "public/template_cliente.php";
}