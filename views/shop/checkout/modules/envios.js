$(document).ready(function() {
    $('#continuar-compra').on('click', function(e) {
        //e.preventDefault(); // Previene que el enlace actúe como tal
  
        // Capturar los datos del formulario
        var nombreEnvio = $('#nombreEnvio').val() || "";
        var apellidoEnvio = $('#apellidoEnvio').val() || "";
        var ciEnvio = $('#ciEnvio').val() || "";
        var celularEnvio = $('#celularEnvio').val() || "";

        var sucursal = $('#sucursal').val() || "";
        var direccionEnvio = $('#direccionEnvio').val() || "";

        var sucursalLlegada = sucursal; // Asumimos que esto es lo que se necesita
        var descripcion = "Repuesto"; // Asignar el valor o dejarlo vacío
        var cantidad = "1"; // Asignar el valor o dejarlo vacío
        var pesoPaquete = "1"; // Asignar el valor o dejarlo vacío
    

        // Guardar los datos en localStorage
        localStorage.setItem('envioData', JSON.stringify({
            nombreEnvio: nombreEnvio,
            apellidoEnvio: apellidoEnvio,
            ciEnvio: ciEnvio,
            celularEnvio: celularEnvio,
            sucursalLlegada: sucursalLlegada,
            direccionEnvio: direccionEnvio,
            descripcion: descripcion,
            cantidad: cantidad,
            pesoPaquete: pesoPaquete
        }));


    });
});
