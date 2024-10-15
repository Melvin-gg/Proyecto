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
$id_usuario = $_POST['id_usuario'];

    $sql = "INSERT INTO mantenimiento ( nombre_equipo, descripcion, Frecuencia, fecha_inicio, fecha_fin, fecha_sig_mant, reprogramacion, estado, horas_invertidas, comentario, id_usuario )
    values ('$nombre_equipo', '$descripcion', '$Frecuencia', '$fecha_inicio', '$fecha_fin', '$fecha_sig_mant', '$reprogramacion', '$estado', '$horas_invertidas', '$comentario', '$id_usuario' )";

$mensaje = $db->query($sql);

header("Location: crearMantenimiento.php");


?>