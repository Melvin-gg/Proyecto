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
  <title>Creación de Usuarios</title>
  <style>
    img:hover {
      height: 130px;
      border-radius: 70px;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="principal.php">Mantenimiento</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link"><i>BIENVENIDO: <?php echo $administrador; ?></i></a></li>
          <li class="nav-item"><a class="nav-link" href="../mantenimiento/verMantenimiento.php">VER MANTENIMIENTO</a></li>
          <li class="nav-item"><a class="nav-link" href="../usuarios.php"><i class="material-icons">REGRESAR</i></a></li>
          <li class="nav-item"><a class="nav-link" href="../finalizar.php"><i class="material-icons">SALIR</i></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contenido principal -->
  <div class="container pt-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border-secondary">
          <div class="card-body">
            <h4 class="card-title text-center">Creación de Mantenimiento</h4>
            <form action="insertar_Mantenimiento.php" method="POST" autocomplete="off">
              <div class="form-group">
                <label>Selecciona nombre de maquinaria</label>
                <select name="nombre_equipo" id="nombre_equipo" class="form-control" required>
                  <?php
                  // Generar opciones dinámicas desde la consulta
                  $mostrar = mysqli_query($db, "SELECT * FROM maquinarias");
                  while ($registro = mysqli_fetch_array($mostrar)) {
                    echo "<option value='" . $registro['nombre'] . "'>" . $registro['nombre'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="descripcion" placeholder="Descripción" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="Frecuencia" placeholder="Frecuencia" required>
              </div>
              <div class="form-group">
                <label>Fecha de Inicio</label>
                <input type="date" class="form-control" name="fecha_inicio" required>
              </div>
              <div class="form-group">
                <label>Fecha de Fin</label>
                <input type="date" class="form-control" name="fecha_fin" required>
              </div>
              <div class="form-group">
                <label>Fecha Siguiente Mantenimiento</label>
                <input type="date" class="form-control" name="fecha_sig_mant">
              </div>
              <div class="form-group">
                <label>Reprogramación</label>
                <select class="form-control" name="reprogramacion">
                  <option value="Si">Sí</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group">
                <label>Estado</label>
                <select class="form-control" name="estado">
                  <option value="Activo">Activo</option>
                  <option value="Proceso">Proceso</option>
                  <option value="Finalizado">Finalizado</option>
                </select>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" name="horas_invertidas" placeholder="Horas Invertidas" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="comentario" placeholder="Comentario">
              </div>
              <div class="form-group">
                <input type="hidden" class="form-control" name="id_usuario" value="<?php echo $id_usuario; ?>" readonly>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-secondary btn-block"><i class="material-icons">CREAR</i></button>
              </div>
            </form>
          </div>
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
