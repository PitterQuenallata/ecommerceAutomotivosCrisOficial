<?php
class ControladorCarrito
{


    // Sincronizar el carrito después del inicio de sesión
    // Sincronizar el carrito después del inicio de sesión
    static public function ctrSincronizarCarrito($carrito_local, $id_cliente)
    {
        $response = ["success" => true, "alerts" => [], "clearLocalStorage" => false, "error" => ""];

        // Obtener el carrito existente del usuario desde la base de datos
        $carrito_db = ModeloCarrito::mdlObtenerCarrito($id_cliente);

        // Crear un array para manejar las cantidades finales
        $carrito_final = [];

        // Combinar los carritos: base de datos y localStorage
        foreach ($carrito_local as $item_local) {
            $found = false;
            foreach ($carrito_db as $item_db) {
                if ($item_db["id_repuesto"] == $item_local["id"]) {
                    // Si el producto ya está en la base de datos, usa la cantidad más reciente del localStorage
                    $carrito_final[] = [
                        "id_repuesto" => $item_db["id_repuesto"],
                        "cantidad" => $item_local["cantidad"]
                    ];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                // Si el producto no está en la base de datos, añadirlo con la cantidad del localStorage
                $carrito_final[] = [
                    "id_repuesto" => $item_local["id"],
                    "cantidad" => $item_local["cantidad"]
                ];
            }
        }

        // Verificar cada producto y actualizar la base de datos
        foreach ($carrito_final as $item) {
            $producto = ModeloRepuestos::mdlMostrarRepuestoPorId($item["id_repuesto"]);

            if ($producto) {
                if ($producto["estado_repuesto"] == 1) {
                    if ($producto["stock_repuesto"] >= $item["cantidad"]) {
                        // Actualizar el carrito en la base de datos con la cantidad del carrito final
                        $syncResponse = ModeloCarrito::mdlAgregarActualizarCarrito($id_cliente, $item);

                        if (!$syncResponse["success"]) {
                            $response["success"] = false;
                            $response["error"] = "Error al sincronizar el carrito.";
                            break;
                        }
                    } else {
                        $response["alerts"][] = "La cantidad del producto " . $producto["nombre_repuesto"] . " se ajustó a " . $producto["stock_repuesto"] . " debido a stock limitado.";
                        $item["cantidad"] = $producto["stock_repuesto"];
                        ModeloCarrito::mdlAgregarActualizarCarrito($id_cliente, $item);
                    }
                } else {
                    // Producto no disponible, eliminar del carrito
                    ModeloCarrito::mdlEliminarProducto($id_cliente, $item["id_repuesto"]);
                    $response["alerts"][] = "El producto " . $producto["nombre_repuesto"] . " no está disponible y fue eliminado del carrito.";
                }
            } else {
                // Producto no disponible, eliminar del carrito
                ModeloCarrito::mdlEliminarProducto($id_cliente, $item["id_repuesto"]);
                $response["alerts"][] = "El producto no está disponible y fue eliminado del carrito.";
            }
        }

        // Si no hubo errores, vaciar el carrito local
        if ($response["success"]) {
            $response["clearLocalStorage"] = true; // Indicar al cliente que debe limpiar el carrito local
        }

        return $response;
    }

    //--------------------------------------
    // Método para obtener el carrito de un cliente específico en uso solo al iniciar sesión
    //-------------------------------------
    public static function ctrObtenerCarrito()
    {
        if (isset($_SESSION["id_cliente"])) {
            $id_cliente = $_SESSION["id_cliente"];
            $carrito = ModeloCarrito::mdlObtenerCarritoConDetalles($id_cliente);

            if ($carrito) {
                // Convertir el precio a decimal y cambiar los nombres de las claves antes de enviar la respuesta
                $carrito_modificado = array_map(function ($item) {
                    return [
                        "id" => $item["id_repuesto"],
                        "nombre" => $item["nombre_repuesto"],
                        "precio" => floatval($item["precio_repuesto"]), // Convertir a float
                        "imagen" => $item["img_repuesto"],
                        "stock" => $item["stock_repuesto"],
                        "marca" => $item["fabricante_repuesto"],
                        "descripcion" => $item["descripcion_repuesto"],
                        "cantidad" => $item["cantidad"]
                    ];
                }, $carrito);

                return [
                    "success" => true,
                    "carrito" => $carrito_modificado
                ];
            } else {
                return [
                    "success" => false,
                    "error" => "No se encontraron ítems en el carrito."
                ];
            }
        } else {
            return [
                "success" => false,
                "error" => "No se encontró el ID del cliente en la sesión."
            ];
        }
    }




}
