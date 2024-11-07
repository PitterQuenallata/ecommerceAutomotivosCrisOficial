<?php

class ControladorOrdenes
{

    /*=============================================
MOSTRAR ORDENES por id_cliente y envio
=============================================*/
    public static function ctrMostrarOrdenesyEnvio($id_cliente)
    {
        // Obtener las órdenes del cliente desde la base de datos
        $respuesta = ModeloOrdenes::mdlMostrarOrdenesyEnvio($id_cliente);

        // Llamar a la API para obtener la información de los envíos
        $api = new ApiController();
        $envios = $api->getEnvios();

        // Recorrer cada orden obtenida de la base de datos
        foreach ($respuesta as $key => $orden) {

            // Inicializar estado de paquete como "Desconocido"
            $estadoPaquete = "Desconocido";

            // Recorrer los envíos obtenidos de la API para buscar coincidencias de nro_registro
            foreach ($envios as $envio) {
                if ($envio["nro_registro"] == $orden["nro_registro"]) {

                    // Asignar el estado del paquete basado en el valor obtenido de la API
                    switch ($envio["estadoPaquete"]) {
                        case 0:
                            $estadoPaquete = "Recepcionando inicial";
                            break;
                        case 1:
                            $estadoPaquete = "En camino";
                            break;
                        case 2:
                            $estadoPaquete = "Recepcionando final";
                            break;
                        case 3:
                            $estadoPaquete = "Entregado";
                            break;
                    }

                    // Salir del bucle una vez que se encuentra la coincidencia
                    break;
                }
            }

            // Añadir el estadoPaquete a la orden dentro de $respuesta
            $respuesta[$key]["estadoPaquete"] = $estadoPaquete;

            // Manejar el estado de la orden
            $respuesta[$key]["estado_orden"] = $orden["estado_orden"] == 1 ? "Pagado" : "Pendiente";

            // Formatear el total de la orden
            $respuesta[$key]["total_orden"] = number_format($orden["total_orden"], 2);
        }

        return $respuesta;
    }





/*=============================================
MOSTRAR DETALLE ORDEN por id_cliente y id_orden
=============================================*/
public static function ctrMostrarDetalleOrden($id_cliente, $id_orden)
{
    // Obtener el detalle de la orden del cliente desde la base de datos
    $respuesta = ModeloOrdenes::mdlMostrarDetalleOrden($id_cliente, $id_orden);

    // Llamar a la API para obtener la información de los envíos
    $api = new ApiController();
    $envios = $api->getEnvios();

    // Inicializar estado de paquete como "Desconocido"
    $estadoPaquete = "Desconocido";

    // Buscar el nro_registro en la respuesta de la API de envíos
    foreach ($respuesta as &$detalle) {
        foreach ($envios as $envio) {
            if ($envio["nro_registro"] == $detalle["nro_registro"]) {
                switch ($envio["estadoPaquete"]) {
                    case 0:
                        $detalle["estadoPaquete"] = "Recepcionando inicial";
                        break;
                    case 1:
                        $detalle["estadoPaquete"] = "En camino";
                        break;
                    case 2:
                        $detalle["estadoPaquete"] = "Recepcionando final";
                        break;
                    case 3:
                        $detalle["estadoPaquete"] = "Entregado";
                        break;
                    default:
                        $detalle["estadoPaquete"] = "Desconocido";
                        break;
                }
                break; // Salir del bucle una vez encontrada la coincidencia
            }
        }
        // Si no se encontró un estado de paquete, mantener "Desconocido"
        if (!isset($detalle["estadoPaquete"])) {
            $detalle["estadoPaquete"] = "Desconocido";
        }
    }

    // Agrupar la respuesta en una estructura organizada
    $detalleOrden = [
        "nro_orden" => $respuesta[0]["nro_registro"],
        "id_orden" => $respuesta[0]["id_orden"],
        "fecha_orden" => $respuesta[0]["fecha_orden"],
        "estado_orden" => $respuesta[0]["estado_orden"] == 1 ? "Completado" : "Pendiente",
        "total_orden" => number_format($respuesta[0]["total_orden"], 2),
        "metodo_pago_orden" => $respuesta[0]["metodo_pago_orden"],
        "direccion_envio_orden" => $respuesta[0]["direccion_envio_orden"],
        "estadoPaquete" => $respuesta[0]["estadoPaquete"], // Usamos el estadoPaquete del primer detalle
        "detalles" => []
    ];

    // Añadir los detalles de la orden
    foreach ($respuesta as $detalle) {
        $detalleOrden["detalles"][] = [
            "id_detalle_orden" => $detalle["id_detalle_orden"],
            "id_repuesto" => $detalle["id_repuesto"],
            "cantidad" => $detalle["cantidad"],
            "precio" => number_format($detalle["precio"], 2),
            "nombre_repuesto" => $detalle["nombre_repuesto"],
            "descripcion_repuesto" => $detalle["descripcion_repuesto"],
            "id_envio" => $detalle["id_envio"],
            "nro_registro" => $detalle["nro_registro"]
        ];
    }

    return $detalleOrden;
}

}
