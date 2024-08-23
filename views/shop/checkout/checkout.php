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
    $('#continuar-compra').on('click', function() {
        // Ocultar la sección de envío
        $('.direccionEnvio').hide();

        // Mostrar la sección de pago
        $('.checkout').show();
    });
});
</script>

