<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
 
require_once('config.php');
require_once('../recovery.php');

$email = $_POST['email'];
$query = "
select 
t1.id,t1.usuario,t2.nombre as rol,t3.correo,t4.descripcion
FROM 
( /*tabla login*/ 
	select id,usuario,id_rol,id_personas,pass from login ) t1 left join 
(/*tabla roles*/ 
	select id,nombre,descripcion from roles ) t2 on t1.id_rol = t2.id left JOIN 
(/*tabla persona*/ 
	select id,correo,id_puesto from persona ) t3 on t1.id_personas = t3.id left JOIN 
(/*tabla puesto*/ 
	select id,descripcion from puesto ) t4 on t3.id_puesto = t4.id 
where t3.correo = '$email';
";
$result = $conexion->query($query);
$row = $result->fetch_assoc();

if($result->num_rows > 0){
  echo "ID del usuario encontrado: " . $row['id'];
  $mail = new PHPMailer(true);
  $usuario = $row['usuario'];
try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp-mail.outlook.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'restablecer_contrasenia@outlook.com';
    $mail->Password   = 'info*reset*';
    $mail->Port       = 587;

    $mail->CharSet = 'UTF-8';

    $mail->setFrom('restablecer_contrasenia@outlook.com', 'Sistema de reseteo de password');
    $mail->addAddress( $email, $usuario);
    $mail->isHTML(true);
    $mail->Subject = 'Recuperación de contraseña';
    
    $body = file_get_contents('../PHPMailer/body.html');
    $body = str_replace('{{id}}', $row['id'], $body);
    
    $mail->Body = $body;

    $mail->send();
    header("Location: ../index.php?message=ok");
} catch (Exception $e) {
  header("Location: ../index.php?message=error");
}

}else{
  header("Location: ../index.php?message=not_found");
}

?>
