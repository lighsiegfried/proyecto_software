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

 //se crea una funcion para hacer un PDO PHP y realizar consultas por medio del MVC
 function get_pdo() {
    global $host, $user, $password, $db , $pdo;
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo; // Devuelve el objeto PDO
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
        return null; // Retorna null si hay un error en la conexión
    }
}




?>
