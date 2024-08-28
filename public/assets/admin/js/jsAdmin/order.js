$(document).ready(function() {
  $('#tableOrders').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url": "/ajax/orders.ajax.php", // URL del archivo PHP que procesará la solicitud
          "type": "POST"
      },
      "columns": [
          { "data": "id_orden" },
          { "data": "fecha_orden" },
          { "data": "estado_orden" },
          { "data": "nombre_cliente" },
          { "data": "ci_cliente" },
          { "data": "cantidad_total" },
          { "data": "total_orden" },
          { "data": "codigo_envio" },
          { "data": "estado_envio" },
          { "data": "pasarela_pago" },
          {
              "data": "id_orden",
              "render": function(data, type, row) {
                  return `
                      <div class="dropdown">
                          <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                          <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                            <ul class="link-list-plain">
                              <li><a href="/admin/order/details?idOrder=${data}">Ver Detalles</a></li>
                              <li><a href="/admin/order/delete?idOrder=${data}">Eliminar</a></li>
                            </ul>
                          </div>
                      </div>`;
              }
          }
      ],
      "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json" // Para traducir DataTables al español
      }
  });
});
