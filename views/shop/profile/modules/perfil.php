<?php
$cliente = ModeloClientes::mdlMostrarClientePorId("clientes", $_SESSION["id_cliente"]);
?>

<div class="account__content section__cuenta ">
  <div class="container mt-4">
    <h3 class="perfil__form--title mb-30">Mi Perfil</h3>
    <form class="perfil__form--inner" id="formEditarPerfil" method="POST">
      <!-- Row 1: Nombre, Apellido -->
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="perfil__form--list mb-20">
            <label class="perfil__form--label" for="nombre_cliente">Nombre<span class="perfil__form--label__star">*</span></label>
            <input class="perfil__form--input" name="nombre_cliente" id="nombre_cliente" value="<?php echo htmlspecialchars($cliente['nombre_cliente']); ?>" type="text" required disabled>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="perfil__form--list mb-20">
            <label class="perfil__form--label" for="apellido_cliente">Apellido <span class="perfil__form--label__star">*</span></label>
            <input class="perfil__form--input" name="apellido_cliente" id="apellido_cliente" value="<?php echo htmlspecialchars($cliente['apellido_cliente']); ?>" type="text" required disabled>
          </div>
        </div>
      </div>
      <!-- Row 2: Email, Contraseña -->
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="perfil__form--list mb-20">
            <label class="perfil__form--label" for="email_cliente">Email <span class="perfil__form--label__star">*</span></label>
            <input class="perfil__form--input" name="email_cliente" id="email_cliente" value="<?php echo htmlspecialchars($cliente['email_cliente']); ?>" type="email" required disabled>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="perfil__form--list mb-20">
            <label class="perfil__form--label" for="password_cliente">Contraseña <span class="perfil__form--label__star">*</span></label>
            <input class="perfil__form--input" name="password_cliente" id="password_cliente" placeholder="Dejar en blanco si no desea cambiar" type="password" disabled>
            
          </div>
        </div>
      </div>
      <!-- Row 3: NIT/CI, Teléfono, Compras -->
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <div class="perfil__form--list mb-20">
            <label class="perfil__form--label" for="nit_ci_cliente">NIT/CI</label>
            <input class="perfil__form--input" name="nit_ci_cliente" id="nit_ci_cliente" value="<?php echo htmlspecialchars($cliente['nit_ci_cliente']); ?>" type="text" disabled>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="perfil__form--list mb-20">
            <label class="perfil__form--label" for="telefono_cliente">Teléfono</label>
            <input class="perfil__form--input" name="telefono_cliente" id="telefono_cliente" value="<?php echo htmlspecialchars($cliente['telefono_cliente']); ?>" type="text" disabled>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="perfil__form--list mb-20">
            <label class="perfil__form--label" for="compra_cliente">Compras </label>
            <input class="perfil__form--input" id="compra_cliente" value="<?php echo htmlspecialchars($cliente['compra_cliente']); ?>" type="number" readonly disabled>
          </div>
        </div>
      </div>

      <!-- Botones de Editar, Guardar y Cancelar -->
      <div class="text-center">
        <button type="button" class="perfil__form--btn primary__btn" id="editPerfilbtn"><span>Editar</span></button>
        <button type="submit" class="perfil__form--btn primary__btn" id="savePerfilbtn" style="display:none;"><span>Guardar</span></button>
        <button type="button" class="perfil__form--btn primary__btn" id="cancelPerfilbtn" style="display:none;"><span>Cancelar</span></button>
      </div>

    </form>

    <script>
      $(document).ready(function() {
        const editBtn = $('#editPerfilbtn');
        const saveBtn = $('#savePerfilbtn');
        const cancelBtn = $('#cancelPerfilbtn');
        const inputs = $('.perfil__form--input:not(#compra_cliente)');

        editBtn.on('click', function() {
          // Habilitar los campos de entrada
          inputs.prop('disabled', false);

          // Mostrar botones de Guardar y Cancelar, ocultar Editar
          saveBtn.show();
          cancelBtn.show();
          editBtn.hide();
        });

        cancelBtn.on('click', function() {
          // Deshabilitar los campos de entrada
          inputs.prop('disabled', true);

          // Ocultar botones de Guardar y Cancelar, mostrar Editar
          saveBtn.hide();
          cancelBtn.hide();
          editBtn.show();

          // Restaurar los valores originales
          $('#nombre_cliente').val("<?php echo htmlspecialchars($cliente['nombre_cliente']); ?>");
          $('#apellido_cliente').val("<?php echo htmlspecialchars($cliente['apellido_cliente']); ?>");
          $('#email_cliente').val("<?php echo htmlspecialchars($cliente['email_cliente']); ?>");
          $('#password_cliente').val("");
          $('#nit_ci_cliente').val("<?php echo htmlspecialchars($cliente['nit_ci_cliente']); ?>");
          $('#telefono_cliente').val("<?php echo htmlspecialchars($cliente['telefono_cliente']); ?>");
        });

        $('#formEditarPerfil').on('submit', function(e) {
          e.preventDefault(); // Prevenir el comportamiento de envío normal

          $.ajax({
            type: 'POST',
            url: '/ajax/perfil.ajax.php',
            data: {
              action: 'editarPerfil', // 'obtenerHistorial', 'obtenerCompras', etc.
              id_cliente: <?php echo $_SESSION["id_cliente"]; ?>,
              nombre_cliente: $('#nombre_cliente').val(),
              apellido_cliente: $('#apellido_cliente').val(),
              email_cliente: $('#email_cliente').val(),
              telefono_cliente: $('#telefono_cliente').val(),
              nit_ci_cliente: $('#nit_ci_cliente').val(),
              password_cliente: $('#password_cliente').val(),
            },
            success: function(response) {
              response = JSON.parse(response);
              if (response.success == true) {
                fncSweetAlert('success', 'Datos actualizados correctamente', '/profile');
              } else {
                fncSweetAlert('error', response.error || 'Hubo un problema al actualizar el perfil');
              }
            },
            error: function() {
              fncSweetAlert('error', 'Hubo un problema en la solicitud');
            }
          });

        });
      });
    </script>
  </div>
</div>