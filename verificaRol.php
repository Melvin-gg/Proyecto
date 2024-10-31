<?php
function verificarRol($rolNecesario) {
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== $rolNecesario) {
        // Redirige al usuario si no tiene el rol adecuado
        echo "<script>
            alert('No tienes permiso para realizar esta acción.');
            window.location.href = 'index.html';
        </script>";
        exit();

    }
}
?>

