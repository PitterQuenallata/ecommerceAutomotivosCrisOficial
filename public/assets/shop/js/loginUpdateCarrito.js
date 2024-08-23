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
                sincronizarCarrito_A_BaseDatos();
                obtenerCarrito_de_BaseDatos();
                //window.reload();
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
            fncToastr("error", "Error en la comunicación con el servidor.");
        }
    });
});

function sincronizarCarrito_A_BaseDatos() {
    var carrito = localStorage.getItem('carrito');
    console.log(carrito);
    if (carrito) {
        $.ajax({
            url: "ajax/sincronizar_carrito.ajax.php",
            method: "POST",
            data: {
                carrito_local: carrito
            },
            dataType: "json",
            success: function(syncResponse) {
                console.log(syncResponse);
                if (syncResponse.success) {
                    fncToastr("success", "Carrito sincronizadoCarrito sincronizado con la base de datos.");
                    if (syncResponse.clearLocalStorage) {
                        localStorage.removeItem('carrito'); // Vaciar el carrito local
                        
                    }
                    if (syncResponse.alerts && syncResponse.alerts.length > 0) {
                        syncResponse.alerts.forEach(function(alert) {
                            fncToastr("warning", alert);
                        });
                    }
                } else {
                    fncToastr("error", syncResponse.error);
                }
            },
            error: function() {
                fncToastr("error", "Error en la sincronización del carrito.");
            }
        });
    }
}


function obtenerCarrito_de_BaseDatos() {
    $.ajax({
        url: "ajax/obtener_carrito_db.ajax.php", // Cambia la URL si es necesario
        method: "POST",
        dataType: "json",
        success: function(syncResponse) {
            console.log(syncResponse);
            if (syncResponse.success) {
                localStorage.setItem('carrito', JSON.stringify(syncResponse.carrito));
                fncToastr("success", "Carrito actualizado desde la base de datos.");
            } else {
                fncToastr("error", syncResponse.error);
            }
        },
        error: function() {
            fncToastr("error", "Error al obtener el carrito desde la base de datos.");
        }
    });
}

});
