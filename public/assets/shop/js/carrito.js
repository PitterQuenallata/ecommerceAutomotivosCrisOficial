$(document).ready(function () {

  // Agregar producto al carrito
  $(document).on("click", ".add-to-cart-button", function () {
      const productId = $(this).data("idRepuestoSelect");
      const quantity = 1; // Cantidad fija (puede modificarse para ser dinámica)
      console.log(productId);
      $.ajax({
          url: 'ajax/gestionar_carrito.ajax.php',
          method: 'POST',
          data: {
              action: 'agregarProducto',
              idRepuesto: productId,
              cantidad: quantity
          },
          success: function (response) {
              console.log(response);
              cargarCarrito(); // Actualizar el carrito después de agregar un producto
          },
          error: function (error) {
              console.error('Error al agregar producto al carrito:', error);
          }
      });
  });

  // Cargar productos en el carrito
  function cargarCarrito() {
      $.ajax({
          url: 'ajax/cargar_carrito.ajax.php',
          method: 'POST',
          data: {
              action: 'obtenerCarrito'
          },
          success: function (response) {
              $('.minicart__product').html(response); // Renderizar los productos en el contenedor del carrito
          },
          error: function (error) {
              console.error('Error al cargar los productos del carrito:', error);
          }
      });
  }

  // Actualizar la cantidad de un producto en el carrito
  $(document).on("click", ".quantity__value", function () {
      const productId = $(this).closest(".minicart__product--items").data("product-id");
      const newQuantity = $(this).siblings(".quantity__number").val();

      $.ajax({
          url: 'ajax/gestionar_carrito.ajax.php',
          method: 'POST',
          data: {
              action: 'actualizarCantidad',
              idRepuesto: productId,
              nuevaCantidad: newQuantity
          },
          success: function (response) {
              console.log(response);
              cargarCarrito(); // Actualizar el carrito después de modificar la cantidad
          },
          error: function (error) {
              console.error('Error al actualizar la cantidad del producto en el carrito:', error);
          }
      });
  });

  // Eliminar un producto del carrito
  $(document).on("click", ".minicart__product--remove", function () {
      const productId = $(this).closest(".minicart__product--items").data("product-id");

      $.ajax({
          url: 'ajax/gestionar_carrito.ajax.php',
          method: 'POST',
          data: {
              action: 'eliminarProducto',
              idRepuesto: productId
          },
          success: function (response) {
              console.log(response);
              cargarCarrito(); // Actualizar el carrito después de eliminar un producto
          },
          error: function (error) {
              console.error('Error al eliminar el producto del carrito:', error);
          }
      });
  });

  // Cargar el carrito al cargar la página
  cargarCarrito();
});
