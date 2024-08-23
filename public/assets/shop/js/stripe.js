// Inicializa Stripe con tu clave pública
var stripe = Stripe('pk_test_51PW9ic04RCXZmKruFMaaGFCR9gvxJIn7BCSH6b3TuJ25Ql72peN95XpTopTvnbeCWFyjO9IxgK0hhBV1FB2o0hQF00TBvIJfiw'); // Reemplaza con tu clave pública de Stripe

// Maneja el clic en el botón de pago
$('#checkout-button').on('click', function (e) {
  e.preventDefault(); // Previene el comportamiento predeterminado del botón
  console.log('click');

  // Recupera el carrito del localStorage
  var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

  // Si el carrito está vacío, mostrar una alerta y detener la ejecución
  if (carrito.length === 0) {
      alert('Tu carrito está vacío.');
      return;
  }

  // Realiza la solicitud AJAX para crear una sesión de Stripe Checkout
  $.ajax({
      url: '/ajax/create-checkout-session.php', // Ruta al archivo PHP que crea la sesión de Stripe
      method: 'POST',
      data: { carrito: carrito }, // Envía el carrito al servidor
      success: function (response) {
          console.log('Respuesta del servidor:', response); // Agrega este log para depuración
          
          // Asegúrate de que la respuesta sea interpretada como un objeto JSON
          var sessionId = JSON.parse(response).id;
          
          // Redirige a Stripe Checkout usando el sessionId recibido
          stripe.redirectToCheckout({ sessionId: sessionId }).then(function (result) {
            //eliminar carrito de local storage
            
            
              if (result.error) {
                  // Maneja cualquier error que ocurra durante la redirección
                  fncSweetAlert("error", result.error.message)
                  
              }
          });
      },
      error: function (jqXHR, textStatus, errorThrown) {
          // Maneja los errores de la solicitud AJAX
          console.error('Error en la solicitud AJAX: ', textStatus, errorThrown);
          alert('Hubo un problema al iniciar el pago. Por favor, inténtalo de nuevo.');
      }
  });
});

