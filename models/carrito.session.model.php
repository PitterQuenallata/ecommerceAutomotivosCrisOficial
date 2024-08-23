<?php

class ModeloCarritoSession {

// Obtener el ID del carrito del cliente
private static function obtenerIdCarrito($id_cliente) {
    $stmt = Conexion::conectar()->prepare("SELECT id_carrito FROM carrito WHERE id_cliente = :id_cliente");
    $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();  // Devuelve el id_carrito o false si no existe
}

// Obtener un ítem específico del carrito
public static function mdlObtenerItemCarrito($id_cliente, $id_repuesto) {
    $id_carrito = self::obtenerIdCarrito($id_cliente);

    if ($id_carrito) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM detalles_carrito WHERE id_carrito = :id_carrito AND id_repuesto = :id_repuesto");
        $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
        $stmt->bindParam(":id_repuesto", $id_repuesto, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        return false;  // No se encontró el carrito
    }
}

// Agregar o actualizar un ítem en el carrito
public static function mdlAgregarActualizarCarrito($id_cliente, $item) {
    $conn = Conexion::conectar();
    $id_carrito = self::obtenerIdCarrito($id_cliente);

    // Si el carrito no existe, crearlo
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

// Actualizar la cantidad de un ítem en el carrito
public static function mdlActualizarCantidadCarrito($id_cliente, $id_repuesto, $cantidad) {
    $id_carrito = self::obtenerIdCarrito($id_cliente);

    if ($id_carrito) {
        $stmt = Conexion::conectar()->prepare("UPDATE detalles_carrito SET cantidad = :cantidad WHERE id_carrito = :id_carrito AND id_repuesto = :id_repuesto");
        $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
        $stmt->bindParam(":id_repuesto", $id_repuesto, PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
        return $stmt->execute();
    } else {
        return false;  // No se encontró el carrito
    }
}

// Eliminar un producto del carrito
public static function mdlEliminarProducto($id_cliente, $id_repuesto) {
    $id_carrito = self::obtenerIdCarrito($id_cliente);

    if ($id_carrito) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM detalles_carrito WHERE id_carrito = :id_carrito AND id_repuesto = :id_repuesto");
        $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
        $stmt->bindParam(":id_repuesto", $id_repuesto, PDO::PARAM_INT);
        return $stmt->execute();
    } else {
        return false;  // No se encontró el carrito
    }
}

// Obtener todo el carrito de un cliente
public static function mdlObtenerCarrito($id_cliente) {
    $id_carrito = self::obtenerIdCarrito($id_cliente);

    if ($id_carrito) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM detalles_carrito WHERE id_carrito = :id_carrito");
        $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return [];  // Carrito vacío o no existe
    }
}

// Método para vaciar el carrito del usuario
public static function mdlVaciarCarrito($id_cliente) {
  $id_carrito = self::obtenerIdCarrito($id_cliente);

  if ($id_carrito) {
      // Eliminar todos los ítems del carrito del usuario
      $stmt = Conexion::conectar()->prepare("DELETE FROM detalles_carrito WHERE id_carrito = :id_carrito");
      $stmt->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
      if ($stmt->execute()) {
          // Opcional: También eliminar el carrito
          $stmtCarrito = Conexion::conectar()->prepare("DELETE FROM carrito WHERE id_carrito = :id_carrito");
          $stmtCarrito->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
          $stmtCarrito->execute();

          return ["success" => true];
      } else {
          return ["success" => false, "error" => "Error al vaciar el carrito."];
      }
  } else {
      return ["success" => false, "error" => "No se encontró el carrito."];
  }
}
}
