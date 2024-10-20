<?php

 include "/Users/eniga/OneDrive/Documentos/GitHub/Actividad-4-SUniv/src/view/conexion.php";

if (!empty($_POST['btnRegistrar'])) {
  if (!empty($_POST['e.nombre']) and !empty($_POST['e.apellido']) and !empty($_POST['e.email']) and !empty($_POST['carreras']) and !empty($_POST['p.profesor']) and !empty($_POST['a.anio'])) {
    echo ' todo ok';
  } else {
    echo ' algunos datos estan vacios' ;
    
  }
}
?>