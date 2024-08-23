<?php

require_once "conexion.php";

class ModeloCarrito {

    // Obtener el carrito de un cliente por su ID en uso
    public static function mdlObtenerCarrito($id_cliente) {
        $stmt = Conexion::conectar()->prepare("SELECT c.id_carrito, dc.id_repuesto, dc.cantidad 
                                                FROM carrito c
                                                LEFT JOIN detalles_carrito dc ON c.id_carrito = dc.id_carrito
                                                WHERE c.id_cliente = :id_cliente");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar o actualizar un producto en el carrito en uso
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
        $stmt = $conn->prepare("SELECT id_detalle_carrito FROM detalles_carrito WHERE id_carrito = :id_carrito AND id_repuesto = :id_repuesto");
        $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
        $stmt->bindParam(":id_repuesto", $item["id_repuesto"], PDO::PARAM_INT);
        $stmt->execute();
        $id_detalle_carrito = $stmt->fetchColumn();

        if ($id_detalle_carrito) {
            // Actualizar la cantidad del producto en el carrito
            $stmt = $conn->prepare("UPDATE detalles_carrito SET cantidad = :cantidad WHERE id_detalle_carrito = :id_detalle_carrito");
            $stmt->bindParam(":cantidad", $item["cantidad"], PDO::PARAM_INT);
            $stmt->bindParam(":id_detalle_carrito", $id_detalle_carrito, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return ["success" => false, "error" => "Error al actualizar el producto en el carrito."];
            }
        } else {
            // Insertar un nuevo producto en el carrito
            $stmt = $conn->prepare("INSERT INTO detalles_carrito(id_carrito, id_repuesto, cantidad) VALUES(:id_carrito, :id_repuesto, :cantidad)");
            $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
            $stmt->bindParam(":id_repuesto", $item["id_repuesto"], PDO::PARAM_INT);
            $stmt->bindParam(":cantidad", $item["cantidad"], PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return ["success" => false, "error" => "Error al agregar el producto al carrito."];
            }
        }

        return ["success" => true];
    }
// --------------------------------------------
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
            $stmt = $conn->prepare("DELETE FROM detalles_carrito WHERE id_carrito = :id_carrito AND id_repuesto = :id_repuesto");
            $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
            $stmt->bindParam(":id_repuesto", $id_repuesto, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return ["success" => false, "error" => "Error al eliminar el producto del carrito."];
            }
        }

        return ["success" => true];
    }

    // Método para obtener el carrito con todos los detalles del cliente en uso
    public static function mdlObtenerCarritoConDetalles($id_cliente) {
        $stmt = Conexion::conectar()->prepare("
            SELECT 
                r.id_repuesto,
                r.nombre_repuesto,
                r.precio_repuesto,
                r.img_repuesto,
                r.stock_repuesto,
                r.fabricante_repuesto,
                r.descripcion_repuesto,
                dc.cantidad
            FROM 
                carrito c
            INNER JOIN 
                detalles_carrito dc ON c.id_carrito = dc.id_carrito
            INNER JOIN 
                repuestos r ON dc.id_repuesto = r.id_repuesto
            WHERE 
                c.id_cliente = :id_cliente
        ");

        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




}
