<?php
class ControladorCarritoSesion
{


  // Añadir o actualizar un ítem en el carrito
  public static function ctrAgregarAlCarrito($id_cliente, $id_repuesto, $cantidad)
  {
    // Preparar los datos del ítem
    $item = [
      "id_repuesto" => $id_repuesto,
      "cantidad" => $cantidad
    ];

    // Llamar al modelo para agregar o actualizar el ítem en el carrito
    return ModeloCarritoSession::mdlAgregarActualizarCarrito($id_cliente, $item);
  }

  // Eliminar un ítem del carrito
  public static function ctrEliminarItemCarrito($id_cliente, $id_repuesto)
  {
    // Llamar al modelo para eliminar el ítem del carrito
    return ModeloCarritoSession::mdlEliminarProducto($id_cliente, $id_repuesto);
  }

  // Obtener todo el carrito del cliente
  public static function ctrObtenerCarrito($id_cliente)
  {
    return ModeloCarritoSession::mdlObtenerCarrito($id_cliente);
  }

  // Método para vaciar el carrito del cliente
  public static function ctrVaciarCarrito($id_cliente)
  {
    return ModeloCarritoSession::mdlVaciarCarrito($id_cliente);
  }
}
