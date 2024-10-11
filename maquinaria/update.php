<?php

include ("../conexion.php");

$nombre  =  $_POST['nombre'];
$tipo  =  $_POST['tipo'];
$modelo  =  $_POST['modelo'];
$numero_serie  =  $_POST['numero_serie'];
$fecha_adquisicion  =  $_POST['fecha_adquisicion'];
$estado  =  $_POST['estado'];
$ubicacion  =  $_POST['ubicacion'];
$id = $_POST['id'];


$sql = "UPDATE maquinarias SET nombre = '$nombre', tipo = '$tipo', modelo = '$modelo', numero_serie = '$numero_serie', fecha_adquisicion = '$fecha_adquisicion', estado = '$estado', ubicacion = '$ubicacion' WHERE id = '$id'";
$mensaje = $db->query($sql);

if ($mensaje) {
    header("Location: verMaquinaria.php");
} else {
    echo "Error al actualizar los datos: " . $db->error;
}

?>
