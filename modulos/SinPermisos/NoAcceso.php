<?php
//rutas dinamicas
require_once ('rutas.php');
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
  <!-- <script src="../../librerias/fontawesome-free-6.5.2/css/all.min.css"> </script> -->
  <script src="usuarios_js.js"> </script>
</head>

<body>
  <div class="mt-4" Style="font-size: 45px; font-weight: bold;" class="text-light">
      <h1 class="mt-4" Style="font-size: 45px; font-weight: bold;" class="text-light">No posees permisos para acceder a este modulo, contacta al Administrador...</h1>   
  </div>
  <div class="mx-auto" style="width: 200px;">
      <button class="btn btn-light" type="button">
          <a href="<?php echo $server_schema . $division . $server_host . $retornoIndex ?>">Regresar a inicio</a>
      </button>
  </div>
</body>

</html>