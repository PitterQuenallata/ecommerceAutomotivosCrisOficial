<?php
if (isset($_SESSION['cliente'])) {
    $cliente = $_SESSION['cliente'];
} elseif ($routesArray[0] == "profile" && !isset($_SESSION["cliente"])) {
    $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    echo '<script>
    window.location = "/login";
    </script>';
}

?>



<main class="main__content_wrapper">

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="/home">Incio</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Mi cuenta</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- my account section start -->
    <section class="my__account--section section--padding">
        <div class="container">
            <?php if (isset($_SESSION['cliente'])) {
                echo '<p class="account__welcome--text">
                    Hola, bienvenido ' . $_SESSION['cliente']['nombre_cliente'] . ' ' . $_SESSION['cliente']['apellido_cliente'] . ' </p>';
            } else {
                echo '<p class="account__welcome--text">Hola, bienvenido a tu cuenta</p>';
            }

            ?>


            <div class="my__account--section__inner border-radius-10 d-flex">
                <div class="account__left--sidebar">
                    <h2 class="account__content--title mb-20">Mi perfil</h2>
                    <ul class="account__menu">
                        <li class="account__menu--list listaPerfilSelect active"><a href="#">Cuenta</a></li>
                        <li class="account__menu--list listaPerfilSelect"><a href="#">Ordenes</a></li>
                        <li class="account__menu--list listaPerfilSelect"><a href="#">Historial</a></li>
                        <li class="account__menu--list"><a href="/salir">Cerrar sesión</a></li>
                    </ul>

                </div>

                <div class="account__wrapper">
                    <?php include "modules/perfil.php" ?>

                    <div class="account__content section__ordenes" style="display:none;">
                        <!-- Contenido de la sección "Ordenes" -->
                        <h2 class="account__content--title h3 mb-20">Orders History</h2>
                        <div class="account__table--area">
                            <table class="account__table">
                                <thead class="account__table--header">
                                    <tr class="account__table--header__child">
                                        <th class="account__table--header__child--items">Order</th>
                                        <th class="account__table--header__child--items">Date</th>
                                        <th class="account__table--header__child--items">Payment Status</th>
                                        <th class="account__table--header__child--items">Fulfillment Status</th>
                                        <th class="account__table--header__child--items">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="account__table--body mobile__none">
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">#2014</td>
                                        <td class="account__table--body__child--items">November 24, 2022</td>
                                        <td class="account__table--body__child--items">Paid</td>
                                        <td class="account__table--body__child--items">Unfulfilled</td>
                                        <td class="account__table--body__child--items">$40.00 USD</td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="account__content section__historial" style="display:none;">
                        <!-- Contenido de la sección "Historial" -->
                    </div>
                </div>




            </div>
        </div>

    </section>
    <!-- my account section end -->

</main>

<script src="<?= BASE_URL ?>public/assets/shop/js/perfil.js"></script>