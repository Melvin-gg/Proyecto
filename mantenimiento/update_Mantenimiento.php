<?php
include ("../conexion.php");
session_start();

include('verificaRol.php');
// Solo permite el acceso a usuarios
verificarRol('Usuario');

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
    <title>ACTUALIZAR MANTENIMIENTO</title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="../usuarios.php">Mantenimiento</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link"><i>BIENVENIDO: <?php echo $administrador; ?></i></a></li>
        <li class="nav-item"><a class="nav-link" href="verMantenimiento.php">VER MANTENIMIENTOS</a></li>
        <li class="nav-item"><a class="nav-link" href="finalizar.php"><i class="material-icons">SALIR</i></a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenido principal -->
<div class="container pt-4">
<?php
$id = $_GET['id'];
$mostrar = mysqli_query($db, "SELECT * FROM mantenimiento WHERE id='$id'");

while ($registro = mysqli_fetch_array($mostrar)) {
?>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card border-secondary">
        <div class="card-body">
          <h4 class="card-title text-center">Actualizar Mantenimiento</h4>
          <form action="update.php" method="POST" autocomplete="off">
            <div class="form-group">
              <label for="nombre_equipo">Nombre de Equipo</label>
              <input type="text" class="form-control" name="nombre_equipo" value="<?php echo $registro['nombre_equipo']; ?>" placeholder="Nombre del equipo" autofocus="on">
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <input type="text" class="form-control" name="descripcion" value="<?php echo $registro['descripcion']; ?>" placeholder="Descripción">
            </div>
            <div class="form-group">
              <label for="Frecuencia">Frecuencia</label>
              <input type="text" class="form-control" name="Frecuencia" value="<?php echo $registro['Frecuencia']; ?>" placeholder="Frecuencia">
            </div>
            <div class="form-group">
              <label for="fecha_inicio">Fecha de Inicio</label>
              <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $registro['fecha_inicio']; ?>">
            </div>
            <div class="form-group">
              <label for="fecha_fin">Fecha de Fin</label>
              <input type="date" class="form-control" name="fecha_fin" value="<?php echo $registro['fecha_fin']; ?>">
            </div>
            <div class="form-group">
              <label for="fecha_sig_mant">Fecha del Siguiente Mantenimiento</label>
              <input type="date" class="form-control" name="fecha_sig_mant" value="<?php echo $registro['fecha_sig_mant']; ?>">
            </div>
            <div class="form-group">
              <label for="reprogramacion">Reprogramación</label>
              <select class="form-control" name="reprogramacion">
                <option value="Si" <?php if ($registro['reprogramacion'] == 'Si') echo 'selected'; ?>>Sí</option>
                <option value="No" <?php if ($registro['reprogramacion'] == 'No') echo 'selected'; ?>>No</option>
              </select>
            </div>
            <div class="form-group">
              <label for="estado">Estado</label>
              <select class="form-control" name="estado">
                <option value="Activo" <?php if ($registro['estado'] == 'Activo') echo 'selected'; ?>>Activo</option>
                <option value="Proceso" <?php if ($registro['estado'] == 'Proceso') echo 'selected'; ?>>Proceso</option>
                <option value="Finalizado" <?php if ($registro['estado'] == 'Finalizado') echo 'selected'; ?>>Finalizado</option>
              </select>
            </div>
            <div class="form-group">
              <label for="horas_invertidas">Horas Invertidas</label>
              <input type="number" class="form-control" name="horas_invertidas" value="<?php echo $registro['horas_invertidas']; ?>" placeholder="Horas invertidas">
            </div>
            <div class="form-group">
              <label for="comentario">Comentarios</label>
              <input type="text" class="form-control" name="comentario" value="<?php echo $registro['comentario']; ?>" placeholder="Comentarios">
            </div>
            <input type="hidden" class="form-control" name="id" value="<?php echo $registro['id']; ?>" readonly>
            <input type="hidden" class="form-control" name="id_usuario" value="<?php echo $id_usuario; ?>" readonly>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary btn-block"><i class="material-icons">ACTUALIZAR</i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
