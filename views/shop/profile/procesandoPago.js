document.addEventListener("DOMContentLoaded", function() {
    var countdownElement = document.getElementById('countdown');
    var completionMessage = document.getElementById('pagoRealizadoSuccess');
    var processingMessage = document.getElementById('procesandoOrden');
    
    // Función para obtener parámetros de la URL
    function getQueryParam(param) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    var idCliente = getQueryParam('idCliente'); // Recupera idCliente de la URL
    var timeLeft = 180; // 3 minutos en segundos
    var initialDelay = 10; // Esperar 10 segundos antes de hacer la primera consulta AJAX

    function updateCountdown() {
        var minutes = Math.floor(timeLeft / 60);
        var seconds = timeLeft % 60;

        countdownElement.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
        timeLeft--;

        if (timeLeft < 0) {
            clearInterval(timer);
            countdownElement.textContent = "Tiempo agotado. Intente nuevamente.";
        } else if (timeLeft === initialDelay) {
            checkOrderStatus();
        }
    }

    function checkOrderStatus() {
        fetch('/ajax/obtener_id_orden.php?&idCliente=' + idCliente)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar mensaje de proceso completado
                    countdownElement.style.display = 'none';
                    processingMessage.textContent = 'Proceso completado. Redirigiendo...';

                    // Redirigir después de 5 segundos
                    setTimeout(function() {
                        window.location.href = '/profile/orden/detalle?idOrden=' + data.idOrden + '&idCliente=' + idCliente;
                    }, 5000);
                } else {
                    setTimeout(checkOrderStatus, 10000); // Volver a verificar en 10 segundos si no se encontró la orden
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                setTimeout(checkOrderStatus, 10000); // Reintentar en caso de error
            });
    }

    var timer = setInterval(updateCountdown, 1000); // Actualizar cada segundo
});
