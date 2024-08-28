$(document).ready(function() {
  // Función para capturar parámetros GET de la URL
  function getParameterByName(name) {
    let url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
    let results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }

  // Capturar los parámetros idOrden y idCliente de la URL
  let idOrden = getParameterByName('idOrden');
  let idCliente = getParameterByName('idCliente');

  // Verificar que los parámetros existen
  if (idOrden && idCliente) {
    // Realizar la solicitud AJAX al archivo PHP
    $.ajax({
      url: '/ajax/detalle_orden.ajax.php',
      method: 'POST',
      data: {
        idOrden: idOrden,
        idCliente: idCliente
      },
      success: function(response) {
        let datos = JSON.parse(response);

        // Variables para sumar cantidades y obtener el total de la orden
        let sumaCantidad = 0;
        let totalCompra = datos.total_orden;  // Ajustado porque datos ya no es un array

        // Actualizar el número y la fecha de la orden
        $('#ordenNumero').text(`Orden # ${datos.id_orden}`);
        $('#ordenFecha').text(`Fecha de la orden: ${datos.fecha_orden}`);
        $('#estadoEnvio').text(`Estado de envío: ${datos.estadoPaquete}`);

        // Mostrar el mensaje de pago completado solo si el estado es "Completado"
        if (datos.estado_orden === 'Completado') {
          $('#paymentStatus').show();
        } else {
          $('#paymentStatus').hide();
        }

        // Limpiar las tablas antes de llenarlas
        $('#detalleOrdensTable').empty();

        // Asumiendo que los detalles están dentro de un array en datos.detalles (ajusta según la estructura real)
        datos.detalles.forEach(function(detalle, index) { 
          sumaCantidad += parseInt(detalle.cantidad); // Sumar la cantidad

          let row = `
            <tr class="account__table--body__child">
              <td class="account__table--body__child--items">#${index + 1}</td>
              <td class="account__table--body__child--items">${detalle.nombre_repuesto}</td>
              <td class="account__table--body__child--items">${detalle.cantidad}</td>
              <td class="account__table--body__child--items">${detalle.precio} USD</td>
              <td class="account__table--body__child--items">${detalle.precio * detalle.cantidad} USD</td>
            </tr>
          `;
          $('#detalleOrdensTable').append(row);
        });

        // Actualizar los totales en la sección debajo de la tabla
        $('#cantidadTotal').text(sumaCantidad);
        $('#totalCompra').text(totalCompra);
      },
      error: function() {
        alert('Error al obtener los detalles de la orden.');
      }
    });
  }
});
