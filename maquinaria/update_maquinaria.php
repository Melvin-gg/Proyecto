<?php
include("../conexion.php");
session_start();

if (isset($_SESSION['u_usuario'])) {
} else {
    header("location: ../index.html");
}
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
    <title>ACTUALIZAR MAQUINARIA</title>
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
                    <li class="nav-item"><a class=" navbar-brand nav-link" href="verMaquinaria.php"><i class="material-icons">REGRESAR</i></a></li>
                    <li class="nav-item"><a class=" navbar-brand nav-link" href="finalizar.php"><i class="material-icons">SALIR exit_to_app</i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pt-4">
        <?php
        $id = $_GET['id'];
        $mostrar = mysqli_query($db, "select * from maquinarias WHERE id='$id'");
        while ($registro = mysqli_fetch_array($mostrar)) {
        ?>
            <div class="row">
                <div class="col-8">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <form action="update.php" method="POST" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nombre" value="<?php echo   $registro['nombre']; ?>" placeholder="Nombre Maquinaria " autofocus="on">
                                </div>
                                <div class="form-group">
                                    <select class="form-select" aria-label="Default select example" name="tipo">
                                        <option value="Soldadura" <?php if ($registro['tipo'] == 'Soldadura') echo 'selected'; ?>>Soldadura</option>
                                        <option value="Corte" <?php if ($registro['tipo'] == 'Corte') echo 'selected'; ?>>Corte</option>
                                        <option value="Proceso Semilla" <?php if ($registro['tipo'] == 'Proceso Semilla') echo 'selected'; ?>>Proceso Semilla</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="modelo" value="<?php echo   $registro['modelo']; ?>" placeholder="Modelo">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="numero_serie" value="<?php echo   $registro['numero_serie']; ?>" placeholder="numero_serie">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="fecha_adquisicion" value="<?php echo   $registro['fecha_adquisicion']; ?>" placeholder="fecha_adquisicion">
                                </div>
                                <div class="form-group">
                                    <select class="form-select" aria-label="Default select example" name="estado">
                                        <option value="Nuevo" <?php if ($registro['estado'] == 'Nuevo') echo 'selected'; ?>>Nuevo</option>
                                        <option value="Intermedio" <?php if ($registro['estado'] == 'Intermedio') echo 'selected'; ?>>Intermedio</option>
                                        <option value="Degradado" <?php if ($registro['estado'] == 'Degradado') echo 'selected'; ?>>Degradado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-select" aria-label="Default select example" name="ubicacion">
                                        <option value="Almacen" <?php if ($registro['ubicacion'] == 'Almacen') echo 'selected'; ?>>Almacen</option>
                                        <option value="Taller" <?php if ($registro['ubicacion'] == 'Taller') echo 'selected'; ?>>Taller</option>
                                        <option value="Bodega de Semillas 1" <?php if ($registro['ubicacion'] == 'Bodega de Semillas 1') echo 'selected'; ?>>Bodega de Semillas 1</option>
                                        <option value="Bodega de Semillas 2" <?php if ($registro['ubicacion'] == 'Bodega de Semillas 2') echo 'selected'; ?>>Bodega de Semillas 2</option>
                                        <option value="Bodega de Semillas 3" <?php if ($registro['ubicacion'] == 'Bodega de Semillas 3') echo 'selected'; ?>>Bodega de Semillas 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="id" value="<?php echo   $registro['id']; ?>" placeholder="id" readonly>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary btn-block"><i class="material-icons">ACTUALIZAR</i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php  }
        ?>
    </div>
</body>

</html>