<?php
class ControladorFiltros
{
    public static function ctrObtenerRepuestosPorFiltros(?int $idCategoria, ?int $idMarca, ?int $idModelo, ?int $idMotor, ?string $oemRepuesto): array
    {
        // Filtrar por todos los parámetros
        if ($idCategoria && $idMarca && $idModelo && $idMotor) {
            return ModeloFiltros::mdlObtenerRepuestosPorMotorMarcaModeloCategoria($idCategoria, $idMarca, $idModelo, $idMotor);
        }

        // Filtrar por categoría y marca
        if ($idCategoria && $idMarca) {
            return ModeloFiltros::mdlObtenerRepuestosPorCategoriayMarca($idCategoria, $idMarca);
        }

        // Filtrar por categoría, marca y modelo
        if ($idCategoria && $idMarca && $idModelo) {
            return ModeloFiltros::mdlObtenerRepuestosPorCategoriaMarcaModelo($idCategoria, $idMarca, $idModelo);
        }

        // Filtrar por marca, modelo y motor
        if ($idMarca && $idModelo && $idMotor) {
            return ModeloFiltros::mdlObtenerRepuestosPorMotor($idMarca, $idModelo, $idMotor);
        }

        // Filtrar por modelo
        if ($idMarca && $idModelo) {
            return ModeloFiltros::mdlObtenerRepuestosPorModelo($idModelo);
        }

        // Filtrar por marca
        if ($idMarca) {
            return ModeloFiltros::mdlObtenerRepuestosPorMarca($idMarca);
        }

        // Filtrar por categoría
        if ($idCategoria) {
            return ModeloFiltros::mdlObtenerRepuestosPorCategoria($idCategoria);
        }

        return [];
    }
}
