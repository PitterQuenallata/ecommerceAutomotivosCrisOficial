<?php

require_once "conexion.php";

class ModeloOrdenes
{

    /*=============================================
    MOSTRAR ORDENES DE UN CLIENTE
    =============================================*/
    public static function mdlMostrarOrdenesyEnvio($id_cliente)
    {
        try {
            // Preparar la consulta con orden descendente por fecha
            $stmt = Conexion::conectar()->prepare("
              SELECT *
              FROM ordenes o
              INNER JOIN envios e 
              ON o.id_orden = e.id_orden
              WHERE o.id_cliente = :id_cliente
              ORDER BY o.fecha_orden DESC
          ");

            // Vincular el parámetro
            $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

            // Retornar los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Manejo de errores
            return "error: " . $e->getMessage();
        }
    }


    /*=============================================
    MOSTRAR detalle orden por id_cliente y id_orden
    =============================================*/
    public static function mdlMostrarDetalleOrden($id_cliente, $id_orden)
    {
        try {
            // Preparar la conexión a la base de datos
            $stmt = Conexion::conectar()->prepare("
            SELECT 
                o.id_orden,
                o.id_cliente,
                o.fecha_orden,
                o.estado_orden,
                o.total_orden,
                o.metodo_pago_orden,
                o.direccion_envio_orden,
                d.id_detalle_orden,
                d.id_repuesto,
                d.cantidad,
                d.precio,
                r.nombre_repuesto,
                r.descripcion_repuesto,
                e.id_envio,
                e.estado_envio,
                e.direccion_envio
            FROM 
                repuestoscris.ordenes o
            INNER JOIN 
                repuestoscris.detalles_orden d ON o.id_orden = d.id_orden
            INNER JOIN 
                repuestoscris.repuestos r ON d.id_repuesto = r.id_repuesto
            LEFT JOIN
                repuestoscris.envios e ON o.id_orden = e.id_orden
            WHERE 
                o.id_orden = :id_orden
                AND o.id_cliente = :id_cliente
        ");

            // Vincular los parámetros
            $stmt->bindParam(":id_orden", $id_orden, PDO::PARAM_INT);
            $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);

            // Ejecutar la consulta
            $stmt->execute();

            // Retornar los resultados como un arreglo asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Manejo de errores
            return "error: " . $e->getMessage();
        } finally {
            // Cerrar la conexión y liberar recursos
            $stmt->closeCursor();
            $stmt = null;
        }
    }

    /*=============================================
    MOSTRAR el ultimo id orden de un cliente
    =============================================*/
    public static function mdlObtenerUltimaOrdenPorCliente($idCliente)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id_orden FROM ordenes WHERE id_cliente = :id_cliente ORDER BY fecha_orden DESC LIMIT 1");
        $stmt->bindParam(":id_cliente", $idCliente, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['id_orden'];
        } else {
            return false;
        }
    }
}
