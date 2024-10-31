<?php
include("../conexion.php");
session_start();

include('verificaRol.php');
// Solo permite el acceso a administradores
verificarRol('Admin');
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Ver Maquinarias</title>
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
                    <a class="nav-link"><i>BIENVENIDO: <?php echo $administrador; ?></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="crearMaquinaria.php"><i class="material-icons">arrow_back</i> Regresar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container pt-4">
    <div class="row">
        <div class="col-12">
            <h2>Tabla de Maquinarias</h2>
            <input class="form-control mb-3" id="searchInput" type="text" placeholder="Buscar por nombre" onkeyup="filterTable()">
            <div class="table-responsive">
                <table id="userTable" class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">TIPO</th>
                            <th scope="col">MODELO</th>
                            <th scope="col">NUM. DE SERIE</th>
                            <th scope="col">FECHA DE ADQUI.</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">UBICACIÓN</th>
                            <th scope="col">BORRAR</th>
                            <th scope="col">ACTUALIZAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mostrar = mysqli_query($db, "SELECT * FROM maquinarias");
                        if ($mostrar->num_rows > 0) {
                            while ($registro = mysqli_fetch_array($mostrar)) {
                        ?>
                                <tr>
                                    <td><?php echo $registro['nombre']; ?></td>
                                    <td><?php echo $registro['tipo']; ?></td>
                                    <td><?php echo $registro['modelo']; ?></td>
                                    <td><?php echo $registro['numero_serie']; ?></td>
                                    <td><?php echo $registro['fecha_adquisicion']; ?></td>
                                    <td><?php echo $registro['estado']; ?></td>
                                    <td><?php echo $registro['ubicacion']; ?></td>
                                    <td><a href="eliminar_maquinaria.php?id=<?php echo $registro['id']; ?>"><i class="material-icons" style="color:white;">delete</i></a></td>
                                    <td><a href="update_maquinaria.php?id=<?php echo $registro['id']; ?>"><i class="material-icons" style="color:white;">update</i></a></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='9' class='text-center'>No hay maquinarias registradas en la base de datos</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function filterTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("userTable");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

</body>

</html>
