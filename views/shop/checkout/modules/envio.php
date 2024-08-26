<!-- <script src="<?= BASE_URL ?>views/shop/checkout/modules/envios.js"></script> -->
<?php
$usuario = $_SESSION['cliente'];

$api = new ApiController();

// Definir los arrays de departamentos y provincias antes de procesar las sucursales
$departamentos = [
  1 => 'Santa Cruz',
  2 => 'La Paz',
  3 => 'Cochabamba',
  4 => 'Sucre',
  5 => 'Potosi',
  6 => 'Oruro',
  7 => 'Beni',
  8 => 'Pando',
  9 => 'Tarija'
];

$provincias = [
  1 => ['Andrés Ibáñez', 'Ichilo', 'Sara', 'Cordillera', 'Germán Busch'],
  2 => ['Murillo', 'Los Andes', 'Ingavi', 'Pacajes', 'Nor Yungas'],
  3 => ['Arani', 'Carrasco', 'Cercado', 'Esteban Arce', 'Germán Jordán'],
  4 => ['Oropeza', 'Azurduy', 'Tomina', 'Zudáñez', 'Yamparáez'],
  5 => ['Tomás Frías', 'Charcas', 'Nor Chichas', 'Sud Chichas', 'Linares'],
  6 => ['Cercado', 'Litoral', 'Ladislao Cabrera', 'Poopó', 'Sajama'],
  7 => ['Cercado', 'Yacuma', 'Ballivián', 'Moxos', 'Vaca Díez'],
  8 => ['Madre de Dios', 'Manuripi', 'Abuná', 'Federico Román', 'Nicolás Suárez'],
  9 => ['Cercado', 'Arce', 'Avilés', 'O’Connor', 'Gran Chaco']
];

// Obtener las sucursales desde la API
$sucursales = $api->getSucursales();

// Crear un array para almacenar las sucursales con nombres de departamento y provincia
$sucursalesConNombres = [];

foreach ($sucursales as $sucursal) {
    $departamentoId = $sucursal['departamento'];
    $provinciaId = $sucursal['provincia'];

    // Asignar el nombre del departamento y la provincia
    $sucursal['nombre_departamento'] = $departamentos[$departamentoId];
    $sucursal['nombre_provincia'] = $provincias[$departamentoId][$provinciaId - 1]; // Se resta 1 porque el array de provincias es de 0 indexado

    // Agregar la sucursal al array con los nombres
    $sucursalesConNombres[] = $sucursal;
}

// Ahora $sucursalesConNombres tiene todas las sucursales con los nombres correctos de departamento y provincia

// Para verificar que todo esté correcto, puedes hacer un print_r:

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

            <!-- Nombre y Apellido -->
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

            <!-- Carnet y Celular -->
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

            <!-- Selección de Departamento, Provincia y Sucursal -->
            <div class="col-lg-4 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="departamento">Departamento<span class="checkout__input--label__star">*</span></label>
                <div class="checkout__input--select select">
                  <select class="checkout__input--select__field border-radius-5" id="departamento" onchange="actualizarProvincias()">
                    <option value="">Seleccionar Departamento</option>
                    <?php
                    foreach ($departamentos as $id_departamento => $nombre_departamento) {
                      echo "<option value='$id_departamento'>$nombre_departamento</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-lg-4 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="provincia">Provincia<span class="checkout__input--label__star">*</span></label>
                <div class="checkout__input--select select">
                  <select class="checkout__input--select__field border-radius-5" id="provincia" onchange="actualizarSucursales()">
                    <option value="">Seleccionar Provincia</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-lg-4 mb-5">
              <div class="checkout__input--list">
                <label class="checkout__input--label mb-2" for="sucursal">Sucursal<span class="checkout__input--label__star">*</span></label>
                <div class="checkout__input--select select">
                  <select class="checkout__input--select__field border-radius-5" id="sucursal">
                    <option value="">Seleccionar Sucursal</option>
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
const provinciasPorDepartamento = <?= json_encode($provincias) ?>;
const sucursales = <?= json_encode($sucursalesConNombres) ?>;

function actualizarProvincias() {
    const departamentoId = document.getElementById('departamento').value;
    const provinciaSelect = document.getElementById('provincia');

    // Limpiar opciones previas
    provinciaSelect.innerHTML = '<option value="">Seleccionar Provincia</option>';
    
    if (departamentoId && provinciasPorDepartamento[departamentoId]) {
        const provincias = provinciasPorDepartamento[departamentoId];
        provincias.forEach((provincia, index) => {
            const option = document.createElement('option');
            option.value = index + 1; // Asume que los índices comienzan desde 1
            option.textContent = provincia;
            provinciaSelect.appendChild(option);
        });
    }

    // Limpiar el select de sucursales cuando cambie el departamento o provincia
    actualizarSucursales();
}

function actualizarSucursales() {
    const departamentoId = document.getElementById('departamento').value;
    const provinciaIndex = document.getElementById('provincia').value;
    const sucursalSelect = document.getElementById('sucursal');

    // Limpiar opciones previas
    sucursalSelect.innerHTML = '<option value="">Seleccionar Sucursal</option>';
    
    if (departamentoId && provinciaIndex) {
        const filteredSucursales = sucursales.filter(sucursal => 
            sucursal.departamento == departamentoId && sucursal.provincia == provinciaIndex
        );

        filteredSucursales.forEach(sucursal => {
            const option = document.createElement('option');
            option.value = sucursal.id;
            option.textContent = sucursal.nombre;
            sucursalSelect.appendChild(option);
        });
    }
}


</script>


