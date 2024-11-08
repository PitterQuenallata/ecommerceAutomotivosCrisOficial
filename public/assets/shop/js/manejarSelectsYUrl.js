$(document).ready(function () {
  const productList = $("#productList");
  const categorySelect = $("#sidebarCategorySelect");
  const brandSelect = $("#sidebarBrandSelect");
  const modelSelect = $("#sidebarModelSelect");
  const motorSelect = $("#sidebarMotorSelect");
  const searchButton = $("#filterSearchButton");

  function initializeOffcanvasSidebar() {
    if ($(".minicart__open--btn").length) {
      offcanvsSidebar(".minicart__open--btn", ".minicart__close--btn", ".offCanvas__minicart");
    }
  }

  $(document).on("click", ".minicart__open--btn", function (event) {
    event.preventDefault();
    const offCanvasElement = $('.offCanvas__minicart');
    offCanvasElement.addClass('active');
    $("body").addClass('offCanvas__minicart_active');
  });

  $(document).on("click", ".minicart__close--btn", function (event) {
    event.preventDefault();
    closeOffcanvas();
  });

  $(document).on("click", function (event) {
    if ($(event.target).closest('.offCanvas__minicart, .minicart__open--btn').length === 0) {
      closeOffcanvas();
    }
  });

  function closeOffcanvas() {
    const offCanvasElement = $('.offCanvas__minicart');
    offCanvasElement.removeClass('active');
    $("body").removeClass('offCanvas__minicart_active');
  }

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

  function updateURLWithFilters() {
    const params = new URLSearchParams();
    if (categorySelect.val()) params.set("idCategoria", categorySelect.val());
    if (brandSelect.val()) params.set("idMarca", brandSelect.val());
    if (modelSelect.val()) params.set("idModelo", modelSelect.val());
    if (motorSelect.val()) params.set("idMotor", motorSelect.val());

    const newURL = window.location.pathname + "?" + params.toString();
    history.replaceState(null, "", newURL);
  }

  function getFilterParams() {
    const { idCategoria, idMarca, idModelo, idMotor, oemRepuesto } = getURLParameters();
    const params = {};
    if (idCategoria) params.idCategoria = idCategoria;
    if (idMarca) params.idMarca = idMarca;
    if (idModelo) params.idModelo = idModelo;
    if (idMotor) params.idMotor = idMotor;
    if (oemRepuesto) params.oemRepuesto = oemRepuesto;
    return params;
  }

  function fetchFilteredProducts(params = null) {
    const queryParams = params || getFilterParams();

    $.ajax({
      url: "/ajax/cargar_repuestos.ajax.php",
      method: "GET",
      data: queryParams,
      beforeSend: function () {
        productList.html("<p>Cargando...</p>");
      },
      success: function (response) {
        productList.html(response);

        // Inicializar el script del modal después de cargar los productos
        initializeOffcanvasSidebar();
        initializeModal();  // Inicializa el modal aquí después de la carga
      },
      error: function (error) {
        console.error("Error al cargar los repuestos:", error);
        productList.html("<p>Error al cargar los productos. Inténtalo de nuevo.</p>");
      },
    });
  }

  function onFilterChange() {
    updateURLWithFilters();
    fetchFilteredProducts();
  }

  function initializeFilterEvents() {
    brandSelect.on("change", function () {
      fetchModelos(brandSelect.val());
    });

    modelSelect.on("change", function () {
      fetchMotores(modelSelect.val());
    });
  }

  // Aquí es donde definimos synchronizeFiltersWithURL
  function synchronizeFiltersWithURL() {
    const { idCategoria, idMarca, idModelo, idMotor } = getURLParameters();
    if (idCategoria) categorySelect.val(idCategoria);
    if (idMarca) {
      brandSelect.val(idMarca);
      fetchModelos(idMarca);
    }
    if (idModelo) {
      modelSelect.val(idModelo);
      fetchMotores(idModelo);
    }
    if (idMotor) motorSelect.val(idMotor);
  }

  // Inicialización de los eventos y sincronización de filtros con la URL
  synchronizeFiltersWithURL();
  initializeFilterEvents();

  // Cargar los productos al iniciar la página si hay parámetros en la URL
  const urlParams = getURLParameters();
  if (urlParams.idCategoria || urlParams.idMarca || urlParams.idModelo || urlParams.idMotor || urlParams.oemRepuesto) {
    fetchFilteredProducts(urlParams);
  }

  searchButton.on("click", function () {
    updateURLWithFilters();
    fetchFilteredProducts();
  });
});

function fetchModelos(idMarca) {
  if (!idMarca) return;

  $.ajax({
    url: "/ajax/llenar_selects_repuestos.ajax.php",
    method: "POST",
    data: {
      action: "cargarModelos",
      idMarca: encodeURIComponent(idMarca),
    },
    success: function (data) {
      $("#sidebarModelSelect").html(data);
      $("#sidebarMotorSelect").html('<option value="">Seleccione un Motor</option>');
      $("#sidebarModelSelect").prop("disabled", false);
    },
    error: function (error) {
      console.error("Error al llenar los modelos:", error);
    },
  });
}

function fetchMotores(idModelo) {
  if (!idModelo) return;

  $.ajax({
    url: "ajax/llenar_selects_repuestos.ajax.php",
    method: "POST",
    data: {
      action: "cargarMotores",
      idModelo: encodeURIComponent(idModelo),
    },
    success: function (data) {
      $("#sidebarMotorSelect").html(data);
      $("#sidebarMotorSelect").prop("disabled", false);
    },
    error: function (error) {
      console.error("Error al llenar los motores:", error);
    },
  });
}

function initializeModal() {
  if (!document.querySelector('[data-modal-initialized]')) {
    document.addEventListener('click', function (event) {
      if (event.target.matches('[data-open]')) {
        const modalId = event.target.getAttribute('data-open');
        document.getElementById(modalId).classList.add('is-visible');
      }
    });

    document.querySelectorAll('[data-open]').forEach(function (el) {
      el.setAttribute('data-modal-initialized', true);
    });
  }
}
