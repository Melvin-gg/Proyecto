<?php
include("../conexion.php");
session_start();

if (!isset($_SESSION['u_usuario'])) {
  header("location: ../index.html");
  exit;
}

$usuario = $_SESSION['u_usuario'];
$proceso = mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$usuario'");
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>MANTENIMIENTOS</title>
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
        let td = tr[i].getElementsByTagName("td")[0]; // Columna de "NOMBRE EQUIPO"
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
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="principal.php">Mantenimientos</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link"><i>BIENVENIDO: <?php echo $administrador; ?></i></a></li>
          <li class="nav-item"><a class="nav-link" href="../mantenimiento/crearMantenimiento.php"><i class="material-icons">REGRESAR</i></a></li>
          <li class="nav-item"><a class="nav-link" href="../usuarios.php"><i class="material-icons">REGRESAR INICIO</i></a></li>
          <li class="nav-item"><a class="nav-link" href="../finalizar.php"><i class="material-icons">SALIR</i></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contenido principal -->
  <div class="container pt-4">
    <div class="row">
      <div class="col-12">
        <h2 class="text-center">Mantenimientos</h2>
        <input class="form-control mb-3" id="searchInput" type="text" placeholder="Buscar por nombre equipo" onkeyup="filterTable()">
        <div class="table-responsive">
          <table id="userTable" class="table table-striped table-dark table-hover">
            <thead>
              <tr>
                <th scope="col">NOMBRE EQUIPO</th>
                <th scope="col">DESCRIPCIÓN</th>
                <th scope="col">FRECUENCIA</th>
                <th scope="col">FECHA INICIO</th>
                <th scope="col">FECHA FIN</th>
                <th scope="col">FECHA SIG. MANTENIMIENTO</th>
                <th scope="col">REPROGRAMACIÓN</th>
                <th scope="col">ESTADO</th>
                <th scope="col">HORAS INVERTIDAS</th>
                <th scope="col">COMENTARIO</th>
                <th scope="col">ELIMINAR</th>
                <th scope="col">ACTUALIZAR</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $mostrar = mysqli_query($db, "SELECT * FROM mantenimiento WHERE id_usuario='$id_usuario'");
              while ($registro = mysqli_fetch_array($mostrar)) {
              ?>
                <tr>
                  <td><?php echo $registro['nombre_equipo']; ?></td>
                  <td><?php echo $registro['descripcion']; ?></td>
                  <td><?php echo $registro['Frecuencia']; ?></td>
                  <td><?php echo $registro['fecha_inicio']; ?></td>
                  <td><?php echo $registro['fecha_fin']; ?></td>
                  <td><?php echo $registro['fecha_sig_mant']; ?></td>
                  <td><?php echo $registro['reprogramacion']; ?></td>
                  <td><?php echo $registro['estado']; ?></td>
                  <td><?php echo $registro['horas_invertidas']; ?></td>
                  <td><?php echo $registro['comentario']; ?></td>
                  <td><a href="eliminar_Mantenimiento.php?id=<?php echo $registro['id']; ?>"><i class="material-icons" style="color: white;">delete</i></a></td>
                  <td><a href="update_Mantenimiento.php?id=<?php echo $registro['id']; ?>"><i class="material-icons" style="color: white;">update</i></a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
