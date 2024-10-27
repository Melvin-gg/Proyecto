<?php
include("../conexion.php");
session_start();

if (!isset($_SESSION['u_usuario'])) {
    header("location: ../index.html");
    exit();
}

$usuario = $_SESSION['u_usuario'];
$proceso = mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$usuario'");
$resultado = mysqli_fetch_array($proceso);
$administrador = $resultado['nombre'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Maquinaria</title>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="principal.php">Inicio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="navbar-text"><i>BIENVENIDO: <?php echo $administrador; ?></i></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../administrador.php"><i class="material-icons">arrow_back</i> Regresar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="verMaquinaria.php"><i class="material-icons">visibility</i> Ver Maquinarias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../finalizar.php"><i class="material-icons">exit_to_app</i> Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-secondary">
                <div class="card-body">
                    <form action="insertar_maquinaria.php" method="POST" autocomplete="off">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre" autofocus="on" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo de maquinaria:</label>
                            <select class="form-control" name="tipo" required>
                                <option value="Soldadura">Agricola</option>
                                <option value="Corte">Industrial</option>
                                <option value="Proceso Semilla">Proceso de Semilla</option>
                                <option value="Proceso Semilla">Mantenimiento de Cultivos</option>
                                <option value="Proceso Semilla">Transporte</option>
                                <option value="Proceso Semilla">Generacion de Energia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="modelo" placeholder="Modelo" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="numero_serie" placeholder="Número de Serie" required>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha_adquisicion" required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado de la maquinaria:</label>
                            <select class="form-control" name="estado" required>
                                <option value="Nuevo">Nuevo</option>
                                <option value="Intermedio">Intermedio</option>
                                <option value="Degradado">Degradado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ubicacion">Ubicación de la maquinaria:</label>
                            <select class="form-control" name="ubicacion" required>
                                <option value="Almacen">Almacén</option>
                                <option value="Taller">Taller</option>
                                <option value="Bodega de Semillas 1">Bodega de Semillas 1</option>
                                <option value="Bodega de Semillas 2">Bodega de Semillas 2</option>
                                <option value="Bodega de Semillas 3">Bodega de Semillas 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary btn-block"><i class="material-icons">save</i> Insertar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
