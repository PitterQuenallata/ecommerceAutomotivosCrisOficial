$(document).ready(function () {


    obtenerCarrito_de_BaseDatos();

        

    

    
  // Inicializar el carrito al cargar la página
  cargarDatosCarrito();
  actualizarModalCarrito();
  actualizarContadorCarrito();
  actualizarTotalCarrito();


  // Manejar clic en "Añadir al carrito"
  $(document).on('click', '.add-to-cart-btn', function () {
      var idRepuesto = $(this).data('id-repuesto-add');

      // Obtenemos el nombre, precio, imagen y stock del repuesto
      var productCard = $(this).closest('.product__card');
      var nombre = productCard.find('.product__card--title a').text();
      var precio = productCard.find('.current__price').text().replace('$', '');
      var imagen = productCard.find('.product__primary--img').attr('src');
      var stock = productCard.data('stock-repuesto');
      var marca = productCard.data('marca-repuesto');
      var descripcion = productCard.data('descripcion-repuesto');

      // Crear un objeto con los datos del repuesto
      var repuesto = {
          id: idRepuesto,
          nombre: nombre,
          precio: parseFloat(precio),
          imagen: imagen,
          cantidad: 1,
          stock: stock,
          marca: marca,
          descripcion: descripcion
      };


      // Añadir el repuesto al carrito con validación de stock
      addToCart(repuesto);
      sincronizarConBaseDeDatos(repuesto.id, repuesto.cantidad);
  });

  // Función para añadir un producto al carrito con validación de stock
  function addToCart(repuesto) {
      var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

      var existe = carrito.find(item => item.id === repuesto.id);

      if (existe) {
          if (existe.cantidad < repuesto.stock) {
              existe.cantidad += 1;
          } else {
            fncToastr('warning', 'No puedes agregar más al carrito de ' + repuesto.stock + ' unidades de este producto.');
              
          }
      } else {
          if (repuesto.stock > 0) {
              carrito.push(repuesto);
          } else {
              fncToastr('warning', 'Este producto está fuera de stock.');
              
          }
      }
      //sincronizarConBaseDeDatos(repuesto.id, repuesto.cantidad);
      localStorage.setItem('carrito', JSON.stringify(carrito));
      sincronizarConBaseDeDatos(repuesto.id, repuesto.cantidad);
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

          var disableIncrease = repuesto.cantidad > repuesto.stock ? 'disabled' : '';
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
    //console.log('repuesto:', repuesto); // Verificar el repuesto encontrado
    //console.log('change:', change); // Verificar el valor de change

    if (repuesto) {
        if (change > 0 && repuesto.cantidad < repuesto.stock) {
            repuesto.cantidad += change;
            //.log('Cantidad aumentada:', repuesto.cantidad);
        } else if (change < 0 && repuesto.cantidad > 1) {
            repuesto.cantidad += change;
            //console.log('Cantidad disminuida:', repuesto.cantidad);
        } else if (change < 0 && repuesto.cantidad === 1) {
            carrito = carrito.filter(item => item.id !== id);
            //console.log('Producto eliminado del carrito');
        } else if (change > 0 && repuesto.cantidad >= repuesto.stock) {
            fncToastr('warning', 'No puedes agregar más de ' + repuesto.stock + ' unidades de este producto.');
            //console.log('No se puede agregar más, stock alcanzado');
            return;  // Detener la ejecución aquí para que no actualice el carrito si se alcanza el stock
        }

        // Sincronizar con la base de datos
        sincronizarConBaseDeDatos(id, repuesto.cantidad);
  
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
        // Sincronizar la eliminación con la base de datos
    sincronizarConBaseDeDatos(id, 0);  // 0 significa que el ítem debe ser eliminado
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

  $(document).on('click', '.continue__shopping--clear', function() {
    // Vaciar el carrito eliminando el item del localStorage

    vaciarCarrito(); //db vaicaiar carrito
    localStorage.removeItem('carrito');
    
    // Actualizar la interfaz de usuario
   
    actualizarContadorCarrito();
    actualizarTotalCarrito();
    actualizarModalCarrito();
    cargarDatosCarrito();

    // Mostrar un mensaje de confirmación al usuario
    fncToastr('success', 'Carrito vaciado con éxito.');
});

});



// $(document).ready(function() {
// // Manejar el envío del formulario de compra
// $(document).on('click', '#sincronizarCarrito', function () {
//     //console.log('Sincronizando carrito...');
//     //sincronizarCarrito_A_BaseDatos();
//     //obtenerCarrito_de_BaseDatos();
// });

// });

function sincronizarCarrito_A_BaseDatos() {
    var carrito = localStorage.getItem('carrito');
    //console.log(carrito);
    if (carrito) {
        $.ajax({
            url: "ajax/sincronizar_carrito.ajax.php",
            method: "POST",
            data: {
                carrito_local: carrito
            },
            dataType: "json",
            success: function(syncResponse) {
                //console.log(syncResponse);
                if(syncResponse.error === "noSession"){
                    fncToastr("warning", "No hay una sesión activa.");
                    return;

                }   
                if (syncResponse.success) {

                    fncToastr("success", "Carrito sincronizadoCarrito sincronizado con la base de datos.");
                    if (syncResponse.clearLocalStorage) {
                        localStorage.removeItem('carrito'); // Vaciar el carrito local
                        
                    }
                    if (syncResponse.alerts && syncResponse.alerts.length > 0) {
                        syncResponse.alerts.forEach(function(alert) {
                            fncToastr("warning", alert);
                        });
                    }
                } else {
                    fncToastr("error", syncResponse.error);
                }
            },
            error: function() {
                fncToastr("error", "Error en la sincronización del carrito.");
            }
        });
    }
}

//obtener
function obtenerCarrito_de_BaseDatos() {
    $.ajax({
        url: "ajax/obtener_carrito_db.ajax.php", // Cambia la URL si es necesario
        method: "POST",
        dataType: "json",
        success: function(syncResponse) {
            if(syncResponse.error === "noSession"){
                fncToastr("warning", "No hay una sesión activa.");
                return;
            }
            if (syncResponse.success) {
                localStorage.setItem('carrito', JSON.stringify(syncResponse.carrito));
                fncToastr("success", "Carrito actualizado desde la base de datos.");
            } else {
                fncToastr("error", syncResponse.error);
            }
        },
        error: function() {
            fncToastr("error", "Error al obtener el carrito desde la base de datos.");
        }
    });
}


function sincronizarConBaseDeDatos(id_repuesto, cantidad) {
    // var a = id_repuesto;
    // var cantidad = cantidad;
    //console.log(a, cantidad);
    $.ajax({
        url: 'ajax/sincronizar_carrito_sesion.ajax.php',
        method: 'POST',
        data: {
            id_repuesto: id_repuesto,
            cantidad: cantidad
        },
        dataType: 'json',
        success: function(response) {
            if (response.error === "noSession"){
                return;
            }
            if( response.success && response.alerts !== ""){
                fncToastr('success', response.alerts);
            }else {
                fncToastr('error', 'Error al sincronizar el carrito.');
            }
                
            
        },
        error: function() {
            fncToastr('error', 'Error en la comunicación con el servidor.');
        }
    });
}


function vaciarCarrito() {
    $.ajax({
        url: 'ajax/sincronizar_carrito_sesion.ajax.php',
        method: 'POST',
        data: {
            action: 'vaciar'  // Enviar la acción 'vaciar'
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Limpiar el localStorage y actualizar la UI
                localStorage.removeItem('carrito');
               
                fncToastr('success', response.alerts);
            } else {
                fncToastr('error', response.error);
            }
        },
        error: function() {
            fncToastr('error', 'Error en la comunicación con el servidor.');
        }
    });
}
