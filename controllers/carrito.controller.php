<?php
class ControladorCarrito
{

    //sincronizar

    // Sincronizar el carrito después del inicio de sesión
    static public function ctrSincronizarCarrito($carrito_local, $id_cliente)
    {
        $response = ["success" => true, "alerts" => []];

        // Obtener el carrito existente del usuario desde la base de datos
        $carrito_db = ModeloCarrito::mdlObtenerCarrito($id_cliente);

        // Combinar los carritos: base de datos y localStorage
        foreach ($carrito_local as $item_local) {
            $found = false;
            foreach ($carrito_db as &$item_db) {
                if ($item_db["id_repuesto"] == $item_local["id"]) {
                    // Si el producto ya está en la base de datos, combinar cantidades
                    $item_db["cantidad"] += $item_local["cantidad"];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                // Si el producto no está en la base de datos, añadirlo
                $carrito_db[] = [
                    "id_repuesto" => $item_local["id"],
                    "cantidad" => $item_local["cantidad"]
                ];
            }
        }

        // Verificar cada producto y actualizar la base de datos
        foreach ($carrito_db as $item) {
            $producto = ModeloRepuestos::mdlMostrarRepuestoPorId($item["id_repuesto"]);

            if ($producto) {
                if ($producto["stock_repuesto"] >= $item["cantidad"]) {
                    // Actualizar el carrito en la base de datos
                    $syncResponse = ModeloCarrito::mdlAgregarActualizarCarrito($id_cliente, $item);
                    if (!$syncResponse["success"]) {
                        $response["success"] = false;
                        $response["error"] = "Error al sincronizar el carrito.";
                        break;
                    }
                } else {
                    $response["alerts"][] = "La cantidad del producto " . $producto["nombre"] . " se ajustó a " . $producto["stock_repuesto"] . " debido a stock limitado.";
                    $item["cantidad"] = $producto["stock_repuesto"];
                    ModeloCarrito::mdlAgregarActualizarCarrito($id_cliente, $item);
                }
            } else {
                // Producto no disponible, eliminar del carrito
                ModeloCarrito::mdlEliminarProducto($id_cliente, $item["id_repuesto"]);
                $response["alerts"][] = "El producto " . $producto["nombre"] . " no está disponible y fue eliminado del carrito.";
            }
        }

        // Si no hubo errores, vaciar el carrito local
        if ($response["success"]) {
            $response["clearLocalStorage"] = true; // Indicar al cliente que debe limpiar el carrito local
        }

        return $response;
    }




    // public static function ctrObtenerContenidoCarrito()
    // {
    //     // Verificar si el carrito existe en la sesión
    //     if (isset($_SESSION['carrito'])) {
    //         // Devolver el contenido del carrito almacenado en la sesión
    //         return $_SESSION['carrito'];
    //     } else {
    //         // Si el carrito no existe, devolver un array vacío
    //         return [];
    //     }
    // }

    // // Método para agregar un producto al carrito
    // public static function ctrAgregarProducto()
    // {
    //     if (isset($_POST['idRepuesto']) && isset($_POST['cantidad'])) {
    //         $idUsuario = $_SESSION['id_usuario']; // Asumiendo que el ID del usuario está almacenado en la sesión
    //         $idRepuesto = $_POST['idRepuesto'];
    //         $cantidad = $_POST['cantidad'];

    //         $respuesta = ModeloCarrito::mdlAgregarProducto($idUsuario, $idRepuesto, $cantidad);

    //         if ($respuesta == "ok") {
    //             echo json_encode(["status" => "success", "message" => "Producto añadido al carrito"]);
    //         } else {
    //             echo json_encode(["status" => "error", "message" => "Error al añadir el producto al carrito"]);
    //         }
    //     }
    // }

    // // Método para obtener los productos en el carrito de un usuario
    // public static function ctrObtenerCarrito()
    // {
    //     if (isset($_SESSION['id_usuario'])) {
    //         $idUsuario = $_SESSION['id_usuario'];
    //         $productos = ModeloCarrito::mdlObtenerCarrito($idUsuario);
    //         echo json_encode($productos);
    //     } else {
    //         echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
    //     }
    // }

    // // Método para actualizar la cantidad de un producto en el carrito
    // public static function ctrActualizarCantidad()
    // {
    //     if (isset($_POST['idRepuesto']) && isset($_POST['nuevaCantidad'])) {
    //         $idUsuario = $_SESSION['id_usuario'];
    //         $idRepuesto = $_POST['idRepuesto'];
    //         $nuevaCantidad = $_POST['nuevaCantidad'];

    //         $respuesta = ModeloCarrito::mdlActualizarCantidad($idUsuario, $idRepuesto, $nuevaCantidad);

    //         if ($respuesta == "ok") {
    //             echo json_encode(["status" => "success", "message" => "Cantidad actualizada"]);
    //         } else {
    //             echo json_encode(["status" => "error", "message" => "Error al actualizar la cantidad"]);
    //         }
    //     }
    // }

    // // Método para eliminar un producto del carrito
    // public static function ctrEliminarProducto()
    // {
    //     if (isset($_POST['idRepuesto'])) {
    //         $idUsuario = $_SESSION['id_usuario'];
    //         $idRepuesto = $_POST['idRepuesto'];

    //         $respuesta = ModeloCarrito::mdlEliminarProducto($idUsuario, $idRepuesto);

    //         if ($respuesta == "ok") {
    //             echo json_encode(["status" => "success", "message" => "Producto eliminado del carrito"]);
    //         } else {
    //             echo json_encode(["status" => "error", "message" => "Error al eliminar el producto del carrito"]);
    //         }
    //     }
    // }

    // // Método para vaciar el carrito del usuario (por ejemplo, después de una compra)
    // public static function ctrVaciarCarrito()
    // {
    //     if (isset($_SESSION['id_usuario'])) {
    //         $idUsuario = $_SESSION['id_usuario'];

    //         $respuesta = ModeloCarrito::mdlVaciarCarrito($idUsuario);

    //         if ($respuesta == "ok") {
    //             echo json_encode(["status" => "success", "message" => "Carrito vaciado"]);
    //         } else {
    //             echo json_encode(["status" => "error", "message" => "Error al vaciar el carrito"]);
    //         }
    //     }
    // }


}
