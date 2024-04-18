<?php 
require_once('config.php');
$email = $_POST['email'];
$password = $_POST['password'];

$query = "
select t1.usuario,t2.nombre,t3.correo,t4.descripcion
FROM (
    /*tabla login*/
 select  id,usuario,id_rol,id_personas,pass from login
) t1 left join
(/*tabla roles*/
    select id,nombre,descripcion from roles
) t2 on t1.id_rol = t2.id left JOIN
(/*tabla persona*/
   select id,correo,id_puesto from persona
) t3 on t1.id_personas = t3.id left JOIN
(/*tabla puesto*/
   select id,descripcion from puesto 
) t4 on t3.id_puesto = t4.id
where t3.correo = '$email' and t1.pass = $password;
";
///$query = "select * from login where usuario= '$password'";
$result = $conexion->query($query);
$row = $result->fetch_assoc();
 
 if($result->num_rows > 0){
   session_start();
   $_SESSION['user'] = $email;
   $_SESSION['rol'] = $row['rol'];
   header("Location: ../bienvenida.php");
 }else{
   header("Location: ../index.php");
 }

?>