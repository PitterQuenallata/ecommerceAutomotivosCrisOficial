<?php

require_once "conexion.php";

class ModeloRepuestos {

    // Obtener un repuesto por su ID
    public static function mdlMostrarRepuestoPorId($id_repuesto) {
        $stmt = Conexion::conectar()->prepare("SELECT id_repuesto, nombre, precio, stock_repuesto 
                                                FROM repuestos 
                                                WHERE id_repuesto = :id_repuesto");
        $stmt->bindParam(":id_repuesto", $id_repuesto, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Otros métodos relacionados con los repuestos se podrían añadir aquí
}