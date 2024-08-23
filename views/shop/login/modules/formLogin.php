<!-- login -->


<div class="col">
  <div class="account__login">
    <div class="account__login--header mb-25">
      <h2 class="account__login--header__title mb-10">Ingresar</h2>
      <!-- <p class="account__login--header__desc">Login if you area a returning customer.</p> -->
    </div>
    <div class="account__login--inner">
      <form id="loginForm" method="POST" class="needs-validation" novalidate>
        <div class="form-group">
          <label>
            <input class="account__login--input  form-control " onchange="validateJS(event,'email')" id="ingClienteUsuario" name="ingClienteUsuario" required placeholder="Correo electronico" type="email">
          </label>

          <div class="valid-feedback">Valido</div>
          <div class="invalid-feedback">Campo Invaldio</div>
        </div>

        <div class="form-group">
          <label>
            <input class="account__login--input  form-control "  id="ingClientePassword" name="ingClientePassword" required placeholder="Contraseña" type="password">
          </label>

          <div class="valid-feedback">Valido</div>
          <div class="invalid-feedback">Campo Invaldio</div>
        </div>



        <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
          <div class="account__login--remember position__relative">
            <input class="checkout__checkbox--input" id="check1" type="checkbox">
            <span class="checkout__checkbox--checkmark"></span>
            <label class="checkout__checkbox--label login__remember--label" id="recordarUsuario" for="check1">
              Recordar</label>
          </div>
          <button class="account__login--forgot"><a href="#">Olvidaste tu contraseña?</a></button>
        </div>
        <button class="account__login--btn primary__btn" type="submit">Login</button>
        <!-- <div class="account__login--divide">
          <span class="account__login--divide__text">OR</span>
        </div>
        <div class="account__social d-flex justify-content-center mb-15">
          <a class="account__social--link facebook" target="_blank" href="https://www.facebook.com">Facebook</a>
          <a class="account__social--link google" target="_blank" href="https://www.google.com">Google</a>
          <a class="account__social--link twitter" target="_blank" href="https://twitter.com">Twitter</a>
        </div> -->
        <p class="account__login--signup__text">No tienes una cuenta? <button><a href="/login/register">Registrarse</a></button></p>
      </form>
    </div>
  </div>
</div>