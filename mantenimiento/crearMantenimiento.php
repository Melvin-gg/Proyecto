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
  <title>Creación Usuarios</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    img:hover {
      height: 130px;
      border-radius: 70px;
    }
  </style>
  <script>
    function filterTable() {
      let input = document.getElementById("searchInput");
      let filter = input.value.toLowerCase();
      let table = document.getElementById("userTable");
      let tr = table.getElementsByTagName("tr");

      for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td")[2]; // La columna del nombre es la tercera (índice 2)
        if (td) {
          let txtValue = td.textContent || td.innerText;
          if (txtValue.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>

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
          <li class="nav-item">
            <a class=" navbar-brand nav-link" href="../usuarios/crearUsuarios.php">
              USUARIOS
            </a>
          </li>
          <li class="nav-item"><a class=" navbar-brand nav-link" href="../usuarios.php"><i class="material-icons">REGRESAR</i></a></li>
          <li class="nav-item"><a class=" navbar-brand nav-link" href="../finalizar.php"><i class="material-icons">SALIR exit_to_app</i></a>
          </li>
        </ul>
      </div>


    </div>
  </nav>
  <div class="container pt-4">

    <div class="row">


      <div class="col-8 ">
        <div class="card border-secondary">
          <div class="card-body">

            <form action="insertar_Mantenimiento.php" method="POST" autocomplete="off">
              <div class="form-group">
                <input type="text" class="form-control" name="nombre_equipo" placeholder="Nombre de Maquinaria " autofocus="on" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="descripcion" placeholder="Descripción" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="Frecuencia" placeholder="Frecuencia" required>
              </div>
              <div class="form-group">
                <label>Fecha de Inicio </label> <br>
                <input type="date" class="form-control" name="fecha_inicio"  required>
              </div>
              <div class="form-group">
                <label>Fecha de Fin </label> <br>
                <input type="date" class="form-control" name="fecha_fin"  required>
              </div>
              <div class="form-group">
                <label>Fecha Siguiente Mantenimiento</label> <br>
                <input type="date" class="form-control" name="fecha_sig_mant"  >
              </div>
              <div class="form-group">
              <label>Reprogramación </label> <br>
                <select class="form-select" aria-label="Default select example" name="reprogramacion">
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group">
              <label>Estado </label> <br>
                <select class="form-select" aria-label="Default select example" name="estado">
                  <option value="Activo">Activo</option>
                  <option value="Proceso">Proceso</option>
                  <option value="Finalizado">Finalizado</option>
                </select>
              </div>
              <div class="form-group">
                <input type="int" class="form-control" name="horas_invertidas" placeholder="Horas Invertidas" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="comentario" placeholder="Comentario" >
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


</body>

</html>