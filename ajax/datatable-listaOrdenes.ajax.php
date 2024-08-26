<?php
require_once "../controllers/ordenes.controller.php";
require_once "../models/ordenes.model.php";
require_once "../models/envios.model.php";
session_start();

class TablaOrdenes {

    /*=============================================
    MOSTRAR LA TABLA DE ORDENES
    =============================================*/
    public function mostrarTablaOrdenes() {

        $id_cliente = $_SESSION['id_cliente'];
        $ordenes = ControladorOrdenes::ctrMostrarOrdenesyEnvio($id_cliente);

        $datosJson = '{ "data": [ ';

        foreach ($ordenes as $key => $orden) {
            $datosJson .= '{
                "id_orden": "<a href=\"/profile/orden/detalle?idOrden=' . $orden["id_orden"] . '&idCliente=' . $id_cliente . '\">Ver # ' . $orden["id_orden"] . '</a>",
                "fecha": "' . $orden["fecha_orden"] . '",
                "estado": "' . $orden["estado_orden"] . '",
                "envio": "' . $orden["estado_envio"] . '",
                "total": "$' . number_format($orden["total_orden"], 2) . ' USD"
            },';
        }

        $datosJson = substr($datosJson, 0, -1);
        $datosJson .= ']}';

        echo $datosJson;
    }
}

/*=============================================
MANEJAR LA SOLICITUD AJAX
=============================================*/
if (isset($_POST['action']) && $_POST['action'] == 'listarOrdenes') {
    $tablaOrdenes = new TablaOrdenes();
    $tablaOrdenes->mostrarTablaOrdenes();
} else {
    echo '{ "data": [] }'; // En caso de que la acción no sea reconocida
}
?>
