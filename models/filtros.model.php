<?php
require_once "conexion.php";

class ModeloFiltros
{
    public static function mdlObtenerRepuestosPorMotorMarcaModeloCategoria(int $idCategoria, int $idMarca, int $idModelo, int $idMotor): array
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT r.*, m.nombre_marca, mo.nombre_modelo, mt.nombre_motor
            FROM repuestos r
            JOIN marcas m ON r.id_marca = m.id_marca
            JOIN modelos mo ON r.id_modelo = mo.id_modelo
            JOIN motores mt ON r.id_motor = mt.id_motor
            WHERE r.id_categoria = :idCategoria
            AND r.id_marca = :idMarca
            AND r.id_modelo = :idModelo
            AND r.id_motor = :idMotor
        ");

        $stmt->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
        $stmt->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);
        $stmt->bindParam(":idModelo", $idModelo, PDO::PARAM_INT);
        $stmt->bindParam(":idMotor", $idMotor, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlObtenerRepuestosPorCategoriayMarca(int $idCategoria, int $idMarca): array
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT r.*, m.nombre_marca
            FROM repuestos r
            JOIN marcas m ON r.id_marca = m.id_marca
            WHERE r.id_categoria = :idCategoria
            AND r.id_marca = :idMarca
        ");

        $stmt->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
        $stmt->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlObtenerRepuestosPorCategoriaMarcaModelo(int $idCategoria, int $idMarca, int $idModelo): array
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT r.*, m.nombre_marca, mo.nombre_modelo
            FROM repuestos r
            JOIN marcas m ON r.id_marca = m.id_marca
            JOIN modelos mo ON r.id_modelo = mo.id_modelo
            WHERE r.id_categoria = :idCategoria
            AND r.id_marca = :idMarca
            AND r.id_modelo = :idModelo
        ");

        $stmt->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
        $stmt->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);
        $stmt->bindParam(":idModelo", $idModelo, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlObtenerRepuestosPorMotor(int $idMarca, int $idModelo, int $idMotor): array
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT r.*, m.nombre_marca, mo.nombre_modelo, mt.nombre_motor
            FROM repuestos r
            JOIN marcas m ON r.id_marca = m.id_marca
            JOIN modelos mo ON r.id_modelo = mo.id_modelo
            JOIN motores mt ON r.id_motor = mt.id_motor
            WHERE r.id_marca = :idMarca
            AND r.id_modelo = :idModelo
            AND r.id_motor = :idMotor
        ");

        $stmt->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);
        $stmt->bindParam(":idModelo", $idModelo, PDO::PARAM_INT);
        $stmt->bindParam(":idMotor", $idMotor, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlObtenerRepuestosPorModelo(int $idModelo): array
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT r.*, mo.nombre_modelo
            FROM repuestos r
            JOIN modelos mo ON r.id_modelo = mo.id_modelo
            WHERE r.id_modelo = :idModelo
        ");

        $stmt->bindParam(":idModelo", $idModelo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlObtenerRepuestosPorMarca(int $idMarca): array
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT r.*, m.nombre_marca
            FROM repuestos r
            JOIN marcas m ON r.id_marca = m.id_marca
            WHERE r.id_marca = :idMarca
        ");

        $stmt->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlObtenerRepuestosPorCategoria(int $idCategoria): array
    {
        $stmt = Conexion::conectar()->prepare("
            SELECT r.*, c.nombre_categoria
            FROM repuestos r
            JOIN categorias c ON r.id_categoria = c.id_categoria
            WHERE r.id_categoria = :idCategoria
        ");

        $stmt->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
