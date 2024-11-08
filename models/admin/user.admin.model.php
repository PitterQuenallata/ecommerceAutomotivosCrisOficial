<?php

require_once "conexionAdmin.php";

class ModeloUsuariosAdmin
{

  /*=============================================
	MOSTRAR USUARIOS
	=============================================*/
  static public function mdlMostrarUsuarios($tabla, $item, $valor)
  {

    if ($item != null) {

      $stmt = ConexionAdmin::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

      $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

      $stmt->execute();

      return $stmt->fetch();
    } else {

      $stmt = ConexionAdmin::conectar()->prepare("SELECT * FROM $tabla");

      $stmt->execute();

      return $stmt->fetchAll();
    }
    $stmt = null;
  }

  /*=============================================
	REGISTRO DE USUARIO
	=============================================*/

  static public function mdlIngresarUsuario($tabla, $datos)
  {

    $stmt = ConexionAdmin::conectar()->prepare("INSERT INTO $tabla(foto_usuario, nombre_usuario, apellido_usuario, user_usuario, password_usuario, email_usuario, rol_usuario) VALUES (:foto_usuario, :nombre_usuario, :apellido_usuario, :user_usuario, :password_usuario, :email_usuario, :rol_usuario)");

    $stmt->bindParam(":foto_usuario", $datos["foto_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":user_usuario", $datos["user_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":nombre_usuario", $datos["nombre_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":apellido_usuario", $datos["apellido_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":password_usuario", $datos["password_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":email_usuario", $datos["email_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":rol_usuario", $datos["rol_usuario"], PDO::PARAM_STR);


    if ($stmt->execute()) {

      return "ok";
    } else {

      return "error";
    }


    $stmt = null;
  }

  /*=============================================
	EDITAR USUARIO
	=============================================*/

  static public function mdlEditarUsuario($tabla, $datos)
  {

    $stmt = ConexionAdmin::conectar()->prepare(
      "UPDATE $tabla 
        SET nombre_usuario = :nombre_usuario, 
            apellido_usuario = :apellido_usuario, 
            email_usuario = :email_usuario, 
            user_usuario = :user_usuario, 
            password_usuario = :password_usuario, 
            rol_usuario = :rol_usuario, 
            foto_usuario = :foto_usuario 
        WHERE user_usuario = :user_usuario"
    );

    $stmt->bindParam(":nombre_usuario", $datos["nombre_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":apellido_usuario", $datos["apellido_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":email_usuario", $datos["email_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":user_usuario", $datos["user_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":password_usuario", $datos["password_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":rol_usuario", $datos["rol_usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":foto_usuario", $datos["foto_usuario"], PDO::PARAM_STR);

    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error";
    }

    $stmt = null;
  }


  /*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

  static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
  {

    $stmt = ConexionAdmin::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

    $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
    $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error";
    }

    $stmt = null;
  }

  /*=============================================
	BORRAR USUARIO
	=============================================*/

  static public function mdlBorrarUsuario($tabla, $datos)
  {

    $stmt = ConexionAdmin::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id");

    $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

    if ($stmt->execute()) {

      return "ok";
    } else {

      return "error";
    }


    $stmt = null;
  }
}
