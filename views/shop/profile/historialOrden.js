$(document).ready(function() {
  // Verificar si la DataTable ya está inicializada
  if (!$.fn.DataTable.isDataTable('#ordensTable')) {
    // Inicializar la DataTable para la tabla de órdenes
    $('#ordensTable').DataTable({
      ajax: {
        url: "/ajax/datatable-listaOrdenes.ajax.php",
        type: "POST",
        data: {
          action: "listarOrdenes"
        },
        dataSrc: "data"
      },
      deferRender: true,
      retrieve: true,
      processing: true,
      searching: false,
      order: [[1, 'desc']],
      language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior"
        },
        oAria: {
          sSortAscending: ": Activar para ordenar la columna de manera ascendente",
          sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
      },
      columns: [
        { data: "id_orden", className: "text-center" },
        { data: "fecha", className: "text-center" },
        { data: "estado", className: "text-center" },
        { data: "envio", className: "text-center" },
        { data: "total", className: "text-center" }
      ],
      destroy: true,
      createdRow: function(row, data, dataIndex) {

        // Llenar el tbody de móvil
        var mobileRow = `<tr class="account__table--body__child">
                            <td class="account__table--body__child--items">
                              <div><strong>Orden #:</strong> <a href="/profile/orden/detalle?idOrden=${data.id_orden}">#${data.id_orden}</a></div>
                              <div><strong>Fecha:</strong> ${data.fecha}</div>
                              <div><strong>Estado:</strong> ${data.estado}</div>
                              <div><strong>Envio:</strong> ${data.envio}</div>
                              <div><strong>Total:</strong> ${data.total}</div>
                            </td>
                          </tr>`;
        $('#ordensTableMobile').append(mobileRow);
      }
    });
  }
});
