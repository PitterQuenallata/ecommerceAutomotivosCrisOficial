<?php
session_start();

// Comprueba si hay un mensaje de cancelación para mostrar
if (isset($_SESSION['payment_cancelled'])) {
    echo '<script>fncSweetAlert("error", "Pago cancelado");</script>';
    unset($_SESSION['payment_cancelled']); // Limpia el mensaje después de mostrarlo
}

?>


<main class="main__content_wrapper">
    <!-- Start checkout page area -->
    <h1>Cancelado</h1>
    <!-- End checkout page area -->
</main>
