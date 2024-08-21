<?php

require_once "conexion.php";

class ModeloCarrito {

    // Obtener el carrito de un usuario por su ID
    public static function mdlObtenerCarrito($id_cliente) {
        $stmt = Conexion::conectar()->prepare("SELECT c.id_carrito, dc.id_repuesto, dc.cantidad 
                                                FROM carrito c
                                                LEFT JOIN detalle_carrito dc ON c.id_carrito = dc.id_carrito
                                                WHERE c.id_cliente = :id_cliente");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar o actualizar un producto en el carrito
    public static function mdlAgregarActualizarCarrito($id_cliente, $item) {
        $conn = Conexion::conectar();
        
        // Obtener el ID del carrito del cliente
        $stmt = $conn->prepare("SELECT id_carrito FROM carrito WHERE id_cliente = :id_cliente");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        $id_carrito = $stmt->fetchColumn();

        // Si el carrito no existe, crear uno
        if (!$id_carrito) {
            $stmt = $conn->prepare("INSERT INTO carrito(id_cliente) VALUES(:id_cliente)");
            $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return ["success" => false, "error" => "Error al crear el carrito."];
            }
            $id_carrito = $conn->lastInsertId();
        }

        // Verificar si el producto ya está en el carrito
        $stmt = $conn->prepare("SELECT id_detalle_carrito FROM detalle_carrito WHERE id_carrito = :id_carrito AND id_repuesto = :id_repuesto");
        $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
        $stmt->bindParam(":id_repuesto", $item["id_repuesto"], PDO::PARAM_INT);
        $stmt->execute();
        $id_detalle_carrito = $stmt->fetchColumn();

        if ($id_detalle_carrito) {
            // Actualizar la cantidad del producto en el carrito
            $stmt = $conn->prepare("UPDATE detalle_carrito SET cantidad = :cantidad WHERE id_detalle_carrito = :id_detalle_carrito");
            $stmt->bindParam(":cantidad", $item["cantidad"], PDO::PARAM_INT);
            $stmt->bindParam(":id_detalle_carrito", $id_detalle_carrito, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return ["success" => false, "error" => "Error al actualizar el producto en el carrito."];
            }
        } else {
            // Insertar un nuevo producto en el carrito
            $stmt = $conn->prepare("INSERT INTO detalle_carrito(id_carrito, id_repuesto, cantidad) VALUES(:id_carrito, :id_repuesto, :cantidad)");
            $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
            $stmt->bindParam(":id_repuesto", $item["id_repuesto"], PDO::PARAM_INT);
            $stmt->bindParam(":cantidad", $item["cantidad"], PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return ["success" => false, "error" => "Error al agregar el producto al carrito."];
            }
        }

        return ["success" => true];
    }

    // Eliminar un producto del carrito
    public static function mdlEliminarProducto($id_cliente, $id_repuesto) {
        $conn = Conexion::conectar();
        
        // Obtener el ID del carrito del cliente
        $stmt = $conn->prepare("SELECT id_carrito FROM carrito WHERE id_cliente = :id_cliente");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        $id_carrito = $stmt->fetchColumn();

        if ($id_carrito) {
            // Eliminar el producto del carrito
            $stmt = $conn->prepare("DELETE FROM detalle_carrito WHERE id_carrito = :id_carrito AND id_repuesto = :id_repuesto");
            $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
            $stmt->bindParam(":id_repuesto", $id_repuesto, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return ["success" => false, "error" => "Error al eliminar el producto del carrito."];
            }
        }

        return ["success" => true];
    }

    // Vaciar el carrito del cliente
    public static function mdlVaciarCarrito($id_cliente) {
        $conn = Conexion::conectar();

        // Obtener el ID del carrito del cliente
        $stmt = $conn->prepare("SELECT id_carrito FROM carrito WHERE id_cliente = :id_cliente");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        $id_carrito = $stmt->fetchColumn();

        if ($id_carrito) {
            // Eliminar todos los productos del carrito
            $stmt = $conn->prepare("DELETE FROM detalle_carrito WHERE id_carrito = :id_carrito");
            $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return ["success" => false, "error" => "Error al vaciar el carrito."];
            }
        }

        return ["success" => true];
    }
}
