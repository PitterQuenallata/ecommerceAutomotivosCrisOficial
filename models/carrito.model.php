<?php


require_once "conexion.php";

class ModeloCarrito
{
    // Método para agregar un producto al carrito
    public static function mdlAgregarProducto($idUsuario, $idRepuesto, $cantidad)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO carrito (id_usuario, id_repuesto, cantidad) VALUES (:idUsuario, :idRepuesto, :cantidad) ON DUPLICATE KEY UPDATE cantidad = cantidad + :cantidad");
        
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(":idRepuesto", $idRepuesto, PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    // Método para obtener los productos en el carrito de un usuario
    public static function mdlObtenerCarrito($idUsuario)
    {
        $stmt = Conexion::conectar()->prepare("SELECT c.id_carrito, c.id_repuesto, c.cantidad, r.nombre_repuesto, r.precio_repuesto, r.img_repuesto 
                                               FROM carrito c
                                               INNER JOIN repuestos r ON c.id_repuesto = r.id_repuesto
                                               WHERE c.id_usuario = :idUsuario");
        
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
        
        $stmt->close();
        $stmt = null;
    }

    // Método para actualizar la cantidad de un producto en el carrito
    public static function mdlActualizarCantidad($idUsuario, $idRepuesto, $nuevaCantidad)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE carrito SET cantidad = :nuevaCantidad WHERE id_usuario = :idUsuario AND id_repuesto = :idRepuesto");

        $stmt->bindParam(":nuevaCantidad", $nuevaCantidad, PDO::PARAM_INT);
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(":idRepuesto", $idRepuesto, PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    // Método para eliminar un producto del carrito
    public static function mdlEliminarProducto($idUsuario, $idRepuesto)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM carrito WHERE id_usuario = :idUsuario AND id_repuesto = :idRepuesto");

        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(":idRepuesto", $idRepuesto, PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    // Método para vaciar el carrito de un usuario (por ejemplo, después de una compra)
    public static function mdlVaciarCarrito($idUsuario)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM carrito WHERE id_usuario = :idUsuario");

        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }
}
?>
