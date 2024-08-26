<?php

class ControladorOrdenes
{

    /*=============================================
    MOSTRAR ORDENES por id_cliente y envio
    =============================================*/
    public static function ctrMostrarOrdenesyEnvio($id_cliente)
    {
        $respuesta = ModeloOrdenes::mdlMostrarOrdenesyEnvio($id_cliente);

        foreach ($respuesta as $key => $orden) {
            // Dejar la fecha tal como está en la base de datos
            $respuesta[$key]["fecha_orden"] = $orden["fecha_orden"];

            // Manejar el estado del envío
            switch ($orden["estado_envio"]) {
                case 0:
                    $respuesta[$key]["estado_envio"] = "Pendiente";
                    break;
                case 1:
                    $respuesta[$key]["estado_envio"] = "Enviado";
                    break;
                case 2:
                    $respuesta[$key]["estado_envio"] = "Entregado";
                    break;
                default:
                    $respuesta[$key]["estado_envio"] = "Desconocido";
                    break;
            }

            // Manejar el estado de la orden
            $respuesta[$key]["estado_orden"] = $orden["estado_orden"] == 1 ? "Pagado" : "Pendiente";

            // Formatear el total de la orden
            $respuesta[$key]["total_orden"] = number_format($orden["total_orden"], 2);
        }

        return $respuesta;
    }

    /*=============================================
    MOSTRAR detalle ORDEN por id_cliente y id_orden
    =============================================*/

    public static function ctrMostrarDetalleOrden($id_cliente, $id_orden)
    {
        $respuesta = ModeloOrdenes::mdlMostrarDetalleOrden($id_cliente, $id_orden);
        return $respuesta;
    }

}
