<?php
include("conexion.php");
session_start();
include('verificaRol.php');
// Solo permite el acceso a usuarios
verificarRol('Usuario');

if (!isset($_SESSION['u_usuario'])) {
  header("location: index.html");
  exit;
}

$usuario = $_SESSION['u_usuario'];
$proceso = mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$usuario'");
$resultado = mysqli_fetch_array($proceso);
$administrador = $resultado['nombre'];
$id_usuario = $resultado['id'];

// Consultar los mantenimientos por estado
$sql_activo = "SELECT COUNT(*) as total FROM mantenimiento WHERE estado = 'Activo' AND id_usuario='$id_usuario'";
$sql_finalizado = "SELECT COUNT(*) as total FROM mantenimiento WHERE estado = 'Finalizado' AND id_usuario='$id_usuario'";
$sql_proceso = "SELECT COUNT(*) as total FROM mantenimiento WHERE estado = 'Proceso' AND id_usuario='$id_usuario'";

$result_activo = mysqli_query($db, $sql_activo);
$result_finalizado = mysqli_query($db, $sql_finalizado);
$result_proceso = mysqli_query($db, $sql_proceso);

$activo = mysqli_fetch_assoc($result_activo)['total'];
$finalizado = mysqli_fetch_assoc($result_finalizado)['total'];
$proceso = mysqli_fetch_assoc($result_proceso)['total'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="../Proyecto/usuarios.php">PRINCIPAL</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link">BIENVENIDO: <?php echo $administrador; ?></a></li>
          <li class="nav-item"><a class="nav-link" href="mantenimiento/crearMantenimiento.php">CREAR MANTENIMIENTO</a></li>
          <li class="nav-item"><a class="nav-link" href="mantenimiento/verMantenimiento.php">VER MANTENIMIENTOS</a></li>
          <li class="nav-item"><a class="nav-link" href="finalizar.php">SALIR</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h1 class="text-center">Gráfico de Estados de Mantenimientos</h1>
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10">
        <canvas id="estadoMantenimientosChart"></canvas>
      </div>
    </div>
  </div>
  <script>
    var ctx = document.getElementById('estadoMantenimientosChart').getContext('2d');
    var estadoMantenimientosChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Activo', 'Finalizado', 'Proceso'],
        datasets: [{
          label: 'Cantidad de Mantenimientos',
          data: [<?php echo $activo; ?>, <?php echo $finalizado; ?>, <?php echo $proceso; ?>],
          backgroundColor: [
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 206, 86, 0.2)'
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(255, 206, 86, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>

</html>
