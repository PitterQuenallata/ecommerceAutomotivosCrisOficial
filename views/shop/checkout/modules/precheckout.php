<div class="col-lg-10 col-md-6 d-flex justify-content-center align-items-center" >
  <aside class="checkout__sidebar sidebar border-radius-10">
    <h2 class="checkout__order--summary__title text-center mb-15">Orden</h2>
    <!-- Repuestos -->
    <div class="cart__table checkout__product--table">
      <table class="cart__table--inner">
        <tbody class="cart__table--body">

        </tbody>
      </table>
    </div>

<!-- ----------------------- -->

    <div class="checkout__total">
      <table class="checkout__total--table">
        <tbody class="checkout__total--body">
          <tr class="checkout__total--items">
            <td class="checkout__total--title text-left"></td>
            <td class="checkout__total--amount text-right"></td>
          </tr>
          <tr class="checkout__total--items">
            <td class="checkout__total--title text-left">Pasarela</td>
            <td class="checkout__total--calculated__text text-right">Se calcula en la siguiente pagina</td>
          </tr>
        </tbody>
        <tfoot class="checkout__total--footer">
          <tr class="checkout__total--footer__items">
            <td class="checkout__total--footer__title checkout__total--footer__list text-left">Total</td>
            <td class="checkout__total--footer__amount checkout__total--footer__list text-right"></td>
          </tr>
        </tfoot>
      </table>
    </div>


    <div class="payment__history mb-30">
      <h3 class="payment__history--title mb-20">Pagos</h3>
      <ul class="payment__history--inner d-flex">
        <li class="payment__history--list"><button class="payment__history--link primary__btn" type="submit">Tarjeta</button></li>
        <!-- <li class="payment__history--list"><button class="payment__history--link primary__btn" type="submit">Bank Transfer</button></li> -->
        <li class="payment__history--list"><button class="payment__history--link primary__btn" type="submit">Paypal</button></li>
      </ul>
    </div>


    <button class="checkout__now--btn primary__btn"  id="checkout-button">Pagar ahora</button>

  </aside>
</div>

<script>
  // Función para calcular el subtotal y el total del carrito
function calcularTotales() {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    let subtotal = 0;

    carrito.forEach(item => {
        subtotal += item.precio * item.cantidad;
    });

    // Llenar los valores en el HTML
    document.querySelector('.checkout__total--body .checkout__total--amount.text-right').textContent = `$${subtotal.toFixed(2)}`;
    document.querySelector('.checkout__total--footer__amount.checkout__total--footer__list.text-right').textContent = `$${subtotal.toFixed(2)}`;
}

// Ejecutar la función para calcular y llenar los totales
calcularTotales();

</script>