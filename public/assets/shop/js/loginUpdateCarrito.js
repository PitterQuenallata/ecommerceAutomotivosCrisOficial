$(document).ready(function() {
  $("#loginForm").submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize();
    console.log(formData);

    $.ajax({
        url: "ajax/login_cliente.ajax.php",
        method: "POST",
        data: formData,
        dataType: "json",
        success: function(response) {
            if (response.success) {
                // Mostrar una alerta de bienvenida
                fncToastr("success", "Bienvenido", "Has iniciado sesión exitosamente.");

                // Esperar un poco para que la alerta de bienvenida sea visible
                setTimeout(function() {
                    // Redirigir al usuario a la URL donde estaba
                    window.location.href = response.redirect_url || "home";
                }, 2000); // 2 segundos de retraso antes de redirigir
            } else {
                // Manejo del error de inicio de sesión
                fncToastr("error", response.error);
            }
        },
        error: function() {
            fncToastr("error", "Error", "Error en la comunicación con el servidor.");
        }
    });
});

  function sincronizarCarrito() {
    var carrito = localStorage.getItem('carrito');
    if (carrito) {
        $.ajax({
            url: "ajax/sincronizar_carrito.ajax.php",
            method: "POST",
            data: {
                carrito_local: carrito
            },
            dataType: "json",
            success: function(syncResponse) {
                if (syncResponse.success) {
                    if (syncResponse.clearLocalStorage) {
                        localStorage.removeItem('carrito'); // Vaciar el carrito local
                    }
                    if (syncResponse.alerts && syncResponse.alerts.length > 0) {
                        syncResponse.alerts.forEach(function(alert) {
                            fncToastr("warning", "Atención", alert);
                        });
                    }
                } else {
                    fncToastr("error", "Error", syncResponse.error);
                }
            },
            error: function() {
                fncToastr("error", "Error", "Error en la sincronización del carrito.");
            }
        });
    }
}

});
