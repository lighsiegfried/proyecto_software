<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="librerias/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="menu/assets/css/styles.css">
  <title>Inicio de sesion</title>
</head> 
<body class="text-center">
  
<div class="containeer">
  <div class="form-background">
    
    <main class="form-signin w-100 m-auto">
      <form action="config/login.php" method="POST">
        <h1>INICIO DE SESION</h1>
        <div class="form-floating">
          <input type="usuario" class="form-control" id="floatingInput" placeholder="name@example.com" name="usuario">
          <label for="floatingInput">USUARIO</label>
        </div>
        <div class="form-floating mt-5">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
          <label for="floatingPassword">CONTRASEÑA</label>
        </div>

        <button class="button w-100" type="submit">INGRESAR</button>
        <div class="my-2" type="text">
          <a href="recovery.php">¿Olvidaste tu contraseña?</a>
        </div>
        <?php 
        if(isset($_GET['message'])){
        
        ?>
          <div class="alert alert-primary" role="alert">
            <?php 
            switch ($_GET['message']) {
              case 'ok':
                echo 'Por favor, revisa tu correo'; 
                break;
              case 'success_password':
                echo 'Inicia sesión con tu nueva contraseña';
                break;
                
              default:
                echo 'Algo salió mal, intenta de nuevo';
                break;
            }
            ?>
          </div>
        <?php
        }
        ?>
      </form>
     </main>
   </div>
 </div>
 
  </body>
</html>