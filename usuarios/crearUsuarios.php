<?php
include ("../conexion.php");
session_start();

if(!isset($_SESSION['u_usuario'])){
  header("location: ../index.html");
  exit;
}

$usuario = $_SESSION['u_usuario'];
$proceso = mysqli_query($db, "SELECT * FROM usuarios WHERE correo='$usuario'");
$resultado = mysqli_fetch_array($proceso);
$administrador = $resultado['nombre'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creación Usuarios</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="principal.php">Sistema Usuarios</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i>BIENVENIDO: <?php echo $administrador ?></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../usuarios/crearUsuarios.php">USUARIOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../administrador.php"><i class="material-icons">REGRESAR</i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../finalizar.php"><i class="material-icons">SALIR exit_to_app</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container pt-4">
        <div class="row">
            <!-- Formulario de creación de usuarios -->
            <div class="col-md-4">
                <div class="card border-secondary mb-4">
                    <div class="card-body">
                        <form action="insertar_usuario.php" method="POST" autocomplete="off">
                            <div class="form-group">
                                <input type="email" class="form-control" name="correo" placeholder="Correo" autofocus required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="clave" placeholder="Clave" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="tipo_usuario">
                                    <option value="Usuario">Usuario</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-secondary btn-block"><i class="material-icons">AGREGAR USUARIO</i></button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla de usuarios -->
            <div class="col-md-8">
                <h2>Usuarios</h2>
                <input class="form-control mb-3" id="searchInput" type="text" placeholder="Buscar por nombre" onkeyup="filterTable()">

                <!-- Tabla responsive -->
                <div class="table-responsive">
                    <table id="userTable" class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">CORREO</th>
                                <th scope="col">CLAVE</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">ROL</th>
                                <th scope="col">BORRAR</th>
                                <th scope="col">ACTUALIZAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $mostrar = mysqli_query($db, "SELECT * FROM usuarios");
                            while ($registro = mysqli_fetch_array($mostrar)) {
                                $claveOfuscada = str_repeat('*', strlen($registro['clave']));
                            ?>
                            <tr>
                                <td><?php echo $registro['correo']; ?></td>
                                <td><?php echo $claveOfuscada; ?></td>
                                <td><?php echo $registro['nombre']; ?></td>
                                <td><?php echo $registro['tipo_usuario']; ?></td>
                                <td><a href="eliminar_usuario.php?id=<?php echo $registro['id']; ?>"><i style="color:white;" class="material-icons">delete</i></a></td>
                                <td><a href="update_usuario.php?id=<?php echo $registro['id']; ?>"><i style="color:white;" class="material-icons">update</i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
