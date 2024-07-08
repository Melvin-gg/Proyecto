<?php 
include("conexion.php");
session_start();

if(isset($_SESSION['u_usuario'])){
  
  }else{
  header("location: index.html");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Administrador</title>
 <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>
<body >

<nav class="navbar navbar-expand-lg navbar navbar-dark  bg-dark">
    <div class="container">                            
     <div>
        <ul class="navbar nav  ml-auto" >    
            <li class="nav-item">
              <a class="navbar-brand nav-link" href="../Priyecto/usuarios.php">
                PRINCIPAL 
            </a> 
            </li>
            <!-- <li class="nav-item">
              <a class="navbar-brand nav-link" href="producto.php">       PRODUCTOS 
              </a>
            </li> -->
           
            <!-- <li class="nav-item">
              <a class="navbar-brand nav-link" href="historial.php">HISTORIAL</a>
            </li> -->
           
            <li class="nav-item">
              <a class="navbar-brand nav-link" href="finalizar.php">SALIR </a>
            </li>
            </ul>
            </div>
       </div>
        </nav>


<?php
$usuario= $_SESSION['u_usuario'];
$proceso=mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$usuario'  " );
$resultado=mysqli_fetch_array($proceso);
$administrador= $resultado['nombre']; 
?>
 
<div class="container">
   <div class="row">
    <div class="col-5 pt-3 ">
    <form  action="php/insertar_producto_venta.php"  method="POST">
<h6 style="font-weight:bold;"><?php echo "bienvenido:"." ". $administrador  ?></h3>
</div>    
</body>
</html>