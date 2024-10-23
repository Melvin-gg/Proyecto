<?php
include ("../conexion.php");
session_start();

if(!isset($_SESSION['u_usuario'])){
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
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Creación de Usuarios</title>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="principal.php">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="crearUsuarios.php"><i class="material-icons">arrow_back</i> Regresar</a>
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
    $mostrar = mysqli_query($db, "SELECT * FROM usuarios WHERE id='$id'");

    while($registro = mysqli_fetch_array($mostrar)) {
    ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-secondary">
                    <div class="card-body">
                        <form action="update.php" method="POST" autocomplete="off">
                            <div class="form-group mb-3">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" name="correo" value="<?php echo $registro['correo']; ?>" placeholder="Correo" required autofocus>
                            </div>
                            <div class="form-group mb-3">
                                <label for="clave">Clave</label>
                                <input type="text" class="form-control" name="clave" value="<?php echo $registro['clave']; ?>" placeholder="Clave" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo $registro['nombre']; ?>" placeholder="Nombre" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tipo_usuario">Tipo de Usuario</label>
                                <select class="form-select" name="tipo_usuario" required>
                                    <option value="Admin" <?php if ($registro['tipo_usuario'] == 'Admin') echo 'selected'; ?>>Admin</option>
                                    <option value="Usuario" <?php if ($registro['tipo_usuario'] == 'Usuario') echo 'selected'; ?>>Usuario</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id">ID</label>
                                <input type="number" class="form-control" name="id" value="<?php echo $registro['id']; ?>" readonly>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-secondary"><i class="material-icons">update</i> Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
