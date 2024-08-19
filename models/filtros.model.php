<?php
require_once "conexion.php";

class ModeloFiltros
{
  // Método para obtener repuestos filtrados por categoría, marca, modelo y motor
  public static function mdlObtenerRepuestosPorMotorMarcaModeloCategoria($idCategoria, $idMarca, $idModelo, $idMotor)
  {
    $sql = "SELECT r.*, mr.id_modelo, mo.nombre_modelo, m.nombre_motor, ma.nombre_marca, c.nombre_categoria
            FROM repuestos r
            INNER JOIN modelo_repuestos mr ON r.id_repuesto = mr.id_repuesto
            INNER JOIN modelos mo ON mr.id_modelo = mo.id_modelo
            INNER JOIN motores m ON mo.id_modelo = m.id_modelo
            INNER JOIN marcas ma ON mo.id_marca = ma.id_marca
            INNER JOIN categorias c ON r.id_categoria = c.id_categoria
            WHERE ma.id_marca = :idMarca 
              AND mo.id_modelo = :idModelo 
              AND m.id_motor = :idMotor
              AND c.id_categoria = :idCategoria";

    $stmt = Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
    $stmt->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);
    $stmt->bindParam(":idModelo", $idModelo, PDO::PARAM_INT);
    $stmt->bindParam(":idMotor", $idMotor, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Método para obtener repuestos filtrados por marca, modelo y motor
  public static function mdlObtenerRepuestosPorMotor($idMarca, $idModelo, $idMotor)
  {
    $sql = "SELECT r.*, mr.id_modelo, mo.nombre_modelo, m.nombre_motor, ma.nombre_marca
                  FROM repuestos r
                  INNER JOIN modelo_repuestos mr ON r.id_repuesto = mr.id_repuesto
                  INNER JOIN modelos mo ON mr.id_modelo = mo.id_modelo
                  INNER JOIN motores m ON mo.id_modelo = m.id_modelo
                  INNER JOIN marcas ma ON mo.id_marca = ma.id_marca
                  WHERE ma.id_marca = :idMarca 
                    AND mo.id_modelo = :idModelo 
                    AND m.id_motor = :idMotor";

    $stmt = Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);
    $stmt->bindParam(":idModelo", $idModelo, PDO::PARAM_INT);
    $stmt->bindParam(":idMotor", $idMotor, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  public static function mdlObtenerRepuestosPorMarca($idMarca)
  {
    $sql = "SELECT r.*, mr.id_modelo, mo.nombre_modelo, ma.nombre_marca
            FROM repuestos r
            INNER JOIN modelo_repuestos mr ON r.id_repuesto = mr.id_repuesto
            INNER JOIN modelos mo ON mr.id_modelo = mo.id_modelo
            INNER JOIN marcas ma ON mo.id_marca = ma.id_marca
            WHERE mo.id_marca = :idMarca";

    $stmt = Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }





  //Modelo para obtener repuestos por categoría
  public static function mdlObtenerRepuestosPorCategoria($idCategoria)
  {
    $sql = "SELECT r.*
                FROM repuestos r
                WHERE r.id_categoria = :idCategoria";

    $stmt = Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll();
  }

  public static function mdlObtenerRepuestosPorModelo($idModelo)
  {
    $sql = "SELECT r.*
              FROM repuestos r
              INNER JOIN modelo_repuestos mr ON r.id_repuesto = mr.id_repuesto
              WHERE mr.id_modelo = :idModelo";

    $stmt = Conexion::conectar()->prepare($sql);

    $stmt->bindParam(":idModelo", $idModelo, PDO::PARAM_INT);

    $stmt->execute();

    // Usar fetchAll para obtener todos los resultados
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function mdlObtenerRepuestosPorCategoriayMarca($idCategoria, $idMarca)
  {
      $sql = "SELECT r.*, mr.id_modelo, mo.nombre_modelo, ma.nombre_marca, c.nombre_categoria
              FROM repuestos r
              INNER JOIN modelo_repuestos mr ON r.id_repuesto = mr.id_repuesto
              INNER JOIN modelos mo ON mr.id_modelo = mo.id_modelo
              INNER JOIN marcas ma ON mo.id_marca = ma.id_marca
              INNER JOIN categorias c ON r.id_categoria = c.id_categoria
              WHERE r.id_categoria = :idCategoria 
                AND ma.id_marca = :idMarca";
  
      $stmt = Conexion::conectar()->prepare($sql);
  
      $stmt->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
      $stmt->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);
  
      $stmt->execute();
  
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  
  public static function mdlObtenerRepuestosPorCategoriaMarcaModelo($idCategoria, $idMarca, $idModelo)
  {
      $sql = "SELECT r.*, mr.id_modelo, mo.nombre_modelo, ma.nombre_marca, c.nombre_categoria
              FROM repuestos r
              INNER JOIN modelo_repuestos mr ON r.id_repuesto = mr.id_repuesto
              INNER JOIN modelos mo ON mr.id_modelo = mo.id_modelo
              INNER JOIN marcas ma ON mo.id_marca = ma.id_marca
              INNER JOIN categorias c ON r.id_categoria = c.id_categoria
              WHERE r.id_categoria = :idCategoria 
                AND ma.id_marca = :idMarca 
                AND mo.id_modelo = :idModelo";
  
      $stmt = Conexion::conectar()->prepare($sql);
  
      $stmt->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
      $stmt->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);
      $stmt->bindParam(":idModelo", $idModelo, PDO::PARAM_INT);
  
      $stmt->execute();
  
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
}
