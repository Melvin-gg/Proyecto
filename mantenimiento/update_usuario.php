<?php
include ("../conexion.php");
session_start();

if(isset($_SESSION['u_usuario'])){
  
  }else{
  header("location: ../index.html");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Creación Usuarios</title>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark  bg-dark ">
       <div class="container">
         <div class=" collapse navbar-collapse" id="navegar">
            <ul class="navbar nav  ml-auto" >    
                <li class="nav-item">
                 <a class="navbar-brand nav-link " href="principal.php">
                </a>
                </li>
         <li class="nav-item"><a class=" navbar-brand nav-link" href="crearUsuarios.php"><i class="material-icons">REGRESAR</i></a></li>
                <li class="nav-item"><a class=" navbar-brand nav-link" href="finalizar.php"><i class="material-icons">SALIR exit_to_app</i></a></li>
                </ul>
        </div>
       </div>
</nav>

<div class="container pt-4" >
<?php
$id=$_GET['id'];
$mostrar=mysqli_query($db,"select * from usuarios WHERE id='$id'");

while($registro = mysqli_fetch_array($mostrar)){
?>
    <div class="row">
        <div class="col-4 ">
            <div class="card border-secondary">
                <div class="card-body">
                    <form  action="update.php"  method="POST" autocomplete="off">
                        <div  class="form-group">
                            <input type="email"  class="form-control"  name="correo" value="<?php echo   $registro['correo'] ;?>" placeholder="correo " autofocus="on" >
                        </div>
                        <div  class="form-group">
                            <input type="text"  class="form-control"  name="clave" value="<?php echo   $registro['clave'] ;?>"  placeholder="clave" >
                        </div>
                        <div  class="form-group">
                            <input type="text"  class="form-control"  name="nombre" value="<?php echo   $registro['nombre'] ;?>"  placeholder="nombre"  >
                        </div>
                        <div  class="form-group">
                            <select class="form-select" aria-label="Default select example" name="tipo_usuario">
                            <option value="Admin" <?php if ($registro['tipo_usuario'] == 'Admin') echo 'selected'; ?>>Admin</option>
                            <option value="Usuario" <?php if ($registro['tipo_usuario'] == 'Usuario') echo 'selected'; ?>>Usuario</option>
                            </select>
                        </div>
                        <div  class="form-group">
                            <input type="number"  class="form-control"  name="id" value="<?php echo   $registro['id'] ;?>"  placeholder="id" readonly >
                        </div>
                        <div class="form-group">
                            <button type="submit"  class="btn btn-secondary btn-block" ><i class="material-icons">ACTUALIZAR</i></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php  }
?>
</div>
</body>
</html>