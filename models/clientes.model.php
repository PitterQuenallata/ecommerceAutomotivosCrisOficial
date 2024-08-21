<?php

require_once "conexion.php";

class ModeloClientes
{
    /*=============================================
    MOSTRAR CLIENTES
    =============================================*/
    static public function mdlMostrarClientes($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR CLIENTE
    =============================================*/
    static public function mdlActualizarCliente($tabla, $item1, $valor1, $item2, $valor2)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    REGISTRAR NUEVO CLIENTE
    =============================================*/
    static public function mdlRegistrarCliente($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_cliente, email_cliente, password_cliente, estado_cliente, date_created_cliente) VALUES (:nombre_cliente, :email_cliente, :password_cliente, :estado_cliente, :date_created_cliente)");

        $stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":email_cliente", $datos["email_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":password_cliente", $datos["password_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_cliente", $datos["estado_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":date_created_cliente", $datos["date_created_cliente"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ELIMINAR CLIENTE
    =============================================*/
    static public function mdlEliminarCliente($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    VERIFICAR EXISTENCIA DE EMAIL
    =============================================*/
    static public function mdlVerificarEmailCliente($tabla, $email)
    {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE email_cliente = :email_cliente");
        $stmt->bindParam(":email_cliente", $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn();
        
        $stmt->closeCursor();
        $stmt = null;
    }
}

