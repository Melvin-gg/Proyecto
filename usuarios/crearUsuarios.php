<?php
include ("../conexion.php");
session_start();

if(isset($_SESSION['u_usuario'])){
  
  }else{
  header("location: ../index.html");
}
?>
<?php
$usuario= $_SESSION['u_usuario'];
$proceso=mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$usuario'  " );
$resultado=mysqli_fetch_array($proceso);
$administrador= $resultado['nombre']; 
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        img:hover {
            height: 130px;
            border-radius: 70px;
        }
    </style>
    <script>
        function filterTable() {
            let input = document.getElementById("searchInput");
            let filter = input.value.toLowerCase();
            let table = document.getElementById("userTable");
            let tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName("td")[2]; // La columna del nombre es la tercera (índice 2)
                if (td) {
                    let txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

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
                <li class="nav-item"><a class=" navbar-brand nav-link" ><i>BIENVENIDO: <?php echo $administrador  ?></i></a></li>
                </li>
       <li class="nav-item">
          <a class=" navbar-brand nav-link" href="../usuarios/crearUsuarios.php">
            USUARIOS
          </a>
         </li>
              <li class="nav-item"><a class=" navbar-brand nav-link" href="../administrador.php"><i class="material-icons">REGRESAR</i></a></li>
                <li class="nav-item"><a class=" navbar-brand nav-link" href="../finalizar.php"><i class="material-icons">SALIR exit_to_app</i></a>
              </li>
          </ul>
        </div>


       </div>
        </nav>
<div class="container pt-4" >

<div class="row">


<div class="col-4 ">
    <div class="card border-secondary">
        <div class="card-body">

        <form  action="insertar_usuario.php"  method="POST" autocomplete="off">


<div  class="form-group">
<input type="email"  class="form-control"  name="correo"  placeholder="correo " autofocus="on" required>
</div>
<div  class="form-group">
<input type="password"  class="form-control"  name="clave"  placeholder="clave" required>
</div>
<div  class="form-group">
<input type="text"  class="form-control"  name="nombre"  placeholder="nombre"  required>
</div>
<div  class="form-group">
    <select class="form-select" aria-label="Default select example" name="tipo_usuario">
      <option value="Usuario">Usuario</option>
      <option value="Admin">Admin</option>
    </select>
</div>


 <div class="form-group">
 <button type="submit"  class="btn btn-secondary btn-block" ><i class="material-icons">AGREGAR USUARIO</i></button>
 </div>
 </form>
        </div>
 
    </div>

 </div>

<div class="col-8">

    <h2>Usuarios</h2>
    <input class="form-control mb-3" id="searchInput" type="text" placeholder="Buscar por nombre" onkeyup="filterTable()">
  <table id="userTable" class="table table-striped table-dark">
    <thead>
      <tr>
       <th scope="col">CORREO</th>
       <th scope="col">CLAVE</th>
       <th scope="col">NOMBRE</th>
       <th scope="col">ROL</th>
       <th scope="col">BORRAR</th>
       <th scope="col">ACTUALIZAR</th>
    
      </tr>
    <thead>

<tbody>

<?php

$mostrar=mysqli_query($db,"select * from usuarios");

while($registro = mysqli_fetch_array($mostrar)){
  // Ofuscar la clave con asteriscos
  $claveOfuscada = str_repeat('*', strlen($registro['clave']));
?>
   <tr>
    <td><?php echo   $registro['correo'] ;?></td>
    <td><?php echo   $claveOfuscada;?></td>
    <td><?php echo   $registro['nombre'] ;?></td>
    <td><?php echo   $registro['tipo_usuario'] ;?></td>
    <td><a  href="eliminar_usuario.php?id=<?php echo $registro['id'] ?>"><i style="color:white;" class="material-icons" >delete</i></a></td>
    <td><a  href="update_usuario.php?id=<?php echo $registro['id'] ?>"><i style="color:white;" class="material-icons" ><U>update</U></i></a></td>
   </tr>
 
<?php  }

?>

<style>
img{

}

img:hover{
        height:130px;    
        border-radius: 70px;
}

</style>

</tbody>
</table>

</div>

</div>



</div>


</body>
</html>