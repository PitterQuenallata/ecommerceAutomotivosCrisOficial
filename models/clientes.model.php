<?php

require_once "conexion.php";

class ModeloClientes
{

    /*=============================================
MOSTRAR CLIENTE POR ID en uso
=============================================*/
    static public function mdlMostrarClientePorId($tabla, $id_cliente)
    {
        // Prepara la consulta SQL para seleccionar un cliente por su id_cliente
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_cliente = :id_cliente");

        // Bindea el parámetro id_cliente
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);

        // Ejecuta la consulta
        $stmt->execute();

        // Retorna el resultado de la consulta
        return $stmt->fetch();

        // Cierra el cursor para liberar los recursos
        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    MOSTRAR CLIENTES en uso
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
    ACTUALIZAR CLIENTE uso
    =============================================*/
    static public function mdlEditarCliente($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_cliente = :nombre_cliente, apellido_cliente = :apellido_cliente, email_cliente = :email_cliente, telefono_cliente = :telefono_cliente, nit_ci_cliente = :nit_ci_cliente, password_cliente = :password_cliente WHERE id_cliente = :id_cliente");

        $stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido_cliente", $datos["apellido_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":email_cliente", $datos["email_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_cliente", $datos["telefono_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":nit_ci_cliente", $datos["nit_ci_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":password_cliente", $datos["password_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);

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
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_cliente, email_cliente, password_cliente) VALUES (:nombre_cliente, :email_cliente, :password_cliente)");

        $stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":email_cliente", $datos["email_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":password_cliente", $datos["password_cliente"], PDO::PARAM_STR);

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
