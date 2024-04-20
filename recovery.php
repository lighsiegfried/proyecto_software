<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="librerias/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="menu/assets/css/styles.css">
  <title>Restablecer</title>
</head>

<body class="text-center">
  <div class="containeer">
    <main class="form-background">
      <form action="config/recovery.php" method="POST" class="form-signin w-100 m-auto">
        <h1>RECUPERAR USUARIO</h1>
        <h4 class=" mb-3 fw-normal">Ingresa correo del usuario, para restaurar contraseña</h4>
        <div class="form-floating my-3">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
          <label for="floatingInput">Correo electrónico</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Recuperar contraseña</button>
      </form>
    </main>
  </div>
</body>

</html>