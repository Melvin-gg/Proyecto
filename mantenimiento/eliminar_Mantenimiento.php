<?php
//eliminar un registro de la tabla mantenimiento
include ("../conexion.php");

$id=$_GET['id'];
$db->query("DELETE FROM  mantenimiento WHERE id='$id'");
 
header("Location: verMantenimiento.php");


?>