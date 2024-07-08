<?php
session_start();
include("conexion.php");

if(!empty($_POST['correo']) && !empty($_POST['clave'])){
$correo = $_POST['correo'];
$clave = $_POST['clave'];

$sql ="SELECT * FROM usuarios WHERE correo='$correo' AND clave='$clave'";
$query=mysqli_query($db, $sql);
if($resultado=mysqli_fetch_array($query)){
  echo   $resultado['tipo_usuario'];
  if($resultado['tipo_usuario'] == 'Admin'){
    $_SESSION['u_usuario'] = $correo;
    header("location: ../Proyecto/administrador.php");
  } else {
    $_SESSION['u_usuario'] = $correo;
    header("location: ../Proyecto/usuarios.php");
  }
}
else{

echo "<script>
  alert('usuario o contraseña equivocado '); 
  document.location='../Proyecto/index.html';
</script>";
}	
}else{
	
echo "<script>
  alert('te falto un campo por rellenar '); 
  document.location='../Proyecto/index.html';
</script>";	
}

?>