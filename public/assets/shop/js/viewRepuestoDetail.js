$(document).ready(function () {
  // Función para abrir el modal y cargar los datos del repuesto
  $(document).on("click", ".view-details-btn", function () {
    var idRepuesto = $(this).data("id-repuesto-vista");
    var modal = $("#modal1");
    // console.log("idRepuesto:", idRepuesto);
    // Actualizar la URL sin recargar la página
    var url = new URL(window.location.href);
    url.searchParams.set("idRepuesto", idRepuesto);
    history.pushState(null, "", url.toString());

    // Hacer la petición AJAX para obtener los datos del repuesto
    $.ajax({
      url: "ajax/obtener_detalle_repuesto.ajax.php",
      method: "GET",
      data: { idRepuesto: idRepuesto },
      dataType: "json",
      success: function (response) {
        // Actualizar los elementos del modal con los datos recibidos
        
        modal.find(".product__details--info__title").text(response.nombre);
        modal.find(".current__price").text("$" + response.precio_actual);
        modal.find(".old__price").text("$" + response.precio_anterior);
        modal.find(".product__details--info__desc").text(response.descripcion);
        modal.find(".marca").text(response.marca);
        modal.find(".product__media--preview__items--img").attr(
          "src",
          response.imagen
        );
        modal.find(".product__media--preview__items--link").attr(
          "href",
          response.imagen
        );

        // Asigna el ID del repuesto al campo oculto
        $("#hidden_id_repuesto").val(response.id);
        $("#stock_repuesto").val(response.stock);
        // Mostrar el modal
        modal.addClass("is-visible");
      },
      error: function () {
        console.error("Error al obtener los detalles del repuesto.");
        // Opcional: mostrar un mensaje de error en la interfaz
      },
    });
  });

      // Cerrar el modal al hacer clic en el botón de cerrar
      $(document).on('click', '.close-modal', function (event) {
        event.stopPropagation(); // Prevenir propagación para que no cierre el modal al interactuar dentro de él
        $('#modal1').removeClass('is-visible');
    });

    // Evitar el cierre del modal cuando se interactúa con elementos internos
    $(document).on('click', '.quantity__value, .minicart__product--remove', function(event) {
        event.stopPropagation(); // Prevenir el cierre del modal
    });

    // Cerrar el modal al hacer clic fuera de él, pero no en los elementos internos
    $(document).on("click", function (event) {
        if (!$(event.target).closest(".modal-dialog, .view-details-btn").length) {
            $(".modal").removeClass("is-visible");
        }
    });

  


});




