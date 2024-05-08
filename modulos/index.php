<?php
//valida sesion
require_once ('../config/validate_session.php');
require_once ('../config/config.php');
get_pdo();
//librerias
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
//acceso prohibido, tanto para usuarios loggeados como para cuerpos externos...
if (isset($_SESSION['rol'])):
  $rol = $_SESSION['rol'];
  if ($rol === 'Admin' || $rol === 'Profesor' || $rol === 'Consultor'): ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="./../librerias/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
      <script type="text/javascript" src="../librerias/jquery-3.7.1.min.js"></script>
      <script type="text/javascript" src="../librerias/bootstrap-5.3.3/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../librerias/remixicon-3.2.0/fonts/remixicon.css">
      <link rel="stylesheet" href="../menu/assets/css/styles.css">
      <link rel="stylesheet" href="../menu/assets/css/icon.css">
    </head>
    <body>
        <div style="margin: 100px 0 0 10px;"> <?php include ('SinPermisos/NoAcceso.php'); ?> </div>
    </body>
    </html>

    <?php
  endif; //segundo if
endif; //primer if ?>