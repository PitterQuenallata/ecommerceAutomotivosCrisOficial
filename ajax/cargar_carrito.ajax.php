<?php
require_once "../controllers/carrito.controller.php";

if (isset($_POST['action']) && $_POST['action'] == 'obtenerCarrito') {
    // Obtener el contenido del carrito desde el controlador
    $productosCarrito = ControladorCarrito::ctrObtenerContenidoCarrito();

    foreach ($productosCarrito as $producto) {
        // Asumiendo que $producto es un array que contiene los datos del producto
        $productId = $producto['id_repuesto'];
        $quantity = $producto['cantidad'];
        $productName = $producto['nombre_repuesto'];
        $productPrice = $producto['precio'];
        $productImage = $producto['imagen']; // Ruta de la imagen del producto

        echo '<div class="minicart__product--items d-flex" data-product-id="'.$productId.'">';
        echo '<div class="minicart__thumb">';
        echo '<a href="product-details.html"><img src="'.$productImage.'" alt="imagen del producto"></a>';
        echo '</div>';
        echo '<div class="minicart__text">';
        echo '<h4 class="minicart__subtitle"><a href="product-details.html">'.$productName.'</a></h4>';
        echo '<div class="minicart__price">';
        echo '<span class="minicart__current--price">$'.$productPrice.'</span>';
        echo '</div>';
        echo '<div class="minicart__text--footer d-flex align-items-center">';
        echo '<div class="quantity__box minicart__quantity">';
        echo '<button type="button" class="quantity__value decrease" aria-label="disminuir cantidad" value="Decrease Value">-</button>';
        echo '<label><input type="number" class="quantity__number" value="'.$quantity.'" data-counter /></label>';
        echo '<button type="button" class="quantity__value increase" aria-label="aumentar cantidad" value="Increase Value">+</button>';
        echo '</div>';
        echo '<button class="minicart__product--remove" type="button" data-product-id="'.$productId.'">Eliminar</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo json_encode(["status" => "error", "message" => "Acción no válida"]);
}
?>

