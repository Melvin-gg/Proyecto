<?php
include("../conexion.php");
session_start();

if (isset($_SESSION['u_usuario'])) {
} else {
  header("location: ../index.html");
}
?>
<?php
$usuario = $_SESSION['u_usuario'];
$proceso = mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$usuario'  ");
$resultado = mysqli_fetch_array($proceso);
$administrador = $resultado['nombre'];
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
  <title>Maquinaria</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
          <li class="nav-item"><a class=" navbar-brand nav-link"><i>BIENVENIDO: <?php echo $administrador  ?></i></a></li>
          </li>
          <li class="nav-item"><a class=" navbar-brand nav-link" href="../administrador.php"><i class="material-icons">REGRESAR</i></a></li>
          <li class="nav-item"><a class=" navbar-brand nav-link" href="verMaquinaria.php"><i class="material-icons">VER MAQUINARIAS</i></a></li>
          <li class="nav-item"><a class=" navbar-brand nav-link" href="../finalizar.php"><i class="material-icons">SALIR exit_to_app</i></a>
          </li>
        </ul>
      </div>


    </div>
  </nav>
  <div class="container pt-4">

    <div class="row">
      <div class="col-8">
        <div class="card border-secondary">
          <div class="card-body">
            <form action="insertar_maquinaria.php" method="POST" autocomplete="off">
              <div class="form-group">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre " autofocus="on" required>
              </div>
              <div class="form-group">
                <label for="fecha_mantenimiento">Tipo de mamquiaria:</label><br>
                <select class="form-select" aria-label="Default select example" name="tipo">
                  <option value="Soldadura">Soldadura</option>
                  <option value="Corte">Corte</option>
                  <option value="Proceso Semilla">Proceso Semilla</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="modelo" placeholder="modelo" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="numero_serie" placeholder="numero_serie" required>
              </div>
              <div class="form-group">
                <input type="date" class="form-control" name="fecha_adquisicion" placeholder="fecha_adquisicion" required>
              </div>
              <div class="form-group">
                <label for="estado">Estado de mamquiaria:</label><br>
                <select class="form-select" aria-label="Default select example" name="estado">
                  <option value="Nuevo">Nuevo</option>
                  <option value="Intermedio">Intermedio</option>
                  <option value="Degradado">Degradado</option>
                </select>
              </div>
              <div class="form-group">
                <label for="ubicacion">Ubicación de mamquiaria:</label><br>
                <select class="form-select" aria-label="Default select example" name="ubicacion">
                  <option value="Almacen">Almacen</option>
                  <option value="Taller">Taller</option>
                  <option value="Bodega de Semillas 1">Bodega de Semillas 1</option>
                  <option value="Bodega de Semillas 2">Bodega de Semillas 2</option>
                  <option value="Bodega de Semillas 3">Bodega de Semillas 3</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-secondary btn-block"><i class="material-icons">INSERTAR</i></button>
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