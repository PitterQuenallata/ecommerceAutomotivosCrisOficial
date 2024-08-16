<main class="main__content_wrapper">

    <!-- Start breadcrumb section -->
    <!-- <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title">Repuestos</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="index.html">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Product</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- End breadcrumb section -->

    <!-- Start shop section -->
    <div class="shop__section section--padding">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-xl-3 col-lg-4 shop-col-width-lg-4">
                    <div class="shop__sidebar--widget widget__area d-none d-lg-block">
                        <!-- Categorías -->
                        <div class="single__widget widget__bg">

                            <h2 class="widget__title h3">Categories</h2>


                            <div class="search__filter--select select">
                                <select class="search__filter--select__field" id="sidebarCategorySelect" name="sidebarCategorySelect">
                                    <option value="" selected disabled>Seleccione una Categoría</option>
                                    <?php
                                    $categorias = ControladorCategorias::ctrMostrarCategorias();
                                    foreach ($categorias as $categoria) {
                                        echo '<option value="' . $categoria["id_categoria"] . '">' . $categoria["nombre_categoria"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Filtrar por motor especifico -->

                        <div class="single__widget widget__bg">
                            <!-- Marcas -->
                            <h2 class="widget__title h3">Filtrar por Motor</h2>
                            <div class="search__filter--select select">
                                <select class="search__filter--select__field" id="sidebarBrandSelect" name="sidebarBrandSelect">
                                    <option value="" selected disabled>Seleccione una Marca</option>
                                    <?php
                                    $marcas = ControladorRepuestosCards::ctrMostrarMarcas();
                                    foreach ($marcas as $marca) {
                                        echo '<option value="' . $marca["id_marca"] . '">' . $marca["nombre_marca"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Modelos -->
                            <div class="search__filter--select select">
                                <select class="search__filter--select__field" id="sidebarModelSelect" name="sidebarModelSelect" disabled>
                                    <option value="" selected disabled>Seleccione un Modelo</option>
                                    <!-- Opciones generadas dinámicamente -->
                                </select>
                            </div>
                            <!-- Motor -->
                            <div class="search__filter--select select">
                                <select class="search__filter--select__field" id="sidebarMotorSelect" name="sidebarMotorSelect" disabled>
                                    <option value="" selected disabled>Seleccione un Motor</option>
                                    <!-- Opciones generadas dinámicamente -->
                                </select>
                            </div>

                        </div>


                    </div>
                </div>








                <!-- repuestos -->
                <div class="col-xl-9 col-lg-8 shop-col-width-lg-8">
                    <div class="shop__right--sidebar">

                        <div class="shop__product--wrapper">

                            <div class="shop__header d-flex align-items-center justify-content-between mb-30">
                                <div class="product__view--mode d-flex align-items-center">
                                    <div class="product__view--mode__list product__short--by align-items-center d-flex ">
                                        <label class="product__view--label">Repuesto</label>
                                    </div>
                                </div>
                            </div>


                            <div class="tab_content">
                                <div id="product_grid" class="tab_pane active show">
                                    <div class="product__section--inner">
                                        <div class="row mb--n30">
                                            <div class="col-lg-12 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                                <div id="productList" class="row">
                                                    <!-- Aquí se cargarán los productos filtrados -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End shop section -->

        <!-- Start shipping section -->
        <section class="shipping__section">
            <div class="container">
                <div class="shipping__inner style2 d-flex">
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="<?php BASE_URL ?>public/assets/shop/img/other/shipping1.webp" alt="icono-envio">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">Envío Gratis</h2>
                            <p class="shipping__content--desc">Envío gratis en compras superiores a $100</p>
                        </div>
                    </div>
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="<?php BASE_URL ?>public/assets/shop/img/other/shipping2.webp" alt="icono-soporte">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">Soporte 24/7</h2>
                            <p class="shipping__content--desc">Contáctanos las 24 horas del día</p>
                        </div>
                    </div>
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="<?php BASE_URL ?>public/assets/shop/img/other/shipping3.webp" alt="icono-reembolso">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">100% Reembolso</h2>
                            <p class="shipping__content--desc">Tienes 30 días para devolver</p>
                        </div>
                    </div>
                    <div class="shipping__items style2 d-flex align-items-center">
                        <div class="shipping__icon">
                            <img src="<?php BASE_URL ?>public/assets/shop/img/other/shipping4.webp" alt="icono-pago-seguro">
                        </div>
                        <div class="shipping__content">
                            <h2 class="shipping__content--title h3">Pago Seguro</h2>
                            <p class="shipping__content--desc">Aseguramos un pago seguro</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End shipping section -->

</main>





<script src="<?php BASE_URL?>public/assets/shop/js/manejarSelectsYUrl.js"></script>
