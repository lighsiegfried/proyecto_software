<?php 
$host = "localhost:3306";
$user = "root";
$password = "Jorgeandres_1904";
$db = "proyecto_software";
$port = "3306";

$conexion = new mysqli($host, $user, $password, $db, $port);
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

//conectar con la maquina virtual
 if($conexion->connect_error){
echo "Falló la conexión a la base de datos: " . $conexion->connect_error;
 }

 //se crea una funcion para hacer un PDO PHP y realizar consultas por medio del MVC
 function get_pdo() {
    global $host, $user, $password, $db , $pdo, $port;
    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo; // Devuelve el objeto PDO
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
        return null; // Retorna null si hay un error en la conexión
    }
}




?>