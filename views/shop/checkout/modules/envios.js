$(document).ready(function() {
  $('#continuar-compra').on('click', function(e) {
      e.preventDefault(); // Previene que el enlace actúe como tal

      // Capturar los datos del formulario
      var nombreEnvio = $('#nombreEnvio').val();
      var apellidoEnvio = $('#apellidoEnvio').val();
      var ciEnvio = $('#ciEnvio').val();
      var celularEnvio = $('#celularEnvio').val();
      var departamento = $('#departamento').val();
      var sucursal = $('#sucursal').val();

      // Validaciones opcionales aquí...
      console.log(nombreEnvio, apellidoEnvio, ciEnvio, celularEnvio, departamento, sucursal);
      // Enviar los datos mediante AJAX
      $.ajax({
          url: '/api/envios.ajax.php',
          type: 'POST',
          data: {
              nombreEnvio: nombreEnvio,
              apellidoEnvio: apellidoEnvio,
              ciEnvio: ciEnvio,
              celularEnvio: celularEnvio,
              departamento: departamento,
              sucursal: sucursal
          },
          success: function(response) {
              var data = JSON.parse(response);
              if (data.status === 'success') {
                  // Redirigir a la página de pagos
                  window.location.href = 'pagina_de_pago.php';
              } else {
                  // Manejar el error
                  alert(data.message);
              }
          },
          error: function(xhr, status, error) {
              console.error('Error:', error);
              alert('Error al procesar la solicitud. Por favor, intenta nuevamente.');
          }
      });
  });
});
