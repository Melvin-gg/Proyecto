<?php
include("../conexion.php");
session_start();

if (!isset($_SESSION['u_usuario'])) {
    header("location: ../index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Actualizar Maquinaria</title>
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
                        <a class="nav-link" href="verMaquinaria.php"><i class="material-icons">arrow_back</i> Regresar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="finalizar.php"><i class="material-icons">exit_to_app</i> Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pt-4">
        <?php
        $id = $_GET['id'];
        $mostrar = mysqli_query($db, "SELECT * FROM maquinarias WHERE id='$id'");
        while ($registro = mysqli_fetch_array($mostrar)) {
        ?>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <form action="update.php" method="POST" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nombre" value="<?php echo $registro['nombre']; ?>" placeholder="Nombre Maquinaria" autofocus="on" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-select form-control" name="tipo" required>
                                        <option value="Soldadura" <?php if ($registro['tipo'] == 'Soldadura') echo 'selected'; ?>>Soldadura</option>
                                        <option value="Corte" <?php if ($registro['tipo'] == 'Corte') echo 'selected'; ?>>Corte</option>
                                        <option value="Proceso Semilla" <?php if ($registro['tipo'] == 'Proceso Semilla') echo 'selected'; ?>>Proceso Semilla</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="modelo" value="<?php echo $registro['modelo']; ?>" placeholder="Modelo" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="numero_serie" value="<?php echo $registro['numero_serie']; ?>" placeholder="Número de Serie" required>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="fecha_adquisicion" value="<?php echo $registro['fecha_adquisicion']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-select form-control" name="estado" required>
                                        <option value="Nuevo" <?php if ($registro['estado'] == 'Nuevo') echo 'selected'; ?>>Nuevo</option>
                                        <option value="Intermedio" <?php if ($registro['estado'] == 'Intermedio') echo 'selected'; ?>>Intermedio</option>
                                        <option value="Degradado" <?php if ($registro['estado'] == 'Degradado') echo 'selected'; ?>>Degradado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-select form-control" name="ubicacion" required>
                                        <option value="Almacen" <?php if ($registro['ubicacion'] == 'Almacen') echo 'selected'; ?>>Almacén</option>
                                        <option value="Taller" <?php if ($registro['ubicacion'] == 'Taller') echo 'selected'; ?>>Taller</option>
                                        <option value="Bodega de Semillas 1" <?php if ($registro['ubicacion'] == 'Bodega de Semillas 1') echo 'selected'; ?>>Bodega de Semillas 1</option>
                                        <option value="Bodega de Semillas 2" <?php if ($registro['ubicacion'] == 'Bodega de Semillas 2') echo 'selected'; ?>>Bodega de Semillas 2</option>
                                        <option value="Bodega de Semillas 3" <?php if ($registro['ubicacion'] == 'Bodega de Semillas 3') echo 'selected'; ?>>Bodega de Semillas 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary btn-block"><i class="material-icons">update</i> Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
