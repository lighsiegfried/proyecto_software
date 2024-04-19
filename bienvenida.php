<?php 
  require_once 'config/validate_session.php';
  //require_once 'config/validate_roles.php';
  
  require_once('./config/config.php');
  //librerias
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="librerias/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="./librerias/jquery-3.7.1.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="menu/assets/css/styles.css">
</head> 
<body>
  <div style="margin: 100px 0 0 10px;"><?php include('menu/menu.php'); ?></div>


  <div class="containeer">
    <div class="row">
      <div class="col-12">
        <h1>Bienvenido <?php echo $_SESSION['user'];?> - <?php echo $_SESSION['rol']; ?> </h1>
        <a href="modulos/gastos" class="btn btn-success">Modulo en contruccion*  </a>
        <a href="modulos/categorias" class="btn btn-primary">Categorías Modulo en construccion</a>
        <a href="modulos/usuarios" class="btn btn-secondary">Usuarios Modulo en construccion</a>
      </div>
    </div>
  </div>
</body>
</html>


