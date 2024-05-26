<!-- saque los iconos de : https://remixicon.com/  Referencia unicamente-->
<!--=============== header cabezita xd ===============-->
<?php
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

//manipular carpeta raiz "proyecto_software"
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto_software/modulos/SinPermisos/rutas.php');

?>
<header class="header">
   <nav class="nav container">
      <div class="nav__data">
         <a href="<?php echo $server_schema . $division . $server_host . $bienvenida ?>" class="nav__logo">
            <img src="<?php echo $logoapp ?>" style="width: 100px; height: auto;  padding: 15px;"></img>
            Seccion de notas
         </a>

         <div class="nav__toggle" id="nav-toggle">
            <i class="ri-menu-line nav__burger"></i>
            <i class="ri-close-line nav__close"></i>
         </div>
      </div>

      <!--=============== nav bar===============-->
      <div class="nav__menu" id="nav-menu">
         <ul class="nav__list">
            <?php if (isset($_SESSION['rol'])): ?>
               <?php $rol = $_SESSION['rol']; ?>
               <?php if ($rol === 'Admin'): ?>

                  <li class="dropdown__item">
                     <div class="nav__link">
                        <i class="ri-bar-chart-line"></i><a href="<?php echo $server_schema . $division . $server_host . $reportes ?>" class="nav__link" title="Reportes de alumnos"> Reportes
                        </a><i class="ri-line-chart-line"></i>
                     </div>
                  </li>
                  <!--=============== dropdown usuarios ===============-->
                  <li class="dropdown__item">
                     <div class="nav__link">
                        <a href="#" class="nav__link" title="Listado de usuarios">Usuarios</a><i
                           class="ri-arrow-down-s-line dropdown__arrow"></i>
                     </div>

                     <ul class="dropdown__menu">
                        <li>
                           <a href="<?php echo $server_schema . $division . $server_host . $usuariosver ?>" class="dropdown__link">
                              <i class="ri-user-line" title="Gestion de perfiles"></i> Perfiles y permisos <i class="ri-lock-line" title="Permisos de usuarios"></i>
                           </a>
                        </li>
                     </ul>
                  </li>

                  <!--=============== dropdown estudiantes ===============-->
                  <li class="dropdown__item">
                     <a href="#" class="nav__link" title="Lista de estudiantes">
                        Estudiantes<i class="ri-arrow-down-s-line dropdown__arrow"></i>
                     </a>
                     <ul class="dropdown__menu">
                        <li>
                           <a href="<?php echo $server_schema . $division . $server_host . $estudiantes?>" class="dropdown__link">
                              <i class="ri-pencil-ruler-2-line"></i> Agregar alumnos
                           </a>
                        </li>
                        <!-- <li>
                           <a href="<?php //echo $server_schema . $division . $server_host . $estudiantes2?>" class="dropdown__link">
                              <i class="ri-git-merge-fill"></i> Agregar grupo alumnos
                           </a>
                        </li> -->
                     </ul>
                  </li>
                  <li class="dropdown__item">
                        <a href="#" class="nav__link" title="Actividades de alumnos">
                        Actividades<i class="ri-arrow-down-s-line dropdown__arrow"></i>
                        </a>
                        <ul class="dropdown__menu">
                           <li>
                              <a href="<?php echo $server_schema . $division . $server_host . $actividades?>" class="dropdown__link">
                                 <i class="ri-arrow-up-down-line"></i> Crear actividad y etapa
                              </a>
                              <!-- class="ri-pie-chart-line" -->
                           </li>
                           <li>
                              <a href="<?php echo $server_schema . $division . $server_host . $actividades2?>" class="dropdown__link">
                                 <i class="ri-corner-down-right-fill"></i> Ver actividades
                              </a>
                           </li>
                        </ul>
                     </li>
               <?php elseif ($rol === 'Profesor'): ?>

                  <li class="dropdown__item">
                     <div class="nav__link">
                        <i class="ri-bar-chart-line"></i><a href="<?php echo $server_schema . $division . $server_host . $reportes ?>" class="nav__link" title="Reportes de alumnos"> Reportes
                        </a><i class="ri-line-chart-line"></i>
                     </div>
                  </li>
                  <!--=============== dropdown estudiantes ===============-->
                  <li class="dropdown__item">
                     <a href="#" class="nav__link" title="Lista de estudiantes">
                        Estudiantes<i class="ri-arrow-down-s-line dropdown__arrow"></i>
                     </a>
                     <ul class="dropdown__menu">
                        <li>
                           <a href="<?php echo $server_schema . $division . $server_host . $estudiantes?>" class="dropdown__link">
                              <i class="ri-pencil-ruler-2-line"></i> Agregar alumnos
                           </a>
                        </li>
                        <!-- <li>
                           <a href="<?php //echo $server_schema . $division . $server_host . $estudiantes2?>" class="dropdown__link">
                              <i class="ri-git-merge-fill"></i> Agregar grupo alumnos
                           </a>
                        </li> -->
                     </ul>
                  </li>
                  <li class="dropdown__item">
                        <a href="#" class="nav__link" title="Actividades de alumnos">
                        Actividades<i class="ri-arrow-down-s-line dropdown__arrow"></i>
                        </a>
                        <ul class="dropdown__menu">
                           <li>
                              <a href="<?php echo $server_schema . $division . $server_host . $actividades?>" class="dropdown__link">
                                 <i class="ri-arrow-up-down-line"></i> Crear actividad y etapa
                              </a>
                              <!-- class="ri-pie-chart-line" -->
                           </li>
                           <li>
                              <a href="<?php echo $server_schema . $division . $server_host . $actividades2?>" class="dropdown__link">
                                 <i class="ri-corner-down-right-fill"></i> Ver actividades
                              </a>
                           </li>
                        </ul>
                  </li>
               <?php elseif ($rol === 'Consultor'): ?>
                  <li class="dropdown__item">
                     <div class="nav__link">
                        <i class="ri-bar-chart-line"></i><a href="<?php  echo $server_schema . $division . $server_host . $reportes ?>" class="nav__link" title="Reportes de alumnos"> Reportes
                        </a><i class="ri-line-chart-line"></i>
                     </div>
                  </li>
               <?php endif; ?>
            <?php endif; ?>
            <li class="dropdown__item"><a href="<?php echo $server_schema . $division . $server_host. $retornoIndex ?>" class="nav__link" title="Cerrar sesion">Salir<i
                           class="ri-logout-box-r-line"></i></a></li>
         </ul>
      </div>
   </nav>
</header>



<script>
   /*=============== SHOW MENU ===============*/
   const showMenu = (toggleId, navId) => {
      const toggle = document.getElementById(toggleId),
         nav = document.getElementById(navId)

      toggle.addEventListener('click', () => {
         // Add show-menu class to nav menu
         nav.classList.toggle('show-menu')

         // Add show-icon to show and hide the menu icon
         toggle.classList.toggle('show-icon')
      })
   }

   showMenu('nav-toggle', 'nav-menu')
</script>