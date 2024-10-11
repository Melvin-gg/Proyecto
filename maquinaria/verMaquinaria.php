<?php
include("../conexion.php");
session_start();

if (isset($_SESSION['u_usuario'])) {
} else {
  header("location: ../index.html");
}
?>
<?php
$usuario = $_SESSION['u_usuario'];
$proceso = mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$usuario'  ");
$resultado = mysqli_fetch_array($proceso);
$administrador = $resultado['nombre'];
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
    <title>Ver Maquinarias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark  bg-dark ">
    <div class="container">
      <div class=" collapse navbar-collapse" id="navegar">
        <ul class="navbar nav  ml-auto">
          <li class="nav-item">
            <a class="navbar-brand nav-link " href="principal.php">
            </a>
          </li>
          <li class="nav-item"><a class=" navbar-brand nav-link"><i>BIENVENIDO: <?php echo $administrador  ?></i></a></li>
          </li>
          <li class="nav-item"><a class=" navbar-brand nav-link" href="crearMaquinaria.php"><i class="material-icons">REGRESAR</i></a></li>
          </li>
        </ul>
      </div>


    </div>
  </nav>
  <div class="container pt-4">

    <div class="row">
      <div class="col-8">
        <h2>Tabla de Maquinarias</h2>
        <input class="form-control mb-3" id="searchInput" type="text" placeholder="Buscar por nombre" onkeyup="filterTable()">
        <table id="userTable" class="table table-striped table-dark">
          <thead>
            <tr>
              <th scope="col">NOMBRE</th>
              <th scope="col">TIPO</th>
              <th scope="col">MODELO</th>
              <th scope="col">NUM. DE SERIE</th>
              <th scope="col">FECHA DE ADQUI.</th>
              <th scope="col">ESTADO</th>
              <th scope="col">UBICACIÓN</th>
              <th scope="col">BORRAR</th>
              <th scope="col">ACTUALIZAR</th>
            </tr>
            <thead>

            <tbody>

              <?php

              $mostrar = mysqli_query($db, "select * from maquinarias");
              if ($mostrar->num_rows > 0) {
                while ($registro = mysqli_fetch_array($mostrar)) {
              ?>
                  <tr>
                    <td><?php echo   $registro['nombre']; ?></td>
                    <td><?php echo   $registro['tipo']; ?></td>
                    <td><?php echo   $registro['modelo']; ?></td>
                    <td><?php echo   $registro['numero_serie']; ?></td>
                    <td><?php echo   $registro['fecha_adquisicion']; ?></td>
                    <td><?php echo   $registro['estado']; ?></td>
                    <td><?php echo   $registro['ubicacion']; ?></td>
                    <td><a href="eliminar_maquinaria.php?id=<?php echo $registro['id'] ?>"><i style="color:white;" class="material-icons">delete</i></a></td>
                    <td><a href="update_maquinaria.php?id=<?php echo $registro['id'] ?>"><i style="color:white;" class="material-icons"><U>update</U></i></a></td>
                  </tr>

              <?php
                }
              } else {
                echo "No hay maquinarias aguardas en la base de datos";
              }

              ?>

              <style>
                img:hover {
                  height: 130px;
                  border-radius: 70px;
                }
              </style>

            </tbody>
        </table>

      </div>

    </div>



  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>