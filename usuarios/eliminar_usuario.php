<?php
//eliminar un registro de la tabla venta
include ("../conexion.php");

$id=$_GET['id'];
$db->query("DELETE FROM  usuarios WHERE id='$id'");
 
header("Location: crearUsuarios.php");


?>