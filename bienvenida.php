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
  <link rel="stylesheet" type="text/css" href="styles/style.css">
  <script type="text/javascript" src="./librerias/jquery-3.7.1.min.js"></script>
  <script type="text/javascript" src="script_toggleMenu.js"></script> 

  <title>Inicio</title>
</head> 
<body>
<button id="menuinteractivo">☰ Menu</button>
<?php include('menu/menu.php'); ?>
  <div class="container">
    <div class="row">
      <div class="col-12">
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <p>Bienvenido al sistema de inventarios de notas <?php echo $password ?> :</p>
        <a href="modulos/gastos" class="btn btn-success">Modulo en contruccion*</a>
        <a href="modulos/categorias" class="btn btn-primary">Categorías Modulo en construccion</a>
        <a href="modulos/usuarios" class="btn btn-secondary">Usuarios Modulo en construccion</a>
      </div>
    </div>
  </div>
</body>
</html>

