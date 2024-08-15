<?php
require_once "conexion.php";

class ModeloCategorias {

    static public function mdlMostrarCategorias($tabla) {
        // Preparar la consulta para seleccionar todas las categorías y contar los repuestos asociados a cada una
        $stmt = Conexion::conectar()->prepare("
            SELECT 
                c.*, 
                COUNT(r.id_repuesto) AS cantidad_repuestos
            FROM 
                $tabla c
            LEFT JOIN 
                repuestos r ON c.id_categoria = r.id_categoria
            GROUP BY 
                c.id_categoria
        ");
        
        // Ejecutar la consulta
        $stmt->execute();

        // Retornar todos los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
