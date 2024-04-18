<?php 
$host = "localhost";
$user = "root";
$password = "";
$db = "proyecto_software";

$conexion = new mysqli($host, $user, $password, $db);
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

//conectar con la maquina virtual
 if($conexion->connect_error){
echo "Falló la conexión a la base de datos: " . $conexion->connect_error;
 }


?>
