<?php

include ("../conexion.php");

$correo  =  $_POST['correo']; 
$clave  =  $_POST['clave'];
$nombre  =  $_POST['nombre'];
$tipo_usuario = $_POST['tipo_usuario'];

$sql1 = mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$correo' " );
$resultado = mysqli_fetch_assoc($sql1);


if($correo==$resultado['correo']){
    echo "<script>

    alert('el correo ya existe'); 
    document.location=' crearUsuarios.php';
  
  </script>";
    
}else{
    $sql = "INSERT INTO usuarios ( correo, nombre, clave, tipo_usuario )
    values ('$correo', '$nombre', '$clave', '$tipo_usuario' )";

$mensaje = $db->query($sql);

header("Location: crearUsuarios.php");
}

?>