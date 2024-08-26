<?php
// Verificar si la sesión no está iniciada o si no se ha definido la variable de sesión 'cliente'
if (!isset($_SESSION['id_cliente']) || !isset($_SESSION['cliente'])) {
  echo '<script>
      window.location = "/home";
      </script>';
  exit();
}
$idCliente = $_SESSION['id_cliente'];
$idClienteGet = isset($_GET['idCliente']) ? (int)$_GET['idCliente'] : 0;

// Verificar si 'idCliente' está definido y coincide con el id_cliente de la sesión, y si 'idOrden' está presente
if ($idClienteGet !== $idCliente || !isset($_GET['idOrden'])) {
  // Si no se cumplen las condiciones, redirigir al perfil
  echo '<script>
      window.location = "/profile";
      </script>';
  exit();
}

?>


<div class="account__content section__orden_details" id="detalleOden">
  <!-- Contenido de la sección "Ordenes" -->
  <h2 class="account__content--title h3">Detalle de compra</h2>
  <p id="ordenNumero"><span>Orden # , </span></p>
  <div class="pagoRealizado border-radius-5">
    <div class="pagoRealizado--items">
      <h3 class="pagoRealizado__title text-white ">Su pago ha sido completado exitosamente. </h3>
    </div>
  </div>
  <p id="ordenFecha"><span>fecha de la orden</span></p>


  <h3 class="account__content--title h4 mb-20">Estado de envio : <span id="estadoEnvio">En Tienda</span></h3>

  <div class="account__table--area">
    <div class="table-responsive">
      <table class="account__table" id="detalleOrdensTableDesktop">
        <thead class="account__table--header">
          <tr class="account__table--header__child">
            <th class="account__table--header__child--items">#</th>
            <th class="account__table--header__child--items">Lista Repuestos</th>
            <th class="account__table--header__child--items">Cantidad</th>
            <th class="account__table--header__child--items">Precio Unitario</th>
            <th class="account__table--header__child--items">Total</th>
          </tr>
        </thead>
        <tbody id="detalleOrdensTable" class="account__table--body mobile__none">
          <!-- Cuerpo para vista de escritorio -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- Sección para los totales debajo de la tabla -->
  <div id="totalesCompra" class="compra__totales" style="margin-top: 20px; text-align: left;">
    <h4>Resumen de la Compra:</h4>
    <p><strong>Cantidad Total de Repuestos:</strong> <span id="cantidadTotal"></span></p>
    <p><strong>Total de la Compra:</strong> <span id="totalCompra"></span> USD</p>
  </div>
</div>