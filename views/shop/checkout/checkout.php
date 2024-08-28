<main class="main__content_wrapper">
    <!-- Start checkout page area -->
    <div class="checkout__page--area section--padding">
        <div class="container">
            <div class="row">
                <div class="direccionEnvio" style="display: block;">
                    <?php include "modules/envio.php"; ?>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="checkout" style="display: none;">
                    <?php include "modules/precheckout.php"; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End checkout page area -->
</main>

<script>
$(document).ready(function() {
    $('#continuar-compra').on('click', function(e) {
        e.preventDefault();

        // Obtener el formulario que contiene los campos de envío
        var form = document.querySelector('.needs-validation');
        
        // Verificar si el formulario es válido
        if (form.checkValidity() === false) {
            form.classList.add('was-validated');
            return; // Detener si el formulario no es válido
        }

        // Si el formulario es válido, continuar con la lógica
        $('.direccionEnvio').hide();  // Ocultar la sección de envío
        $('.checkout').show();         // Mostrar la sección de pago
    });
});

</script>

