<?php

include("../conexion.php");

$nombre  =  $_POST['nombre'];
$tipo  =  $_POST['tipo'];
$modelo  =  $_POST['modelo'];
$numero_serie  =  $_POST['numero_serie'];
$fecha_adquisicion  =  $_POST['fecha_adquisicion'];
$estado  =  $_POST['estado'];
$ubicacion  =  $_POST['ubicacion'];

$sql1 = mysqli_query($db, "SELECT * FROM maquinarias WHERE numero_serie='$numero_serie' ");
$resultado = mysqli_fetch_assoc($sql1);


if ($numero_serie == $resultado['numero_serie']) {
  echo "<script>

    alert('el numero_serie ya existe'); 
    document.location=' crearMaquinaria.php';
  
  </script>";
} else {
  $sql = "INSERT INTO maquinarias ( nombre, tipo, modelo, numero_serie, fecha_adquisicion, estado, ubicacion )
    values ('$nombre', '$tipo', '$modelo', '$numero_serie', '$fecha_adquisicion', '$estado', '$ubicacion' )";

  $mensaje = $db->query($sql);

  header("Location: crearMaquinaria.php");
}
