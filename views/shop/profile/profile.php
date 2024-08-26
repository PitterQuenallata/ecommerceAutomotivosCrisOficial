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
                        <li class="account__menu--list listaPerfilSelect"><a href="/profile/perfil">Cuenta</a></li>
                        <li class="account__menu--list listaPerfilSelect ordenSlidebar" id="listaHistorialOrden" ><a  href="/profile/orden">Ordenes</a></li>
                        <li class="account__menu--list listaPerfilSelect"><a href="/profile/direcciones">Historial</a></li>
                        <li class="account__menu--list"><a href="/salir">Cerrar sesión</a></li>
                    </ul>


                </div>

                <div class="account__wrapper">


                    <?php
                    /*=============================================
                    Lista blanca de url permitidas en el dashboard
                    =============================================*/
                    $pages = array(
                        "perfil" => "modules/perfil.php",
                        "orden" => "modules/orden.php",
                        "direcciones" => "modules/direcciones.php",
                        "success" => "modules/success.php",
                
                      );
                      if (!empty($routesArray[1])){
                        if (array_key_exists($routesArray[1], $pages)) {

                            include $pages[$routesArray[1]];
                        }else {
                            echo '<script>
                            window.location = "' . BASE_URL . 'views/shop/404/404";
                        </script>';
                        }
                      } else {

                        include "modules/perfil.php";
                    } ?>

                </div>




            </div>
        </div>

    </section>
    <!-- my account section end -->

</main>



<script src="<?= BASE_URL ?>public/assets/shop/js/perfil.js"></script>
<script src="<?= BASE_URL ?>views/shop/profile/historialOrden.js"></script>
<script src="<?= BASE_URL ?>views/shop/profile/detalleOrden.js"></script>

