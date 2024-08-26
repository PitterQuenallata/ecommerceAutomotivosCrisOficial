<script src="<?= BASE_URL ?>views/shop/checkout/modules/envios.js"></script>
<?php
$usuario = $_SESSION['cliente'];

$api = new ApiController();

// Obtener sucursales
$sucursales = $api->getSucursales();
// echo "<pre>"; 
// print_r($sucursales);
// echo "</pre>";
// Crear un array para almacenar departamentos y sucursales
$departamentos = [];
foreach ($sucursales as $sucursal) {
    $departamentos[$sucursal['departamento']][] = $sucursal;
}

?>

<div class="col-lg-11 col-md-6 justify-content-center align-items-center">
  <div class="main checkout__mian">
    <form>

      <div class="checkout__content--step section__shipping--address">
        <div class="section__header mb-25">
          <h2 class="section__header--title h3">Datos de envío</h2>
        </div>
        <div class="section__shipping--address__content">
          <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="nombreEnvio">Nombre<span class="checkout__input--label__star">*</span></label>
                <input class="checkout__input--field border-radius-5" placeholder="Nombre" id="nombreEnvio" value="<?= htmlspecialchars($usuario["nombre_cliente"]) ?>" type="text">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="apellidoEnvio">Apellido<span class="checkout__input--label__star">*</span></label>
                <input class="checkout__input--field border-radius-5" placeholder="Apellido" id="apellidoEnvio" value="<?= htmlspecialchars($usuario["apellido_cliente"]) ?>" type="text">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="ciEnvio">Carnet<span class="checkout__input--label__star">*</span></label>
                <input class="checkout__input--field border-radius-5" placeholder="Carnet" id="ciEnvio" value="<?= htmlspecialchars($usuario["nit_ci_cliente"]) ?>" type="text">
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="celularEnvio">Celular<span class="checkout__input--label__star">*</span></label>
                <input class="checkout__input--field border-radius-5" placeholder="Celular" id="celularEnvio" value="<?= htmlspecialchars($usuario["telefono_cliente"]) ?>" type="text">
              </div>
            </div>

            <div class="col-lg-6 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="departamento">Departamento<span class="checkout__input--label__star">*</span></label>
                <div class="checkout__input--select select">
                  <select class="checkout__input--select__field border-radius-5" id="departamento" onchange="actualizarSucursales()">
                    <option value="">Seleccionar Departamento</option>
                    <?php
                    // Recorrer los departamentos y mostrarlos como opciones
                    foreach ($departamentos as $id_departamento => $sucursales) {
                      // Aquí puedes reemplazar el nombre del departamento con un array que contenga los nombres según los IDs
                      $nombre_departamento = "Departamento " . $id_departamento; // Placeholder
                      echo "<option value='$id_departamento'>$nombre_departamento</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="sucursal">Sucursal<span class="checkout__input--label__star">*</span></label>
                <div class="checkout__input--select select">
                  <select class="checkout__input--select__field border-radius-5" id="sucursal">
                    <option value="">Seleccionar Sucursal</option>
                    <!-- Las sucursales se actualizarán dinámicamente mediante JavaScript -->
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

<script>
  // JavaScript para actualizar dinámicamente las sucursales según el departamento seleccionado
  const sucursalesPorDepartamento = <?= json_encode($departamentos) ?>;

  function actualizarSucursales() {
    const departamentoId = document.getElementById('departamento').value;
    const sucursalSelect = document.getElementById('sucursal');
    
    // Limpiar opciones previas
    sucursalSelect.innerHTML = '<option value="">Seleccionar Sucursal</option>';
    
    if (departamentoId && sucursalesPorDepartamento[departamentoId]) {
      const sucursales = sucursalesPorDepartamento[departamentoId];
      sucursales.forEach(sucursal => {
        const option = document.createElement('option');
        option.value = sucursal.id;
        option.textContent = sucursal.nombre;
        sucursalSelect.appendChild(option);
      });
    }
  }
</script>

