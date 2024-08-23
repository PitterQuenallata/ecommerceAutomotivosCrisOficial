<?php
if (isset($_SESSION['id_cliente']) && isset($_SESSION['cliente'])) {
  echo '<script>
    window.location = "/home";
    </script>';
}
?>



<!-- registrar -->
<div class="col">
  <div class="account__login register">
    <div class="account__login--header mb-25">
      <h2 class="account__login--header__title mb-10">Crear cuenta</h2>
      <p class="account__login--header__desc">Registro</p>
    </div>
    <div class="account__login--inner">

      <form id="formRegistrarCliente" class="needs-validation" novalidate>
        <div class="form-group">
          <label>
            <input class="account__login--input form-control" onchange="validateJS(event,'text')" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre" type="text" required>
          </label>
          <div class="valid-feedback">Válido</div>
          <div class="invalid-feedback">Campo inválido</div>
        </div>

        <div class="form-group">
          <label>
            <input class="account__login--input form-control" onchange="validateJS(event,'email')" id="email_cliente" name="email_cliente" placeholder="Correo electrónico" type="email" required>
          </label>
          <div class="valid-feedback">Válido</div>
          <div class="invalid-feedback">Campo inválido</div>
        </div>

        <div class="form-group">
          <label>
            <input class="account__login--input form-control" id="password_cliente" onchange="validateJS(event,'password')" name="password_cliente" placeholder="Contraseña" type="password" required>
          </label>
          <div class="valid-feedback">Válido</div>
          <div class="invalid-feedback">Campo inválido</div>
        </div>

        <div class="form-group">
          <label>
            <input class="account__login--input form-control" id="confirmar_password"  name="confirmar_password" placeholder="Confirmar contraseña" type="password" required>
          </label>
          <div id="passwordError" class="text-danger mt-2" style="display: none;">Las contraseñas no coinciden</div>
        </div>

        <button class="account__login--btn primary__btn mb-10" type="submit">Registrarse</button>
      </form>
      <p class="account__login--signup__text">¿Ya tienes una cuenta? <a href="/login">Iniciar Sesión</a></p>
    </div>
  </div>
</div>


<script>
$(document).ready(function() {
  // Validar la coincidencia de contraseñas en tiempo real
  $('#confirmar_password').on('input', function() {
    var password = $('#password_cliente').val();
    var confirmarPassword = $('#confirmar_password').val();

    if (password !== confirmarPassword) {
      $('#passwordError').show();  // Mostrar el mensaje de error
      $('#confirmar_password').removeAttr('onchange'); // Eliminar el onchange si no coinciden
    } else {
      $('#passwordError').hide();  // Ocultar el mensaje de error
      $('#confirmar_password').attr('onchange', "validateJS(event,'password')"); // Añadir el onchange dinámicamente
    }
  });

  $('#formRegistrarCliente').on('submit', function(e) {
    e.preventDefault(); // Evitar el envío normal del formulario

    // Verificar si las contraseñas coinciden antes de enviar
    var password = $('#password_cliente').val();
    var confirmarPassword = $('#confirmar_password').val();

    if (password !== confirmarPassword) {
      $('#passwordError').show();  // Mostrar el mensaje de error
      return;
    }
    

    // Enviar los datos por Ajax si las contraseñas coinciden
    $.ajax({
      type: 'POST',
      url: '/ajax/perfil.ajax.php',
      data: {
        action: 'registrarCliente',
        nombre_cliente: $('#nombre_cliente').val(),
        email_cliente: $('#email_cliente').val(),
        password_cliente: $('#password_cliente').val()
      },
      success: function(response) {
        response = JSON.parse(response);
        // Manejar la respuesta del servidor
        if (response.success) {
          fncSweetAlert('success', 'Cuenta creada exitosamente', '/login');
        } else {
          fncSweetAlert('error', response.error || 'Hubo un problema al crear la cuenta');
        }
      },
      error: function() {
        fncSweetAlert('error', 'Hubo un problema en la solicitud');
      }
    });
  });
});


</script>