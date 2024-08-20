<?php
// Capturar los parámetros específicos de la URL
$idMarca = isset($_GET['idMarca']) ? $_GET['idMarca'] : null;
$idModelo = isset($_GET['idModelo']) ? $_GET['idModelo'] : null;
$idMotor = isset($_GET['idMotor']) ? $_GET['idMotor'] : null;
?>

<main class="main__content_wrapper">

  <!-- Start breadcrumb section -->
  <section class="breadcrumb__section breadcrumb__bg">
    <div class="container">
      <div class="row row-cols-1">
        <div class="col">
          <div class="breadcrumb__content text-center">
            <h1 class="breadcrumb__content--title">Categorias</h1>
            <ul class="breadcrumb__content--menu d-flex justify-content-center">
              <li class="breadcrumb__content--menu__items"><a href="home">Inicio</a></li>
              <li class="breadcrumb__content--menu__items"><span>Categorias</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End breadcrumb section -->

  <!-- Start shop section -->
  <div class="shop__section section--padding">
    <div class="container">
      <div class="row">

        <div class="col-xl-12 col-lg-8 shop-col-width-lg-8">
          <div class="shop__right--sidebar">
            <!-- Start categories section -->
            <div class="categories__shop mb-50">
              <div class="section__heading border-bottom mb-30">
                <h2 class="section__heading--maintitle"><span>Categorias</span></h2>
              </div>
              <ul class="categories__shop--inner">

                <?php
                $categorias = ControladorCategorias::ctrMostrarCategorias();
                foreach ($categorias as $categoria) {
                    $url = 'repuestos?idCategoria=' . $categoria['id_categoria'];

                    if ($idMarca) {
                        $url .= '&idMarca=' . $idMarca;
                    }
                    if ($idModelo) {
                        $url .= '&idModelo=' . $idModelo;
                    }
                    if ($idMotor) {
                        $url .= '&idMotor=' . $idMotor;
                    }

                    echo '<li class="categories__shop--card" data-idFiltroCategoria='.$categoria['id_categoria'].'>';
                    echo '    <a class="categories__shop--card__link " href="' . $url . '"  >';
                    echo '        <div class="categories__thumbnail mb-15">';
                    echo '            <img class="categories__thumbnail--img" src="'. BASE_URL.'public/assets/shop/img/categories/' . htmlspecialchars($categoria['img_categoria']) . '" alt="categories-img">';
                    echo '        </div>';
                    echo '        <div class="categories__content">';
                    echo '            <h2 class="categories__content--title">' . htmlspecialchars($categoria['nombre_categoria']) . '</h2>';
                    echo '            <span class="categories__content--subtitle">(' . htmlspecialchars($categoria['cantidad_repuestos']) . ' Items)</span>';
                    echo '        </div>';
                    echo '    </a>';
                    echo '</li>';
                }
                ?>

              </ul>
            </div>
            <!-- End categories section -->

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End shop section -->

</main>
