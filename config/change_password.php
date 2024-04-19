<?php 
require_once('config.php');
//$id = $_POST['id'];
$pass = $_POST['new_password'];

$encriptar = password_hash($pass, PASSWORD_DEFAULT);
$pass = $encriptar;
$query = "update login set pass = '$pass' where id = 1; ";
$conexion->query($query);

header("Location: ../index.php?message=success_password");




?>