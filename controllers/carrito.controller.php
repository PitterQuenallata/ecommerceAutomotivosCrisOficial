<?php
class ControladorCarrito
{

    public static function ctrObtenerContenidoCarrito() {
        // Verificar si el carrito existe en la sesión
        if (isset($_SESSION['carrito'])) {
            // Devolver el contenido del carrito almacenado en la sesión
            return $_SESSION['carrito'];
        } else {
            // Si el carrito no existe, devolver un array vacío
            return [];
        }
    }
    
    // Método para agregar un producto al carrito
    public static function ctrAgregarProducto()
    {
        if (isset($_POST['idRepuesto']) && isset($_POST['cantidad'])) {
            $idUsuario = $_SESSION['id_usuario']; // Asumiendo que el ID del usuario está almacenado en la sesión
            $idRepuesto = $_POST['idRepuesto'];
            $cantidad = $_POST['cantidad'];

            $respuesta = ModeloCarrito::mdlAgregarProducto($idUsuario, $idRepuesto, $cantidad);

            if ($respuesta == "ok") {
                echo json_encode(["status" => "success", "message" => "Producto añadido al carrito"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al añadir el producto al carrito"]);
            }
        }
    }

    // Método para obtener los productos en el carrito de un usuario
    public static function ctrObtenerCarrito()
    {
        if (isset($_SESSION['id_usuario'])) {
            $idUsuario = $_SESSION['id_usuario'];
            $productos = ModeloCarrito::mdlObtenerCarrito($idUsuario);
            echo json_encode($productos);
        } else {
            echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
        }
    }

    // Método para actualizar la cantidad de un producto en el carrito
    public static function ctrActualizarCantidad()
    {
        if (isset($_POST['idRepuesto']) && isset($_POST['nuevaCantidad'])) {
            $idUsuario = $_SESSION['id_usuario'];
            $idRepuesto = $_POST['idRepuesto'];
            $nuevaCantidad = $_POST['nuevaCantidad'];

            $respuesta = ModeloCarrito::mdlActualizarCantidad($idUsuario, $idRepuesto, $nuevaCantidad);

            if ($respuesta == "ok") {
                echo json_encode(["status" => "success", "message" => "Cantidad actualizada"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al actualizar la cantidad"]);
            }
        }
    }

    // Método para eliminar un producto del carrito
    public static function ctrEliminarProducto()
    {
        if (isset($_POST['idRepuesto'])) {
            $idUsuario = $_SESSION['id_usuario'];
            $idRepuesto = $_POST['idRepuesto'];

            $respuesta = ModeloCarrito::mdlEliminarProducto($idUsuario, $idRepuesto);

            if ($respuesta == "ok") {
                echo json_encode(["status" => "success", "message" => "Producto eliminado del carrito"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al eliminar el producto del carrito"]);
            }
        }
    }

    // Método para vaciar el carrito del usuario (por ejemplo, después de una compra)
    public static function ctrVaciarCarrito()
    {
        if (isset($_SESSION['id_usuario'])) {
            $idUsuario = $_SESSION['id_usuario'];

            $respuesta = ModeloCarrito::mdlVaciarCarrito($idUsuario);

            if ($respuesta == "ok") {
                echo json_encode(["status" => "success", "message" => "Carrito vaciado"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al vaciar el carrito"]);
            }
        }
    }
}

?>
