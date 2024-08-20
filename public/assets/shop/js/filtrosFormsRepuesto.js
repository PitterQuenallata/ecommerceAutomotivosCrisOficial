$(document).ready(function () {
  const productList = $("#productList");
  initFilters();
  cargarRepuestos();

  $("[data-idFiltroCategoria]").on("click", function () {
    const idCategoria = $(this).data("idfiltrocategoria"); // Obtener el valor de data-idFiltroCategoria
    localStorage.setItem("filtroCategoria", idCategoria); // Guardar en localStorage
  });

  function initFilters() {
    // Inicializar filtros desde localStorage
    const savedMarca = localStorage.getItem("filtroMarca");
    const savedModelo = localStorage.getItem("filtroModelo");
    const savedMotor = localStorage.getItem("filtroMotor");
    const savedCategoria = localStorage.getItem("filtroCategoria");

    if (savedCategoria) {
      $("#sidebarCategorySelect").val(savedCategoria);
    }

    if (savedMarca) {
      $("#sidebarMarcaSelect").val(savedMarca);
      cargarModelos(savedMarca, savedModelo);
    }

    if (savedModelo) {
      $("#sidebarModelSelect").val(savedModelo);
      cargarMotores(savedModelo, savedMotor);
    }

    if (savedMotor) {
      $("#sidebarMotorSelect").val(savedMotor);
    }
  }

  // Lógica para manejar eventos de cambio en los filtros
  setupFilterEvents();

  // Función que se ejecuta al cambiar un filtro
  function setupFilterEvents() {
    $("#sidebarMarcaSelect").on("change", function () {
      console.log("cambio de marca");
      const idMarca = $(this).val();
      localStorage.setItem("filtroMarca", idMarca);
      cargarModelos(idMarca);
    });

    $("#sidebarModelSelect").on("change", function () {
      const idModelo = $(this).val();
      localStorage.setItem("filtroModelo", idModelo);
      cargarMotores(idModelo);
    });

    $("#sidebarMotorSelect").on("change", function () {
      const idMotor = $(this).val();
      localStorage.setItem("filtroMotor", idMotor);
    });

    $("#sidebarCategorySelect").on("change", function () {
      const idCategoria = $(this).val();
      localStorage.setItem("filtroCategoria", idCategoria);
    });
  }

  function cargarModelos(idMarca, selectedModelo = null) {
    // Realiza la petición AJAX para cargar los modelos
    $.ajax({
      url: "ajax/filtrosFormsRepuesto.ajax.php",
      method: "POST",
      data: { idMarca: idMarca, action: "cargarModelos" },
      success: function (response) {
        $("#sidebarModelSelect").html(response);
        $("#sidebarMotorSelect").html(
          '<option value="" selected disabled>Seleccione un Motor</option>'
        );

        if (selectedModelo) {
          $("#sidebarModelSelect").val(selectedModelo);
          cargarMotores(selectedModelo, localStorage.getItem("filtroMotor"));
        }
      },
      error: function () {
        console.error("Error al cargar los modelos");
      },
    });
  }

  function cargarMotores(idModelo, selectedMotor = null) {
    // Realiza la petición AJAX para cargar los motores
    $.ajax({
      url: "ajax/filtrosFormsRepuesto.ajax.php",
      method: "POST",
      data: { idModelo: idModelo, action: "cargarMotores" },
      success: function (response) {
        $("#sidebarMotorSelect").html(response);
        if (selectedMotor) {
          $("#sidebarMotorSelect").val(selectedMotor);
        }
      },
      error: function () {
        console.error("Error al cargar los motores");
      },
    });
  }

  function cargarRepuestos() {
    // Obtener los parámetros de la URL actual
    const urlParams = new URLSearchParams(window.location.search);

    // Convertir los parámetros en un objeto de datos para enviar con la petición AJAX
    const queryParams = {};
    urlParams.forEach((value, key) => {
      queryParams[key] = value;
    });

    $.ajax({
      url: "ajax/cargar_repuestos.ajax.php",
      method: "GET",
      data: queryParams,
      beforeSend: function () {
        productList.html("<p>Cargando...</p>");
      },
      success: function (response) {
        productList.html(response);

        // Inicializar el script del modal después de cargar los productos
        initializeOffcanvasSidebar();
        initializeModal(); // Inicializa el modal aquí después de la carga
      },
      error: function (error) {
        console.error("Error al cargar los repuestos:", error);
        productList.html(
          "<p>Error al cargar los productos. Inténtalo de nuevo.</p>"
        );
      },
    });
  }

  function initializeOffcanvasSidebar() {
    if ($(".minicart__open--btn").length) {
      offcanvsSidebar(".minicart__open--btn", ".minicart__close--btn", ".offCanvas__minicart");
    }
  }
  $(document).on("click", ".minicart__open--btn", function (event) {
    event.preventDefault();
    const offCanvasElement = $(".offCanvas__minicart");
    offCanvasElement.addClass("active");
    $("body").addClass("offCanvas__minicart_active");
  });

  $(document).on("click", ".minicart__close--btn", function (event) {
    event.preventDefault();
    closeOffcanvas();
  });

  $(document).on("click", function (event) {
    if (
      $(event.target).closest(".offCanvas__minicart, .minicart__open--btn")
        .length === 0
    ) {
      closeOffcanvas();
    }
  });

  function closeOffcanvas() {
    const offCanvasElement = $(".offCanvas__minicart");
    offCanvasElement.removeClass("active");
    $("body").removeClass("offCanvas__minicart_active");
  }
});

function initializeModal() {
  if (!document.querySelector("[data-modal-initialized]")) {
    document.addEventListener("click", function (event) {
      if (event.target.matches("[data-open]")) {
        const modalId = event.target.getAttribute("data-open");
        document.getElementById(modalId).classList.add("is-visible");
      }
    });

    document.querySelectorAll("[data-open]").forEach(function (el) {
      el.setAttribute("data-modal-initialized", true);
    });
  }
}

function initializeOffcanvasSidebar() {
  if ($(".minicart__open--btn").length) {
    offcanvsSidebar(
      ".minicart__open--btn",
      ".minicart__close--btn",
      ".offCanvas__minicart"
    );
  }
}
