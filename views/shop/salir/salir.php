<?php
session_start();

// Destruir la sesión del usuario
session_destroy();

echo '<script>
    // Limpiar todo el localStorage
    localStorage.clear();

    // Redirigir al usuario a la página principal
    window.location = "/";
</script>';
?>
