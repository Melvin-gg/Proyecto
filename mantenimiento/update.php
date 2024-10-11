<?php

include ("../conexion.php");

$nombre_equipo  =  $_POST['nombre_equipo']; 
$descripcion  =  $_POST['descripcion']; 
$Frecuencia  =  $_POST['Frecuencia']; 
$fecha_inicio  =  $_POST['fecha_inicio']; 
$fecha_fin  =  $_POST['fecha_fin']; 
$fecha_sig_mant  =  $_POST['fecha_sig_mant'];
$reprogramacion  =  $_POST['reprogramacion'];
$estado  =  $_POST['estado'];
$horas_invertidas  =  $_POST['horas_invertidas'];
$comentario = $_POST['comentario'];
$id = $_POST['id'];

echo "Los datos están llegando .....";

$sql = "UPDATE mantenimiento SET nombre_equipo = '$nombre_equipo', descripcion = '$descripcion', Frecuencia = '$Frecuencia', fecha_inicio = '$fecha_inicio', fecha_fin = '$fecha_fin', fecha_sig_mant = '$fecha_sig_mant', reprogramacion = '$reprogramacion', estado = '$estado', horas_invertidas = '$horas_invertidas', comentario = '$comentario' WHERE id = '$id'";
$mensaje = $db->query($sql);

if ($mensaje) {
    header("Location: verMantenimiento.php");
} else {
    echo "Error al actualizar los datos: " . $db->error;
}

?>
