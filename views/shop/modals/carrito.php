<!-- Inicio del offCanvas minicart -->
<div class="offCanvas__minicart">
    <div class="minicart__header">
        <div class="minicart__header--top d-flex justify-content-between align-items-center">
            <h3 class="minicart__title">Carrito de Compras</h3>
            <button class="minicart__close--btn" aria-label="cerrar carrito" data-offcanvas>
                <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368" />
                </svg>
            </button>
        </div>
        <p class="minicart__header--desc">Tu Lista de repuestos</p>
    </div>
    <div class="minicart__product">
        <!-- Aquí se cargarán dinámicamente los productos -->
    </div>
    <div class="minicart__amount">
        <div class="minicart__amount_list d-flex justify-content-between">
            <span>Total:</span>
            <span><b id="total">$0.00</b></span>
        </div>
    </div>
    <div class="minicart__conditions text-center">
        <input class="minicart__conditions--input" id="accept" type="checkbox">
        <label class="minicart__conditions--label" for="accept">Estoy de acuerdo con la <a class="minicart__conditions--link" href="privacy-policy.html">Política de Privacidad</a></label>
    </div>
    <div class="minicart__button d-flex justify-content-center">
        <a class="primary__btn minicart__button--link" href="cart">Ver carrito</a>
        <a class="primary__btn minicart__button--link" href="checkout">Pagar</a>
    </div>
</div>
<!-- Fin del offCanvas minicart -->
