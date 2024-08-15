<?php
require_once "conexion.php";

class ModeloRepuestosCards
{


  // Modelo para obtener el número total de repuestos por categoría
  public static function mdlObtenerTotalRepuestosPorCategoria()
  {
    $sql = "SELECT c.nombre_categoria, COUNT(r.id_repuesto) AS total_repuestos
                FROM categorias c
                LEFT JOIN repuestos r ON c.id_categoria = r.id_categoria
                GROUP BY c.id_categoria, c.nombre_categoria";

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  

  // Método para obtener las marcas de vehículos
  public static function mdlMostrarMarcas()
  {
    $stmt = Conexion::conectar()->prepare("SELECT id_marca, nombre_marca FROM marcas");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  // Método para obtener los modelos basado en la marca
  public static function mdlMostrarModelos($idMarca)
  {
    $stmt = Conexion::conectar()->prepare("
          SELECT m.id_modelo, m.nombre_modelo 
          FROM modelos m
          WHERE m.id_marca = :id_marca
      ");
    $stmt->bindParam(":id_marca", $idMarca, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  // Método para obtener los motores basado en el modelo
  public static function mdlMostrarMotores($idModelo)
  {
    $stmt = Conexion::conectar()->prepare("SELECT id_motor, nombre_motor FROM motores WHERE id_modelo = :idModelo");
    $stmt->bindParam(":idModelo", $idModelo, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

 
}
