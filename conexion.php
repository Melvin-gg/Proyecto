<?php 
$host="localhost";
$basedatos="proyecto5";
$usuario="root";
$contrasena="root";

$db= new mysqli( $host , $usuario , $contrasena, $basedatos );

 if( $db -> connect_errno ){
	die("fallo al conectar a la base de datos : (" . $conectar-> mysqli_connect_errno() . ")" .  $conectar ->mysqli_connect_error() );
	
}

else{
	
	
}
 ?>