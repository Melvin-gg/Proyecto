<?php
include("conexion.php");
session_start();

if (isset($_SESSION['u_usuario'])) {
} else {
  header("location: index.html");
}
?>
<?php
$usuario = $_SESSION['u_usuario'];
$proceso = mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$usuario'  ");
$resultado = mysqli_fetch_array($proceso);
$administrador = $resultado['nombre'];
$id_usuario = $resultado['id'];
?>
<?php
// Conexión a la base de datos
include("conexion.php");

// Consultar los mantenimientos por estado
$sql_activo = "SELECT COUNT(*) as total FROM mantenimiento WHERE estado = 'Activo' AND id='$id_usuario'";
$sql_finalizado = "SELECT COUNT(*) as total FROM mantenimiento WHERE estado = 'Finalizado' AND id='$id_usuario'";
$sql_proceso = "SELECT COUNT(*) as total FROM mantenimiento WHERE estado = 'Proceso' AND id='$id_usuario'";

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
  <meta charset="utf-8">
  <title>Usuarios</title>
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar navbar-dark  bg-dark">
    <div class="container">
      <div>
        <ul class="navbar nav  ml-auto">
          </li>
          <li class="nav-item"><a class=" navbar-brand nav-link"><i>BIENVENIDO: <?php echo $administrador  ?></i></a></li>
          </li>
          <li class="nav-item">
            <a class="navbar-brand nav-link" href="../Priyecto/usuarios.php">
              PRINCIPAL
            </a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand nav-link" href="mantenimiento/crearMantenimiento.php"> CREAR MANTENIMIENTO
            </a>
          </li>

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
  <h1>Gráfico de Estados de Mantenimientos</h1>

  <!-- Canvas donde se dibuja el gráfico -->
  <canvas id="estadoMantenimientosChart" width="400" height="200"></canvas>

  <script>
    // Obtener el contexto del canvas donde se dibujará el gráfico
    var ctx = document.getElementById('estadoMantenimientosChart').getContext('2d');

    // Crear el gráfico utilizando Chart.js
    var estadoMantenimientosChart = new Chart(ctx, {
      type: 'bar', // Puedes cambiar a 'pie' o 'doughnut' para un gráfico circular
      data: {
        labels: ['Activo', 'Finalizado', 'Proceso'], // Las etiquetas de los estados
        datasets: [{
          label: 'Cantidad de Mantenimientos',
          data: [<?php echo $activo; ?>, <?php echo $finalizado; ?>, <?php echo $proceso; ?>], // Datos de cada estado
          backgroundColor: [
            'rgba(75, 192, 192, 0.2)', // Color para 'Activo'
            'rgba(255, 99, 132, 0.2)', // Color para 'Finalizado'
            'rgba(255, 206, 86, 0.2)' // Color para 'Proceso'
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)', // Borde para 'Activo'
            'rgba(255, 99, 132, 1)', // Borde para 'Finalizado'
            'rgba(255, 206, 86, 1)' // Borde para 'Proceso'
          ],
          borderWidth: 1 // Ancho del borde de las barras
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true // El eje Y empieza desde cero
          }
        }
      }
    });
  </script>
</body>

</html>