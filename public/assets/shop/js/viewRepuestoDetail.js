$(document).ready(function () {
  actualizarContadorCarrito();
  actualizarTotalCarrito();

  // Función para cargar los datos del repuesto, usada tanto en el modal como en la página de detalles
  function cargarDatosRepuesto(idRepuesto, isModal = false) {
    $.ajax({
      url: "ajax/obtener_detalle_repuesto.ajax.php",
      method: "GET",
      data: { idRepuesto: idRepuesto },
      dataType: "json",
      success: function (response) {
        //console.log(response);
        var container = isModal ? $("#modal1") : $(document);

        container.find(".product__details--info__title").text(response.nombre);
        container.find(".current__price").text("BS" + response.precio_actual);
        container.find(".old__price").text("BS" + response.precio_anterior);
        container.find(".product__details--info__desc").text(response.descripcion);
        container.find(".product__media--preview__items--img").attr("src", response.imagen);
        container.find(".marcaRepuesto").text(response.marca);
        // Asignar el valor al input oculto
        $("#precio_repuesto").val(response.precio_actual);
        // Asignar el valor al input oculto
        //$("#marca_repuesto").val(response.marca);

        if (isModal) {
          $("#hidden_id_repuesto").val(response.id);
          $("#stock_repuesto").val(response.stock);
        } else {
          $('#quantity').val(1);
          $('#hidden_id_repuesto').val(response.id);
          $('#stock_repuesto').val(response.stock);
        }
      },
      error: function () {
        fncToastr('error', 'Error al obtener los detalles del repuesto.');
        console.error("Error al obtener los detalles del repuesto.");
      },
    });
  }

  // Función para manejar la cantidad con validación de stock
  function manejarCantidad() {
    $('.quantity-right-plus').click(function(e){
      e.preventDefault();
      var quantity = parseInt($('#quantity').val());
      var stock = parseInt($('#stock_repuesto').val());

      if (quantity < stock) {
        $('#quantity').val(quantity + 1);
      } else {
        fncToastr('warning', 'No puedes añadir más productos de los que hay en stock.');
      }
    });

    $('.quantity-left-minus').click(function(e){
      e.preventDefault();
      var quantity = parseInt($('#quantity').val());

      if (quantity > 1) {
        $('#quantity').val(quantity - 1);
      }
    });
  }

  // Función para añadir el producto al carrito
  function añadirAlCarrito(event, isModal = false) {
    event.preventDefault();
    let precio_repuesto = parseFloat($("#precio_repuesto").val());
    //console.log(precio_repuesto);
    var repuesto = {
        id: parseInt($('#hidden_id_repuesto').val(), 10),
        nombre: $('.product__details--info__title').text(),
        precio: (precio_repuesto),  
        imagen: $('.product__media--preview__items--img').attr('src'),
        cantidad: parseInt($('#quantity').val(), 10),
        stock: parseInt($('#stock_repuesto').val(), 10),
        marca: $(".marcaRepuesto").text(),
        descripcion: $(".product__details--info__desc").text(),

    };
    //console.log(repuesto);
    if (isNaN(repuesto.precio) || repuesto.precio <= 0) {
        fncToastr('warning', 'El precio del producto no es válido. No se puede añadir al carrito.');
        return;
    }

    if (repuesto.cantidad <= 0) {
        fncToastr('warning', 'No puedes añadir 0 productos al carrito.');
        return;
    }
    
    var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    var existe = carrito.find(item => item.id === repuesto.id);

    if (existe) {
        if (existe.cantidad + repuesto.cantidad <= repuesto.stock) {
            existe.cantidad += repuesto.cantidad;
        } else {
            fncToastr('warning', 'No puedes añadir más productos de los que hay en stock.');
            return;
        }
    } else {
        carrito.push(repuesto);
    }

    localStorage.setItem('carrito', JSON.stringify(carrito));
    fncToastr('success', 'Producto añadido al carrito con éxito.');
    sincronizarConBaseDeDatos(repuesto.id, repuesto.cantidad);
    if (isModal) {
        $('#modal1').removeClass('is-visible');
    }
    actualizarContadorCarrito();
    actualizarTotalCarrito();
  }

  // Manejar el clic en el botón de vista rápida para abrir el modal
  $(document).on("click", ".view-details-btn", function () {
    var idRepuesto = parseInt($(this).data("id-repuesto-vista"), 10);
    cargarDatosRepuesto(idRepuesto, true);
    $("#modal1").addClass("is-visible");
  });

  // Cargar los detalles del repuesto en la página de detalles si existe el ID en la URL
  var urlParams = new URLSearchParams(window.location.search);
  var idRepuesto = urlParams.get('idRepuesto');
  if (idRepuesto) {
    cargarDatosRepuesto(parseInt(idRepuesto, 10));
  }

  // Llamar a la función para manejar la cantidad cuando la página se carga
  manejarCantidad();

  // Manejar el clic en el botón de añadir al carrito tanto en la página de detalles como en el modal
  $(document).on('click', '.quickview__cart--btn', function(event) {
    añadirAlCarrito(event, $(this).closest("#modal1").length > 0);
    actualizarContadorCarrito();
    actualizarTotalCarrito();
  });

  // Cerrar el modal al hacer clic en el botón de cerrar
  $(document).on('click', '.close-modal', function (event) {
    event.stopPropagation(); 
    $('#modal1').removeClass('is-visible');
  });

  // Evitar el cierre del modal cuando se interactúa con elementos internos
  $(document).on('click', '.quantity__value, .minicart__product--remove', function(event) {
    event.stopPropagation();
  });

  // Cerrar el modal al hacer clic fuera de él, pero no en los elementos internos
  $(document).on("click", function (event) {
    if (!$(event.target).closest(".modal-dialog, .view-details-btn").length) {
      $(".modal").removeClass("is-visible");
    }
  });

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
});
