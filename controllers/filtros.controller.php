<?php
class ControladorFiltros
{

  public static function ctrObtenerRepuestosPorFiltros($idCategoria, $idMarca, $idModelo, $idMotor, $oemRepuesto)
  {

    if ($idCategoria != null && $idMarca != null && $idModelo != null && $idMotor != null) {
      return ModeloFiltros::mdlObtenerRepuestosPorMotorMarcaModeloCategoria($idCategoria, $idMarca, $idModelo, $idMotor);
    }
    if ($idCategoria != null && $idMarca) {
      return ModeloFiltros::mdlObtenerRepuestosPorCategoriayMarca($idCategoria, $idMarca);
    }
    if ($idCategoria != null && $idMarca != null && $idModelo != null) {
      return ModeloFiltros::mdlObtenerRepuestosPorCategoriaMarcaModelo($idCategoria, $idMarca, $idModelo);
    }

    if ($idMarca != null && $idModelo != null && $idMotor != null) {
      return ModeloFiltros::mdlObtenerRepuestosPorMotor( $idMarca, $idModelo, $idMotor);
    }
    //Filtrar por marca y modelo
    if ($idMarca != null && $idModelo != null) {
      return ModeloFiltros::mdlObtenerRepuestosPorModelo($idModelo);
    }
    if($idMarca!= null){
      return ModeloFiltros::mdlObtenerRepuestosPorMarca($idMarca);

    }
    if($idCategoria!= null){
      return ModeloFiltros::mdlObtenerRepuestosPorCategoria($idCategoria);
    }
  }


}
