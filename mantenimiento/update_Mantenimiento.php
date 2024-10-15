<?php
include ("../conexion.php");
session_start();

if(isset($_SESSION['u_usuario'])){
  
  }else{
  header("location: ../index.html");
}
?>
<?php
$usuario = $_SESSION['u_usuario'];
$proceso = mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$usuario'  ");
$resultado = mysqli_fetch_array($proceso);
$administrador = $resultado['nombre'];
$id_usuario = $resultado['id'];
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
    <title>ACTUALIZAR MANTENIMIENTO</title>
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
            </li>
                <li class="nav-item"><a class=" navbar-brand nav-link"><i>BIENVENIDO: <?php echo $administrador  ?></i></a></li>
            </li>
            <li class="nav-item"><a class=" navbar-brand nav-link"  href="verMantenimiento.php"><i class="material-icons">REGRESAR</i></a></li>
                <li class="nav-item"><a class=" navbar-brand nav-link" href="finalizar.php"><i class="material-icons">SALIR exit_to_app</i></a></li>
            </ul>
        </div>
       </div>
</nav>

<div class="container pt-4" >
<?php
$id=$_GET['id'];
$mostrar=mysqli_query($db,"select * from mantenimiento WHERE id='$id'");

while($registro = mysqli_fetch_array($mostrar)){
?>
    <div class="row">
        <div class="col-4 ">
            <div class="card border-secondary">
                <div class="card-body">
                    <form  action="update.php"  method="POST" autocomplete="off">
                        <div  class="form-group">
                            <input type="text"  class="form-control"  name="nombre_equipo" value="<?php echo   $registro['nombre_equipo'] ;?>" placeholder="NOMBRE DE EQUIPO " autofocus="on" >
                        </div>
                        <div  class="form-group">
                            <input type="text"  class="form-control"  name="descripcion" value="<?php echo   $registro['descripcion'] ;?>"  placeholder="DESCRIPCION" >
                        </div>
                        <div  class="form-group">
                            <input type="text"  class="form-control"  name="Frecuencia" value="<?php echo   $registro['Frecuencia'] ;?>"  placeholder="FRECUENCIA"  >
                        </div>
                        <div  class="form-group">
                            <input type="date"  class="form-control"  name="fecha_inicio" value="<?php echo   $registro['fecha_inicio'] ;?>"  placeholder="FECHA DE INICIO"  >
                        </div>
                        <div  class="form-group">
                            <input type="date"  class="form-control"  name="fecha_fin" value="<?php echo   $registro['fecha_fin'] ;?>"  placeholder="FECHA FIN"  >
                        </div>
                        <div  class="form-group">
                            <input type="date"  class="form-control"  name="fecha_sig_mant" value="<?php echo   $registro['fecha_sig_mant'] ;?>"  placeholder="FECHA SIG MANTENIMIENTO"  >
                        </div>
                        <div  class="form-group">
                            <select class="form-select" aria-label="Default select example" name="reprogramacion">
                            <option value="Si" <?php if ($registro['reprogramacion'] == 'Si') echo 'selected'; ?>>Si</option>
                            <option value="No" <?php if ($registro['reprogramacion'] == 'No') echo 'selected'; ?>>No</option>
                            </select>
                        </div>
                        <div  class="form-group">
                            <select class="form-select" aria-label="Default select example" name="estado">
                            <option value="Activo" <?php if ($registro['estado'] == 'Activo') echo 'selected'; ?>>Activo</option>
                            <option value="Proceso" <?php if ($registro['estado'] == 'Proceso') echo 'selected'; ?>>Proceso</option>
                            <option value="Finalizado" <?php if ($registro['estado'] == 'Finalizado') echo 'selected'; ?>>Finalizado</option>
                            </select>
                        </div>
                        <div  class="form-group">
                            <input type="int"  class="form-control"  name="horas_invertidas" value="<?php echo   $registro['horas_invertidas'] ;?>"  placeholder="HORAS INVERTIDAS"  >
                        </div>
                        <div  class="form-group">
                            <input type="text"  class="form-control"  name="comentario" value="<?php echo   $registro['comentario'] ;?>"  placeholder="COMENTARIOS"  >
                        </div>
                        <div  class="form-group">
                            <input type="number"  class="form-control"  name="id" value="<?php echo   $registro['id'] ;?>"  placeholder="id" readonly >
                        </div>
                        <div  class="form-group">
                            <input type="number"  class="form-control"  name="id_usuario" value="<?php echo   $id_usuario ;?>"  placeholder="id_usuario" readonly >
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