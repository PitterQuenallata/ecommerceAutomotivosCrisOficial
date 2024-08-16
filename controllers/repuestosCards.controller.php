<?php
class ControladorRepuestosCards
{
  ///ya teniaaaaa
  // Método para mostrar las marcas de vehículos
  public static function ctrMostrarMarcas()
  {
    return ModeloRepuestosCards::mdlMostrarMarcas();
  }

  // Método para mostrar modelos basado en la marca
  public static function ctrMostrarModelos($idMarca)
  {
    return ModeloRepuestosCards::mdlMostrarModelos($idMarca);
  }


  // Método para mostrar motores basado en el modelo
  public static function ctrMostrarMotores($idModelo)
  {
    return ModeloRepuestosCards::mdlMostrarMotores($idModelo);
  }

  // Método para llamar al modelo y obtener los datos del repuesto
  public static function ctrMostrarRepuestoPorId($idRepuesto)
  {

    $respuesta = ModeloRepuestosCards::mdlMostrarRepuestosPorId($idRepuesto);

    return $respuesta;
  }
}
