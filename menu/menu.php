<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div id="menu">
    <ul>
        <li><a href="index.php" class="btn btn-primary">Inicio</a></li>
        <div class="mt-2"></div>
        <?php if(isset($_SESSION['user'])): ?>
            <li><a href="perfil.php" class="btn btn-success">Perfil</a></li>
            <div class="mt-2"></div>
            <li><a href="../config/logout.php" class="btn btn-warning ">Cerrar sesión</a></li>
        <?php else: ?>
            <li><a href="login.php">Iniciar sesión</a></li>
            <div class="mt-3"></div>
            <li><a href="registro.php">Registrarse</a></li>
        <?php endif; ?>
        <!-- Agrega más elementos del menú según sea necesario -->
    </ul>
</div>

