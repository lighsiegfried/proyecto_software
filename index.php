<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="librerias/bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css">
  <title>Inicio</title>
</head> 
<body class="text-center">
  
<div class="container">
  <div class="form-background">
    <main class="form-signin w-100 m-auto">
      <form action="config/login.php" method="POST">
        <h1>Inventario de Notas</h1>
        <h1>Iniciar sesión</h1>
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
          <label for="floatingInput">Correo electrónico</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
          <label for="floatingPassword">Password</label>
        </div>

        <button class="button w-100" type="submit">Iniciar sesión</button>
        <div class="my-2">
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