document.addEventListener("DOMContentLoaded", function () {
  const productList = document.querySelector("#productList");
  const categorySelect = document.getElementById("sidebarCategorySelect");
  const brandSelect = document.getElementById("sidebarBrandSelect");
  const modelSelect = document.getElementById("sidebarModelSelect");
  const motorSelect = document.getElementById("sidebarMotorSelect");



  // 1. Leer los Parámetros de la URL
  function getURLParameters() {
    const urlParams = new URLSearchParams(window.location.search);
    return {
      idCategoria: urlParams.get("idCategoria") || "",
      idMarca: urlParams.get("idMarca") || "",
      idModelo: urlParams.get("idModelo") || "",
      idMotor: urlParams.get("idMotor") || "",
      oemRepuesto: urlParams.get("oemRepuesto") || "",
    };
  }

  // 2. Actualizar la URL sin Recargar la Página
  function updateURLWithFilters() {
    const params = new URLSearchParams();
    if (categorySelect.value) params.set("idCategoria", categorySelect.value);
    if (brandSelect.value) params.set("idMarca", brandSelect.value);
    if (modelSelect.value) params.set("idModelo", modelSelect.value);
    if (motorSelect.value) params.set("idMotor", motorSelect.value);

    const newURL = window.location.pathname + "?" + params.toString();
    history.replaceState(null, "", newURL);
  }

  // 3. Obtener los Parámetros de Filtro para la Solicitud AJAX
  function getFilterParams() {
    const { idCategoria, idMarca, idModelo, idMotor, oemRepuesto } =
      getURLParameters();
    const params = {};
    if (idCategoria) params.idCategoria = idCategoria;
    if (idMarca) params.idMarca = idMarca;
    if (idModelo) params.idModelo = idModelo;
    if (idMotor) params.idMotor = idMotor;
    if (oemRepuesto) params.oemRepuesto = oemRepuesto;
    return params;
  }

  // 4. Realizar la Solicitud AJAX para Obtener los Productos Filtrados
  function fetchFilteredProducts() {
    const params = getFilterParams();

    $.ajax({
      url: "ajax/cargar_repuestos.ajax.php",
      method: "GET",
      data: params,
      beforeSend: function () {
        productList.innerHTML = "<p>Cargando...</p>"; // Mostrar indicador de carga
      },
      success: function (response) {
        productList.innerHTML = response; // Renderizar los productos en el contenedor
      },
      error: function (error) {
        console.error("Error al cargar los repuestos:", error);
        productList.innerHTML =
          "<p>Error al cargar los productos. Inténtalo de nuevo.</p>";
      },
    });
  }

  // 5. Manejar los Eventos de Cambio en los Selectores de Filtro
  function onFilterChange() {
    updateURLWithFilters(); // Actualizar la URL
    fetchFilteredProducts(); // Cargar los productos filtrados
  }

  // 6. Inicializar los Eventos de los Selectores
  function initializeFilterEvents() {
    categorySelect.addEventListener("change", onFilterChange);
    brandSelect.addEventListener("change", function () {
      fetchModelos(brandSelect.value); // Cargar modelos al cambiar la marca
      modelSelect.dispatchEvent(new Event("change")); // Simular el cambio para cargar motores
    });
    modelSelect.addEventListener("change", function () {
      fetchMotores(modelSelect.value); // Cargar motores al cambiar el modelo
      motorSelect.dispatchEvent(new Event("change")); // Simular el cambio para la carga final
    });
    motorSelect.addEventListener("change", onFilterChange);
  }

  // 7. Funciones para cargar modelos y motores basados en marca y modelo seleccionados
  function fetchModelos(idMarca) {
    if (!idMarca) return;

    fetch("ajax/llenar_selects_repuestos.ajax.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "action=cargarModelos&idMarca=" + encodeURIComponent(idMarca),
    })
      .then((response) => response.text())
      .then((data) => {
        modelSelect.innerHTML = data;
        motorSelect.innerHTML = '<option value="">Seleccione un Motor</option>'; // Resetear motor
        modelSelect.disabled = false;
      })
      .catch((error) => console.error("Error al llenar los modelos:", error));
  }

  function fetchMotores(idModelo) {
    if (!idModelo) return;

    fetch("ajax/llenar_selects_repuestos.ajax.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "action=cargarMotores&idModelo=" + encodeURIComponent(idModelo),
    })
      .then((response) => response.text())
      .then((data) => {
        motorSelect.innerHTML = data;
        motorSelect.disabled = false;
      })
      .catch((error) => console.error("Error al llenar los motores:", error));
  }

  //   function openMinicart(event) {
  //     event.preventDefault(); // Evita el comportamiento por defecto del enlace

  //     var targetId = event.currentTarget.getAttribute("data-bs-target");
  //     var offcanvasElement = document.querySelector(targetId);

  //     if (offcanvasElement) {
  //       var bsOffcanvas = new bootstrap.Offcanvas(offcanvasElement);
  //       bsOffcanvas.show();
  //     } else {
  //       console.error("No se encontró el elemento del modal.");
  //     }
  //   }

  // 9. Sincronizar los selectores con la URL (Opcional)
  function synchronizeFiltersWithURL() {
    const { idCategoria, idMarca, idModelo, idMotor } = getURLParameters();
    if (idCategoria) categorySelect.value = idCategoria;
    if (idMarca) {
      brandSelect.value = idMarca;
      fetchModelos(idMarca); // Cargar modelos basados en la marca
    }
    if (idModelo) {
      modelSelect.value = idModelo;
      fetchMotores(idModelo); // Cargar motores basados en el modelo
    }
    if (idMotor) motorSelect.value = idMotor;
  }

  // Sincronizar los selectores con la URL
  synchronizeFiltersWithURL();

  // Inicializar eventos en los selectores
  initializeFilterEvents();

  // Cargar los productos filtrados inicialmente
  fetchFilteredProducts();

  
});
