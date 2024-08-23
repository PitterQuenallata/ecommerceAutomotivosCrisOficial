
<main class="main__content_wrapper">
  <!-- cart section start -->
  <section class="cart__section section--padding">
    <div class="container-fluid">
      <div class="cart__section--inner">
        <form action="#">
          <h2 class="cart__title mb-30">Carrito de Compras</h2>
          <div class="row">
            <div class="col-lg-8">
              <div class="cart__table">
                <table class="cart__table--inner">
                  <thead class="cart__table--header">
                    <tr class="cart__table--header__items">
                      <th class="cart__table--header__list">Repuesto</th>
                      <th class="cart__table--header__list">Precio</th>
                      <th class="cart__table--header__list">Cantidad</th>
                      <th class="cart__table--header__list">Total</th>
                    </tr>
                  </thead>
                  <tbody class="cart__table--body">
                    <!-- Los productos se cargarán aquí dinámicamente -->
                  </tbody>
                </table>

                <div class="continue__shopping d-flex justify-content-between">
                  <a class="continue__shopping--link" href="shop.html">Continuar con la compra</a>
                  <button class="continue__shopping--clear" type="button">Vaciar Carrito</button>
                </div>
              </div>
            </div>

            <!-- Resumen de la compra -->
            <div class="col-lg-4">
              <div class="cart__summary border-radius-10">
                <div class="coupon__code mb-30">
                  <h3 class="coupon__code--title">Cupón</h3>
                  <p class="coupon__code--desc">Inserte un cupón válido</p>
                  <div class="coupon__code--field d-flex">
                    <label>
                      <input class="coupon__code--field__input border-radius-5" placeholder="Código de cupón" type="text">
                    </label>
                    <button class="coupon__code--field__btn primary__btn" type="submit">Aplicar Cupón</button>
                  </div>
                </div>
                <div class="cart__note mb-20">
                  <h3 class="cart__note--title">Nota</h3>
                  <p class="cart__note--desc">Añade instrucciones especiales para tu vendedor...</p>
                  <textarea class="cart__note--textarea border-radius-5"></textarea>
                </div>
                <div class="cart__summary--total mb-20">
                  <table class="cart__summary--total__table">
                    <tbody>
                      <tr class="cart__summary--total__list">
                        <td class="cart__summary--total__title text-left">SUBTOTAL</td>
                        <td class="cart__summary--amount text-right">$0.00</td>
                      </tr>
                      <tr class="cart__summary--total__list">
                        <td class="cart__summary--total__title text-left">TOTAL</td>
                        <td class="cart__summary--amount text-right">$0.00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="cart__summary--footer">
                  <p class="cart__summary--footer__desc">Envío e impuestos calculados al finalizar la compra</p>
                  <ul class="d-flex justify-content-between">
                    <li><button class="cart__summary--footer__btn primary__btn cart" id="sincronizarCarrito" type="button">Verificar Carrito</button></li>
                    <li><a class="cart__summary--footer__btn primary__btn checkout" href="checkout">Comprar</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- cart section end -->
</main>

