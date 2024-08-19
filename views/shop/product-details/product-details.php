<main class="main__content_wrapper">

  <!-- Start breadcrumb section -->
  <section class="breadcrumb__section breadcrumb__bg">
    <div class="container">
      <div class="row row-cols-1">
        <div class="col">
          <div class="breadcrumb__content text-center">
            <ul class="breadcrumb__content--menu d-flex justify-content-center">
              <li class="breadcrumb__content--menu__items"><a href="/">Inicio</a></li>
              <li class="breadcrumb__content--menu__items"><span>Detalles del Repuesto</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End breadcrumb section -->

  <!-- Start product details section -->
  <section class="product__details--section section--padding">
    <div class="container">
      <div class="row row-cols-lg-2 row-cols-md-2">
        <div class="col">
          <div class="quickview__gallery align-items-center">
            <img class="product__media--preview__items--img" src="#" alt="product-media-img" style="width: 100%; max-width: 100%;">
          </div>
        </div>

        <div class="col">
          <div class="product__details--info">
            <form action="">
              <h2 class="product__details--info__title mb-15">Nombre del Repuesto</h2>
              <div class="product__details--info__price mb-12">
                <span class="current__price">$0.00</span>
                <span class="old__price">$0.00</span>
              </div>

              <p class="product__details--info__desc mb-15">Descripción del repuesto.</p>
              <div class="product__variant">

                <div class="product__variant--list quantity d-flex align-items-center mb-20">
                  <div class="col-lg-2">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                          <span class="glyphicon glyphicon-minus"></span>
                        </button>
                      </span>
                      <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                      <span class="input-group-btn">
                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                          <span class="glyphicon glyphicon-plus"></span>
                        </button>
                      </span>
                    </div>
                  </div>
                  <button class="primary__btn quickview__cart--btn" type="submit">Añadir al Carrito</button>
                </div>
                <div class="product__variant--list mb-15">
                  <button class="variant__buy--now__btn primary__btn" type="submit">Comprar Ahora</button>
                </div>

              </div>
              <div class="quickview__social d-flex align-items-center mb-15">
                <label class="quickview__social--title">Compartir:</label>
                <ul class="quickview__social--wrapper mt-0 d-flex">
                  <li class="quickview__social--list">
                    <a class="quickview__social--icon" target="_blank" href="https://www.facebook.com">
                      <i class="fa-brands fa-facebook-f"></i>
                      <span class="visually-hidden">Facebook</span>
                    </a>
                  </li>
                  <li class="quickview__social--list">
                    <a class="quickview__social--icon" target="_blank" href="https://twitter.com">
                      <i class="fab fa-twitter"></i>
                      <span class="visually-hidden">Twitter</span>
                    </a>
                  </li>
                  <li class="quickview__social--list">
                    <a class="quickview__social--icon" target="_blank" href="https://www.instagram.com">
                      <i class="fab fa-instagram"></i>
                      <span class="visually-hidden">Instagram</span>
                    </a>
                  </li>
                  <li class="quickview__social--list">
                    <a class="quickview__social--icon" target="_blank" href="https://www.youtube.com">
                      <i class="fab fa-youtube"></i>
                      <span class="visually-hidden">Youtube</span>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="guarantee__safe--checkout">
                <h5 class="guarantee__safe--checkout__title">Links de redes sociales</h5>
                <img class="guarantee__safe--checkout__img" src="<?php BASE_URL ?>public/assets/shop/img/other/safe-checkout.webp" alt="Payment Image">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End product details section -->

</main>