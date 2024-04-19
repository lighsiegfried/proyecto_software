<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./librerias/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css">
  <title>Reset</title>
</head>
<body class="text-center">
    
<main id="main1" class="form-signin w-100 m-auto" style="display: block;">
  <form action="config/change_password.php" method="POST" class="form-background" id="passwordForm">
    <h2>Inventario de Notas</h2>
    <h2 class="h3 mb-3 fw-normal">Recupera tu contraseña</h2>
    <div class="form-floating my-3">
      <input type="password" class="form-control" id="floatingInput" name="new_password">
      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
      <label for="floatingInput">Nueva contraseña</label>
    </div>
    <div class="form-floating my-3">
      <input type="password" class="form-control" id="floatingInput2" name="new_password2">
      <input type="hidden" name="" value="">
      <label for="floatingInput">Confirmar nueva contraseña</label>
    </div>
    <button id="confirmButton" class="w-100 btn btn-lg btn-primary" type="submit">Confirmar</button>
  </form>
</main>
  <main id="exito" class="form-signin w-100 m-auto" style="display: none;">
      <div class="form-background" >
          <h2>Usuario Recuperado exitosamente. </h2>
            <div class="col-md-6 col-md-offset-3">
              <img src="img/user.png" class="img-responsive center-block"/>
              <div class="h-30"></div>
            </div>
      </div>
  </main>
</body>
</html>
<script>
  //document.getElementById("passwordForm").addEventListener("submit", function(event) {
    //event.preventDefault();
    document.getElementById("main1").style.display = "none";
    document.getElementById("exito").style.display = "block"; 
  //});
</script>
