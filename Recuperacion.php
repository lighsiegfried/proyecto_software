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
<div class="containeer" style="position: relative;">
  <main  id="exito" class="form-background " >
    <div class="form-signin w-100 m-auto">
      <h2>Usuario Recuperado exitosamente. </h2>
      <img src="img/user.png" id="centrada" />
      <form action="index.php?message=success_password">
        <button class="button w-100" type="submit">INGRESAR</button>
      </form>
    </div>
  </main>
  </div>
</body>
</html>
<script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Cambio Realizado exitosamente",
            showConfirmButton: false,
            timer: 2300
        });

</script>



