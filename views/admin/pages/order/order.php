<?php
/*=============================================
Lista blanca de url permitidas en user
=============================================*/
$pages = array(
    "detailOrder" => "modules/detalle_order.php",
  );

  if (!empty($routesArray[2])){
    if (array_key_exists($routesArray[2], $pages)) {

        include $pages[$routesArray[2]];
    }else {
        include "modules/list.php";
    }
  } else {

    include "modules/list.php";
} 
?>