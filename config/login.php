<?php 
require_once('config.php');
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$query = "
select 
	t1.id,t1.usuario,t2.nombre as rol,t3.correo,t4.descripcion,t1.pass
FROM 
( /*tabla login*/ 
	select id,usuario,id_rol,id_personas,pass from login ) t1 left join 
(/*tabla roles*/ 
	select id,nombre,descripcion from roles ) t2 on t1.id_rol = t2.id left JOIN 
(/*tabla persona*/ 
	select id,correo,id_puesto from persona ) t3 on t1.id_personas = t3.id left JOIN 
(/*tabla puesto*/ 
	select id,descripcion from puesto ) t4 on t3.id_puesto = t4.id 
where t1.usuario = '$usuario' and t1.pass = '$password' ;
";

$result = $conexion->query($query);
$row = $result->fetch_assoc();
 
 if($result->num_rows > 0){
    session_start();
    $_SESSION['id'] = $row['id'];
    $_SESSION['user'] = $row['usuario'];
    $_SESSION['rol'] = $row['rol'];
    $_SESSION['correo'] = $row['correo'];
    $_SESSION['descripcion'] = $row['descripcion'];


   header("Location: ../bienvenida.php"); 
 }else{
   header("Location: ../index.php");
 }

/*codigo con fallos - se podra reutilizar mas adelante*/
// if ($pass_hash && password_verify($password, $pass_hash)) {
//    $query = "
//    select t1.id,t1.usuario,t2.nombre as rol,t3.correo,t4.descripcion
//    FROM (
//        /*tabla login*/
//     select  id,usuario,id_rol,id_personas,pass from login
//    ) t1 left join
//    (/*tabla roles*/
//        select id,nombre,descripcion from roles
//    ) t2 on t1.id_rol = t2.id left JOIN
//    (/*tabla persona*/
//       select id,correo,id_puesto from persona
//    ) t3 on t1.id_personas = t3.id left JOIN
//    (/*tabla puesto*/
//       select id,descripcion from puesto 
//    ) t4 on t3.id_puesto = t4.id
//    where t1.usuario = ?;
//    "; 
//     $statement = $conexion->prepare($query);
//     $statement->bind_param("s", $usuario);
//     $statement->execute();
//     $result = $statement->get_result();

//     if ($row = $result->fetch_assoc()) {
//       session_start();
//       $_SESSION['id'] = $row['id'];
//       $_SESSION['user'] = $row['usuario'];
//       $_SESSION['rol'] = $row['rol'];
//       $_SESSION['correo'] = $row['correo'];
//       $_SESSION['descripcion'] = $row['descripcion'];
//       header("Location: ../bienvenida.php");
//       exit(); // Importante: detener la ejecución del script se me sobrecargara la db
//   } else {
//       header("Location: ../index.php");
//       exit();
//   }
// } else {
//   header("Location: ../index.php");
//   exit();
// }



?>