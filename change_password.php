<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./librerias/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <script src="./librerias/jquery-3.7.1.js"></script>
  <script src="./librerias/jquery-3.7.1.min.js"></script>
  <script src="./librerias/sweetalert2@11.js"></script>
  <link rel="stylesheet" href="menu/assets/css/styles.css">
  <title>Reset</title>
  <style>
    main {
      position: relative;
      text-align: center;
    }

    #centrada {
      display: inline-block;
      transform: scale(0.9) translateX(-5.5%);
      /* Centra verticalmente */
    }
  </style>
</head>

<body class="text-center">
  
<div  class="containeer" style="position: relative;"> 
  <main id="main1" style="display: block;" class="form-background" >
  <form action="config/change_password.php" method="POST" class="form-signin w-100 m-auto" id="passwordForm" onsubmit="return validarContraseñas();" >
      <h2>Ingrese su nueva contraseña</h2>
      <h2 class="h3 mb-3 fw-normal"></h2>
      <div class="form-floating my-3">
        <input type="password" class="form-control" id="contra1" name="new_password">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <label for="contra1">Nueva contraseña</label>
      </div>
      <div class="form-floating my-3">
        <input type="password" class="form-control" id="contra2" name="new_password2">
        <input type="hidden" name="" value="">
        <label for="contra2">Confirmar nueva contraseña</label>
      </div>
      <button id="confirmButton" class="w-100 btn btn-lg btn-primary" type="submit">Confirmar</button>
    </form>
  </main>
</div>

</body>

</html>
<script>
function validarContraseñas() {
    var contrasenia1 = document.getElementById('contra1').value;
    var contrasenia2 = document.getElementById('contra2').value;

    if (contrasenia1 !== contrasenia2) {  
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Las contraseñas no coinciden",
        });
        return false; 
    } else {
        return true;
    }
}
function togglePasswordVisibility() {
    var passwordInput = document.getElementById('contra1');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}
</script>
