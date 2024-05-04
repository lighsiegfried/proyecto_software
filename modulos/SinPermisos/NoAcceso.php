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
  <link rel="stylesheet" href="../../menu/assets/css/styles.css">
  <!-- <script src="../../librerias/fontawesome-free-6.5.2/css/all.min.css"> </script> -->
  <title>Tenemos un infriltrado</title>
</head>
<style>
    .castor {
    margin-top: -100px;
  }
  .castor2 {
    margin-top: -30px;
  }
  .castor3 {
    margin-top: -18px;
  }
</style>
<body>
  <div class="castor">
    <div  Style="font-size: 45px; font-weight: bold;" class="text-light">
      <h1  Style="font-size: 45px; font-weight: bold;" class="text-light">Acceso denegado...</h1>
      <div class="mx-auto castor2" style="width: 600px;">
        <img src="<?php echo $server_schema . $division . $server_host . $jpg3312 ?>" alt="jpg" style="width: 600px;">
      </div>
      <div class="mt-2"></div>
      <div class="mx-auto x" style="width: 500px;">
        <img src="<?php echo $server_schema . $division . $server_host . $gif3312 ?>" alt="gif" style="width: 500px;">
      </div>
    </div>
    <div class="mt-4" Style="font-size: 45px; font-weight: bold;" class="text-light">
      <h1 Style="font-size: 45px; font-weight: bold;" class="text-light castor3">No posees permisos para acceder a</h1>
      <h1 Style="font-size: 45px; font-weight: bold;" class="text-light castor3">este modulo, contacta al Administrador..</h1>
    </div>
    <div class="mx-auto castor3" style="width: 200px;">
      <button class="btn btn-light" type="button">
        <a href="<?php echo $server_schema . $division . $server_host . $retornoIndex ?>" Style="font-size: 20px; font-weight: bold;" class="text-black" >Regresar a inicio</a>
      </button>
    </div>
    <div class="mt-4"></div>
  </div>
</body>

</html>