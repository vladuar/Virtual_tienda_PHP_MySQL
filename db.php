

<?php
$conexion = new mysqli( "localhost", "root","","virtualtienda");
if ($conexion->connect_error){
    die("Error de conexion a la BD:" . $conexion->connect_error);
}
?>
