<?php

include ("../conexion.php");

$correo  =  $_POST['correo']; 
$clave  =  $_POST['clave'];
$nombre  =  $_POST['nombre'];
$tipo_usuario = $_POST['tipo_usuario'];
$id = $_POST['id'];

echo "Los datos están llegando .....";

$sql = "UPDATE usuarios SET correo = '$correo', clave = '$clave', nombre = '$nombre', tipo_usuario = '$tipo_usuario' WHERE id = '$id'";
$mensaje = $db->query($sql);

if ($mensaje) {
    header("Location: crearUsuarios.php");
} else {
    echo "Error al actualizar los datos: " . $db->error;
}

?>
