<?php
include ("conexion.php");
session_start();

include('verificaRol.php');
// Solo permite el acceso a administradores
verificarRol('Admin');
if(!isset($_SESSION['u_usuario'])){
    header("location: index.html");
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
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Actualizar Mantenimiento</title>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand nav-link" href="principal.php">Sistema de Mantenimiento</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navegar" aria-controls="navegar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navegar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link">Bienvenido: <?php echo $administrador; ?></a></li>
                <li class="nav-item"><a class="nav-link" href="administrador.php"><i class="material-icons">REGRESAR</i></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container pt-4">
    <?php
    $id = $_GET['id'];
    $mostrar = mysqli_query($db, "SELECT * FROM mantenimiento WHERE id='$id'");
    while ($registro = mysqli_fetch_array($mostrar)) {
    ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card border-secondary">
                <div class="card-body">
                    <form action="update.php" method="POST" autocomplete="off">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre_equipo" value="<?php echo $registro['nombre_equipo']; ?>" placeholder="Nombre de equipo" autofocus required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="descripcion" value="<?php echo $registro['descripcion']; ?>" placeholder="Descripción" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="Frecuencia" value="<?php echo $registro['Frecuencia']; ?>" placeholder="Frecuencia" required>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $registro['fecha_inicio']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha_fin" value="<?php echo $registro['fecha_fin']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha_sig_mant" value="<?php echo $registro['fecha_sig_mant']; ?>" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="reprogramacion" required>
                                <option value="Si" <?php if ($registro['reprogramacion'] == 'Si') echo 'selected'; ?>>Si</option>
                                <option value="No" <?php if ($registro['reprogramacion'] == 'No') echo 'selected'; ?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="estado" required>
                                <option value="Activo" <?php if ($registro['estado'] == 'Activo') echo 'selected'; ?>>Activo</option>
                                <option value="Proceso" <?php if ($registro['estado'] == 'Proceso') echo 'selected'; ?>>Proceso</option>
                                <option value="Finalizado" <?php if ($registro['estado'] == 'Finalizado') echo 'selected'; ?>>Finalizado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="horas_invertidas" value="<?php echo $registro['horas_invertidas']; ?>" placeholder="Horas invertidas" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="comentario" value="<?php echo $registro['comentario']; ?>" placeholder="Comentarios" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
                            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                        </div>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
