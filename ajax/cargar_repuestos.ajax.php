<?php
require_once "../controllers/repuestosCards.controller.php";
require_once "../models/repuestosCards.model.php";
require_once "../controllers/filtros.controller.php";
require_once "../models/filtros.model.php";

// Capturar y validar los parámetros de la URL
$idCategoria = filter_input(INPUT_GET, 'idCategoria', FILTER_VALIDATE_INT);
$idMarca = filter_input(INPUT_GET, 'idMarca', FILTER_VALIDATE_INT);
$idModelo = filter_input(INPUT_GET, 'idModelo', FILTER_VALIDATE_INT);
$idMotor = filter_input(INPUT_GET, 'idMotor', FILTER_VALIDATE_INT);
$oemRepuesto = filter_input(INPUT_GET, 'oemRepuesto', FILTER_SANITIZE_STRING);

// Validar que al menos un filtro esté presente
if (!$idCategoria && !$idMarca && !$idModelo && !$idMotor && !$oemRepuesto) {
    echo "<div class='col-12 text-center'>Seleccione algún Filtro</div>";
    return;
}

// Obtener los repuestos filtrados
$repuestos = ControladorFiltros::ctrObtenerRepuestosPorFiltros($idCategoria, $idMarca, $idModelo, $idMotor, $oemRepuesto);

// Si no se encuentran repuestos, mostrar un mensaje
if (empty($repuestos)) {
    echo "<div class='col-12 text-center'>No se encontraron repuestos</div>";
    return;
}

// Generar el HTML de los repuestos filtrados
foreach ($repuestos as $repuesto) {
    echo "<div class='col-lg-3 col-md-4 col-sm-6 col-6 mb-30' data-product-id='{$repuesto['id_repuesto']}'>";
    echo "<article class='product__card' data-stock-repuesto='{$repuesto['stock_repuesto']}' data-descripcion-repuesto='{$repuesto['descripcion_repuesto']}' data-marca-repuesto='{$repuesto['fabricante_repuesto']}'>";
    echo "<div class='product__card--thumbnail'>";
    echo "<a class='product__card--thumbnail__link display-block' href='product-details?idRepuesto={$repuesto['id_repuesto']}'>";
    echo "<img class='product__card--thumbnail__img product__primary--img' src='{$repuesto['img_repuesto']}' alt='Imagen del producto'>";
    echo "<img class='product__card--thumbnail__img product__secondary--img' src='{$repuesto['img_repuesto']}' alt='Imagen del producto'>";
    echo "</a>";
    echo "<ul class='product__card--action d-flex align-items-center justify-content-center'>";
    echo "<li class='product__card--action__list'>";
    echo "<a class='product__card--action__btn view-details-btn' title='Vista Rápida' data-open='modal1' href='javascript:void(0)' data-id-repuesto-vista='{$repuesto['id_repuesto']}'>";
    echo "<i class='fas fa-search'></i>";
    echo "<span class='visually-hidden'>Vista Rápida</span>";
    echo "</a>";
    echo "</li>";
    echo "<li class='product__card--action__list'>";
    echo "<a class='product__card--action__btn' title='Lista de Deseos' href='wishlist' data-id-repuesto-wishlist='{$repuesto['id_repuesto']}'>";
    echo "<i class='fas fa-heart'></i>";
    echo "<span class='visually-hidden'>Lista de Deseos</span>";
    echo "</a>";
    echo "</li>";
    echo "</ul>";
    echo "</div>";
    echo "<div class='product__card--content'>";
    echo "<h3 class='product__card--title'><a href='product-details.html'>{$repuesto['nombre_repuesto']}</a></h3>";
    echo "<div class='product__card--price'>";
    echo "<span class='current__price'>BS {$repuesto['precio_repuesto']}</span>";
    echo "<span class='old__price'>BS {$repuesto['precio_repuesto']}</span>";
    echo "</div>";
    echo "<div class='product__card--footer d-flex justify-content-between align-items-center'>";
    echo "<a class='product__card--btn primary__btn d-flex justify-content-center align-items-center w-75 text-center me-1' href='carritoPage' data-id-repuesto-comprar='{$repuesto['id_repuesto']}'>Comprar</a>";
    echo "<a class='product__card--btn primary__btn d-flex justify-content-center align-items-center w-25 text-center ms-1 minicart__open--btn add-to-cart-button add-to-cart-btn' href='javascript:void(0)' data-id-repuesto-add='{$repuesto['id_repuesto']}'>";
    echo "<i class='fas fa-shopping-cart' style='font-size: 1.2em;'></i>";
    echo "</a>";
    echo "</div>";
    echo "</div>";
    echo "</article>";
    echo "</div>";
}
?>
