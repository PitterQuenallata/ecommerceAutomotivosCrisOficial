<?php
// Redirigir al carrito si no hay session_id    
if (!isset($_GET['session_id'])) {
    echo '<script>
            window.location = "/cart";
            </script>';
    exit();
}
?>

<div class="account__content section__success" id="success">
    <div class="checkout__page--area section--padding d-flex justify-content-center align-items-center">
        <div class="container text-center">
            <div class="pagoRealizado border-radius-5 p-4">
                <div class="pagoRealizado--items" id="itemsProcensandoOrden">
                    <h3 class="pagoRealizado__title text-white mb-3" id="pagoRealizadoSuccess">¡Pago realizado con éxito!</h3>
                    <p class="pagoRealizado__title text-white mb-3" id="procesandoOrden">Procesando Orden...</p>
                    <p id="countdown" class="text-white mb-3"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var countdownElement = $('#countdown');
        var processingMessage = $('#procesandoOrden');
        var idCliente = new URLSearchParams(window.location.search).get('idCliente');

        // Restaurar tiempo restante desde localStorage o iniciar en 180 segundos
        var timeLeft = localStorage.getItem('timeLeft') ? parseInt(localStorage.getItem('timeLeft')) : 180;
        var initialDelay = 10; // Esperar 10 segundos antes de hacer la primera consulta AJAX

        // Mostrar alerta de éxito
        fncSweetAlert("success", "¡Pago realizado con éxito!");

        // Eliminar el carrito del localStorage
        localStorage.removeItem("carrito");

        function updateCountdown() {
            var minutes = Math.floor(timeLeft / 60);
            var seconds = timeLeft % 60;

            countdownElement.text(`${minutes}:${seconds < 10 ? '0' + seconds : seconds}`);
            timeLeft--;

            // Guardar el tiempo restante en localStorage
            localStorage.setItem('timeLeft', timeLeft);

            if (timeLeft < 0) {
                clearInterval(timer);
                countdownElement.text("Tiempo agotado. Intente nuevamente.");
                localStorage.removeItem('timeLeft'); // Eliminar el tiempo restante una vez agotado
            } else if (timeLeft % 10 === 0) { // Llama a la función AJAX cada 10 segundos
                console.log("Llamando a la función AJAX en " + timeLeft + " segundos restantes.");
                checkOrderStatus();
            }
        }

        function checkOrderStatus() {
            $.ajax({
                url: '/ajax/obtener_id_orden.php',
                type: 'GET',
                data: {
                    idCliente: idCliente
                },
                success: function(data) {
                    data = JSON.parse(data);
                    var idOrden = data.idOrden;
                    var envioData = JSON.parse(localStorage.getItem('envioData'));

                    // Hacer otra solicitud AJAX para enviar los datos de envío a la API
                    $.ajax({
                        url: '/api/envios.ajax.php',
                        type: 'POST',
                        data: {
                            envioData: JSON.stringify(envioData), // Los datos de envío del localStorage
                            idOrden: idOrden // El ID de la orden que recibes después del pago
                        },
                        success: function(response) {
                            var envioResponse = JSON.parse(response);
                            if (envioResponse.success) {
                                fncToastr("success",'Número de registro guardado correctamente:', envioResponse.nro_registro);
                            } else {
                                console.error('Error:', envioResponse.message);
                                fncToastr("error",'Hubo un problema al procesar el envío.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            fncToastr("error",'Error al procesar la solicitud. Por favor, intenta nuevamente.');
                        }
                    });

                    if (data.success) {
                        console.log('Redirigiendo a la orden...');
                        countdownElement.hide();
                        processingMessage.text('Proceso completado. Redirigiendo...');

                        // Eliminar el tiempo restante y redirigir después de 5 segundos
                        localStorage.removeItem('timeLeft');

                        // Usar replaceState para eliminar la URL actual del historial
                        history.replaceState(null, null, '/profile/orden/detalle?idOrden=' + data.idOrden + '&idCliente=' + idCliente);
                        setTimeout(function() {
                            window.location.href = '/profile/orden/detalle?idOrden=' + data.idOrden + '&idCliente=' + idCliente;
                        }, 5000);
                    } else {
                        setTimeout(checkOrderStatus, 10000); // Volver a verificar en 10 segundos si no se encontró la orden
                    }
                },
                error: function(error) {
                    setTimeout(checkOrderStatus, 10000); // Reintentar en caso de error
                }
            });
        }

        var timer = setInterval(updateCountdown, 1000); // Actualizar cada segundo

        // Desactivar el retroceso del navegador
        window.onpopstate = function(event) {
            // Redirigir al perfil o cualquier otra página segura si intentan volver atrás
            window.location.href = '/profile/orden';
        };

        // Otra opción: limpiar el historial para evitar volver al temporizador
        window.history.pushState(null, null, window.location.href);
        window.history.replaceState(null, null, window.location.href);
        window.addEventListener('popstate', function() {
            history.pushState(null, null, window.location.href);
        });
    });
</script>