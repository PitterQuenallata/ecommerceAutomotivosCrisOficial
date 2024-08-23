<?php
$usuario = $_SESSION['cliente'];

?>

<div class="col-lg-11 col-md-6 justify-content-center align-items-center"   >
  <div class="main checkout__mian ">
    <form>

      <div class="checkout__content--step section__shipping--address">
        <div class="section__header mb-25">
          <h2 class="section__header--title h3">Datos de envio</h2>
        </div>
        <div class="section__shipping--address__content">
          <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 mb-5">
              <div class="checkout__input--list ">
                <label class="checkout__input--label mb-2" for="input1">Nombre<span class="checkout__input--label__star">*</span></label>
                <input class="checkout__input--field border-radius-5" placeholder="Nombre" id="nombreEnvio" value="<?= $usuario["nombre_cliente"] ?> " type="text">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="input2">Apellido<span class="checkout__input--label__star">*</span></label>
                <input class="checkout__input--field border-radius-5" placeholder="Apellido" id="apellidoEnvio"  value="<?= $usuario["apellido_cliente"] ?>" type="text">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 mb-5">
              <div class="checkout__input--list ">
                <label class="checkout__input--label mb-2" for="input1">Carnet<span class="checkout__input--label__star">*</span></label>
                <input class="checkout__input--field border-radius-5" placeholder="Nombre" id="ciEnvio" value="<?= $usuario["nit_ci_cliente"] ?>" type="text">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="input2">Celular<span class="checkout__input--label__star">*</span></label>
                <input class="checkout__input--field border-radius-5" placeholder="Celular" id="celularEnvio" value="<?= $usuario["telefono_cliente"] ?>" type="text">
              </div>
            </div>

            <div class="col-lg-6 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="country">Departamento<span class="checkout__input--label__star">*</span></label>
                <div class="checkout__input--select select">
                  <select class="checkout__input--select__field border-radius-5" id="country">
                    <option value="1">La Paz</option>
                    <option value="2">Cochabamba</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="country">Sucursal<span class="checkout__input--label__star">*</span></label>
                <div class="checkout__input--select select">
                  <select class="checkout__input--select__field border-radius-5" id="country">
                    <option value="1">Sucursal 1</option>
                    <option value="2">Sucursal 2</option>
                  </select>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

          <div class="checkout__content--step__footer d-flex align-items-center">
            <a class="continue__shipping--btn primary__btn border-radius-5" id="continuar-compra">Continuar con la compra</a>
            <a class="previous__link--content" href="/cart">Retornar al carrito</a>
          </div>
    </form>
  </div>
</div>