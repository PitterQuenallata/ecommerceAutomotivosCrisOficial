$(document).ready(function () {
    const productList = $("#productList");
    const categorySelect = $("#sidebarCategorySelect");
    const brandSelect = $("#sidebarBrandSelect");
    const modelSelect = $("#sidebarModelSelect");
    const motorSelect = $("#sidebarMotorSelect");
  
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
  
    // Cerrar el offcanvas al hacer clic fuera de él
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
      if (categorySelect.val()) params.set("idCategoria", categorySelect.val());
      if (brandSelect.val()) params.set("idMarca", brandSelect.val());
      if (modelSelect.val()) params.set("idModelo", modelSelect.val());
      if (motorSelect.val()) params.set("idMotor", motorSelect.val());
  
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
          productList.html("<p>Cargando...</p>"); // Mostrar indicador de carga
        },
        success: function (response) {
          productList.html(response); // Renderizar los productos en el contenedor
          initializeOffcanvasSidebar(); 
        },
        error: function (error) {
          console.error("Error al cargar los repuestos:", error);
          productList.html("<p>Error al cargar los productos. Inténtalo de nuevo.</p>");
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
      categorySelect.on("change", onFilterChange);
      brandSelect.on("change", function () {
        fetchModelos(brandSelect.val()); // Cargar modelos al cambiar la marca
        modelSelect.trigger("change"); // Simular el cambio para cargar motores
      });
      modelSelect.on("change", function () {
        fetchMotores(modelSelect.val()); // Cargar motores al cambiar el modelo
        motorSelect.trigger("change"); // Simular el cambio para la carga final
      });
      motorSelect.on("change", onFilterChange);
    }
  
    // 7. Funciones para cargar modelos y motores basados en marca y modelo seleccionados
    function fetchModelos(idMarca) {
      if (!idMarca) return;
  
      $.ajax({
        url: "ajax/llenar_selects_repuestos.ajax.php",
        method: "POST",
        data: {
          action: "cargarModelos",
          idMarca: encodeURIComponent(idMarca),
        },
        success: function (data) {
          modelSelect.html(data);
          motorSelect.html('<option value="">Seleccione un Motor</option>'); // Resetear motor
          modelSelect.prop("disabled", false);
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
          motorSelect.html(data);
          motorSelect.prop("disabled", false);
        },
        error: function (error) {
          console.error("Error al llenar los motores:", error);
        },
      });
    }
  
    // 9. Sincronizar los selectores con la URL (Opcional)
    function synchronizeFiltersWithURL() {
      const { idCategoria, idMarca, idModelo, idMotor } = getURLParameters();
      if (idCategoria) categorySelect.val(idCategoria);
      if (idMarca) {
        brandSelect.val(idMarca);
        fetchModelos(idMarca); // Cargar modelos basados en la marca
      }
      if (idModelo) {
        modelSelect.val(idModelo);
        fetchMotores(idModelo); // Cargar motores basados en el modelo
      }
      if (idMotor) motorSelect.val(idMotor);
    }
  
    // Sincronizar los selectores con la URL
    synchronizeFiltersWithURL();
  
    // Inicializar eventos en los selectores
    initializeFilterEvents();
  
    // Cargar los productos filtrados inicialmente
    fetchFilteredProducts();
  
    // Esta función reinicializa la funcionalidad del offcanvas
    function initializeOffcanvasSidebar() {
      offcanvsSidebar(".minicart__open--btn", ".minicart__close--btn", ".offCanvas__minicart");
    }
  });
  