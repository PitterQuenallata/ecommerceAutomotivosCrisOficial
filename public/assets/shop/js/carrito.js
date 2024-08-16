$(document).ready(function () {
  // Inicializar el carrito al cargar la página
  actualizarModalCarrito();
  actualizarContadorCarrito();
  actualizarTotalCarrito();
  cargarDatosCarrito();

  // Manejar clic en "Añadir al carrito"
  $(document).on('click', '.add-to-cart-btn', function () {
      var idRepuesto = $(this).data('id-repuesto-add');

      // Obtenemos el nombre, precio, imagen y stock del repuesto
      var productCard = $(this).closest('.product__card');
      var nombre = productCard.find('.product__card--title a').text();
      var precio = productCard.find('.current__price').text().replace('$', '');
      var imagen = productCard.find('.product__primary--img').attr('src');
      var stock = productCard.data('stock-repuesto');

      // Crear un objeto con los datos del repuesto
      var repuesto = {
          id: idRepuesto,
          nombre: nombre,
          precio: parseFloat(precio),
          imagen: imagen,
          cantidad: 1,
          stock: stock
      };

      // Añadir el repuesto al carrito con validación de stock
      addToCart(repuesto);
  });

  // Función para añadir un producto al carrito con validación de stock
  function addToCart(repuesto) {
      var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

      var existe = carrito.find(item => item.id === repuesto.id);

      if (existe) {
          if (existe.cantidad < repuesto.stock) {
              existe.cantidad += 1;
          } else {
              alert('No puedes agregar más de ' + repuesto.stock + ' unidades de este producto.');
          }
      } else {
          if (repuesto.stock > 0) {
              carrito.push(repuesto);
          } else {
              alert('Este producto está fuera de stock.');
          }
      }

      localStorage.setItem('carrito', JSON.stringify(carrito));
      actualizarContadorCarrito();
      actualizarTotalCarrito();
      actualizarModalCarrito();
  }

  // Función para actualizar el contenido del modal del carrito
  function actualizarModalCarrito() {
      var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
      var modalCarrito = $('.minicart__product');
      modalCarrito.empty();

      var subtotal = 0;

      carrito.forEach(function (repuesto) {
          var totalItem = repuesto.precio * repuesto.cantidad;
          subtotal += totalItem;

          modalCarrito.append(`
              <div class="minicart__product--items d-flex">
                  <div class="minicart__thumb">
                      <a href="product-details.html"><img src="${repuesto.imagen}" alt="${repuesto.nombre}"></a>
                  </div>
                  <div class="minicart__text">
                      <h4 class="minicart__subtitle"><a href="product-details.html">${repuesto.nombre}</a></h4>
                      <div class="minicart__price">
                          <span class="minicart__current--price">$${repuesto.precio.toFixed(2)}</span>
                      </div>
                      <div class="minicart__text--footer d-flex align-items-center">
                          <div class="quantity__box minicart__quantity">
                              <button type="button" class="quantity__value decrease" aria-label="quantity value" value="Decrease Value" data-id="${repuesto.id}">-</button>
                              <label>
                                  <input type="number" class="quantity__number" value="${repuesto.cantidad}" data-id="${repuesto.id}" data-counter />
                              </label>
                              <button type="button" class="quantity__value increase" aria-label="quantity value" value="Increase Value" data-id="${repuesto.id}">+</button>
                          </div>
                          <button class="minicart__product--remove" type="button" data-id="${repuesto.id}">Remove</button>
                      </div>
                  </div>
              </div>
          `);
      });

      $('#total').text(`$${subtotal.toFixed(2)}`);
  }

  // Función para cargar y mostrar los datos del carrito en la página cart.php
  function cargarDatosCarrito() {
      var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
      var carritoTabla = $('.cart__table--body');
      carritoTabla.empty();

      var subtotal = 0;

      carrito.forEach(function (repuesto) {
          var totalItem = repuesto.precio * repuesto.cantidad;
          subtotal += totalItem;

          var disableIncrease = repuesto.cantidad >= repuesto.stock ? 'disabled' : '';
          var disableDecrease = repuesto.cantidad <= 1 ? 'disabled' : '';

          carritoTabla.append(`
              <tr class="cart__table--body__items">
                  <td class="cart__table--body__list">
                      <div class="cart__product d-flex align-items-center">
                          <button class="cart__remove--btn" aria-label="remove item" data-id="${repuesto.id}" type="button">
                              <i class="fas fa-times" style="font-size: 16px;"></i>
                          </button>
                          <div class="cart__thumbnail">
                              <a href="product-details.html"><img class="border-radius-5" src="${repuesto.imagen}" alt="${repuesto.nombre}"></a>
                          </div>
                          <div class="cart__content">
                              <h3 class="cart__content--title h4"><a href="product-details.html">${repuesto.nombre}</a></h3>
                              <span class="cart__content--variant">Marca: ${repuesto.marca}</span>
                              <span class="cart__content--variant">Descripción: ${repuesto.descripcion}</span>
                          </div>
                      </div>
                  </td>
                  <td class="cart__table--body__list">
                      <span class="cart__price">$${repuesto.precio.toFixed(2)}</span>
                  </td>
                  <td class="cart__table--body__list">
                      <div class="quantity__box">
                          <button type="button" class="quantity__value decrease" aria-label="quantity value" value="Decrease Value" data-id="${repuesto.id}" ${disableDecrease}>-</button>
                          <label>
                              <input type="number" class="quantity__number" value="${repuesto.cantidad}" data-id="${repuesto.id}" data-counter />
                          </label>
                          <button type="button" class="quantity__value increase" aria-label="quantity value" value="Increase Value" data-id="${repuesto.id}" ${disableIncrease}>+</button>
                      </div>
                  </td>
                  <td class="cart__table--body__list">
                      <span class="cart__price">$${totalItem.toFixed(2)}</span>
                  </td>
              </tr>
          `);
      });

      $('.cart__summary--amount.text-right').text(`$${subtotal.toFixed(2)}`);
  }

  // Event listeners para los botones de aumentar/disminuir cantidad y eliminar del carrito
  $(document).on('click', '.quantity__value.decrease', function () {
      var id = $(this).data('id');
      updateCartItem(id, -1);
  });

  $(document).on('click', '.quantity__value.increase', function () {
      var id = $(this).data('id');
      updateCartItem(id, 1);
  });

  $(document).on('click', '.minicart__product--remove, .cart__remove--btn', function () {
      var id = $(this).data('id');
      removeCartItem(id);
  });

  // Función para actualizar la cantidad de un ítem en el carrito con validación de stock
  function updateCartItem(id, change) {
      var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
      var repuesto = carrito.find(item => item.id === id);

      if (repuesto) {
          if (change > 0 && repuesto.cantidad < repuesto.stock) {
              repuesto.cantidad += change;
          } else if (change < 0 && repuesto.cantidad > 1) {
              repuesto.cantidad += change;
          } else if (change < 0 && repuesto.cantidad === 1) {
              carrito = carrito.filter(item => item.id !== id);
          } else {
              alert('No puedes agregar más de ' + repuesto.stock + ' unidades de este producto.');
          }

          localStorage.setItem('carrito', JSON.stringify(carrito));
          actualizarContadorCarrito();
          actualizarTotalCarrito();
          actualizarModalCarrito();
          cargarDatosCarrito();
      }
  }

  // Función para eliminar un ítem del carrito
  function removeCartItem(id) {
      var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
      carrito = carrito.filter(item => item.id !== id);
      localStorage.setItem('carrito', JSON.stringify(carrito));
      actualizarContadorCarrito();
      actualizarTotalCarrito();
      actualizarModalCarrito();
      cargarDatosCarrito();
  }

  // Función para actualizar el contador de ítems en el carrito
  function actualizarContadorCarrito() {
      var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
      var totalItems = carrito.reduce((total, item) => total + item.cantidad, 0);
      $('.items__count').text(totalItems);
  }

  // Función para actualizar el total del carrito
  function actualizarTotalCarrito() {
      var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
      var total = carrito.reduce((total, item) => total + item.precio * item.cantidad, 0);
      $('.minicart__btn--text__price').text(`$${total.toFixed(2)}`);
  }

  // Cargar los datos del carrito al cargar la página cart.php
  cargarDatosCarrito();

  // Opcional: Añadir eventos para actualizar la vista del carrito si se hacen cambios desde otro archivo JS.
  $(window).on('storage', function () {
      cargarDatosCarrito();
      actualizarModalCarrito();
  });

  // Llamar a la función para actualizar el carrito cuando se abra el modal
  $('.minicart__open--btn').on('click', function () {
      actualizarModalCarrito();
  });
});
