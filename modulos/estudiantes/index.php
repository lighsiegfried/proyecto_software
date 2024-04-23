<?php 
  require_once '../../config/validate_session.php';
  //require_once 'config/validate_roles.php';
  
  require_once('../../config/config.php');
  //librerias
get_pdo();
//librerias
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['rol'])):
  $rol = $_SESSION['rol'];
  if ($rol === 'Admin' || $rol === 'Profesor'):
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="./../../librerias/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
      <script type="text/javascript" src="../../librerias/jquery-3.7.1.min.js"></script>
      <script type="text/javascript" src="../../librerias/bootstrap-5.3.3/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../../librerias/remixicon-3.2.0/fonts/remixicon.css">
      <link rel="stylesheet" href="../../menu/assets/css/styles.css">
      <link rel="stylesheet" href="../../menu/assets/css/icon.css">

      <link rel="stylesheet" href="../../librerias/DataTables/datatables.css">
      <link rel="stylesheet" href="../../librerias/DataTables/datatables.min.css">
      <script src="../../librerias/DataTables/datatables.js"> </script>
      <script src="../../librerias/DataTables/datatables.min.js"> </script>
</head> 
<body>
<div style="margin: 100px 0 0 10px;"><?php include('../../menu/menu.php'); ?></div>


  <div class="containeer">
    <div class="row">
      <div class="col-12">
        <h1 Style="font-size: 45px; font-weight: bold;" >Estudiantes </h1>
      </div>
    </div>
  </div>
</body>
</html>
<?php elseif ($rol === 'Consultor'): ?>
    <div style="margin: 100px 0 0 10px;"> <?php include ('../SinPermisos/NoAcceso.php'); ?> </div>
  <?php
  endif; //segundo if
endif; //primer if ?>
