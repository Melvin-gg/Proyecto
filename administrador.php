<?php
include("conexion.php");
session_start();

include('verificaRol.php');
// Solo permite el acceso a administradores
verificarRol('Admin');
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
$sql_activo = "SELECT COUNT(*) as total FROM mantenimiento WHERE estado = 'Activo'";
$sql_finalizado = "SELECT COUNT(*) as total FROM mantenimiento WHERE estado = 'Finalizado'";
$sql_proceso = "SELECT COUNT(*) as total FROM mantenimiento WHERE estado = 'Proceso'";

// Ejecutar las consultas
$result_activo = mysqli_query($db, $sql_activo);
$result_finalizado = mysqli_query($db, $sql_finalizado);
$result_proceso = mysqli_query($db, $sql_proceso);

// Obtener los valores
$activo = mysqli_fetch_assoc($result_activo)['total'];
$finalizado = mysqli_fetch_assoc($result_finalizado)['total'];
$proceso = mysqli_fetch_assoc($result_proceso)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador - Mantenimientos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="administrador.php">Mantenimiento</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="usuarios/crearUsuarios.php">USUARIOS</a></li>
        <li class="nav-item"><a class="nav-link" href="maquinaria/crearMaquinaria.php">MAQUINARIA</a></li>
        <li class="nav-item"><a class="nav-link" href="mantenimientos.php">VER MANTENIMIENTOS</a></li>
        <li class="nav-item"><a class="nav-link" href="finalizar.php">SALIR</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenido principal -->
<div class="container mt-5">
  <h1 class="text-center mb-4">Gráfico de Estados de Mantenimientos</h1>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <!-- Canvas para el gráfico -->
      <canvas id="estadoMantenimientosChart" width="400" height="200"></canvas>
    </div>
  </div>
</div>

<!-- Script para generar el gráfico -->
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
          'rgba(75, 192, 192, 0.2)', // Color para 'Activo'
          'rgba(255, 99, 132, 0.2)', // Color para 'Finalizado'
          'rgba(255, 206, 86, 0.2)'  // Color para 'Proceso'
        ],
        borderColor: [
          'rgba(75, 192, 192, 1)',   // Borde para 'Activo'
          'rgba(255, 99, 132, 1)',   // Borde para 'Finalizado'
          'rgba(255, 206, 86, 1)'    // Borde para 'Proceso'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
