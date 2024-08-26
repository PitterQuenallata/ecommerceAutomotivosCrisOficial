<?php
if (!isset($_SESSION['id_cliente']) && isset($_SESSION['cliente'])) {
  echo '<script>
    window.location = "/home";
    </script>';
}


if (!empty($routesArray[2])){
  if ($routesArray[2] == "detalle"){
      include "orden/detalle_compras.php";
  }else{
      include "orden/historial_compras.php";
  }
}
else{
  include "orden/historial_compras.php";
}
?> 