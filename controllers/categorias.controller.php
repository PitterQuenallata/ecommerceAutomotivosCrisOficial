<?php
// En tu controlador de categorías
class ControladorCategorias {

    static public function ctrMostrarCategorias() {
        $tabla = "categorias";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla);
        return $respuesta;
    }


}
