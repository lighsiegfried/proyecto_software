<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./librerias/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css">
  <title>Inicio</title>
</head>
<body class="text-center">
    
<main class="form-signin w-100 m-auto">
  <form action="config/change_password.php" method="POST">
    <h2>Inventario de Notas</h2>
    <h2 class="h3 mb-3 fw-normal">Recupera tu contraseña</h2>
    <div class="form-floating my-3">
      <input type="password" class="form-control" id="floatingInput" name="new_password">
      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
      <label for="floatingInput">Nueva contraseña</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Recuperar contraseña</button>
  </form>
</main>


    
  </body>
</html>