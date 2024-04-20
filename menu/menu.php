<!-- saque los iconos de : https://remixicon.com/  Referencia unicamente-->
      <!--=============== header cabezita xd ===============-->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Administrador
if(isset($_SESSION['rol'])) {
   $rol = $_SESSION['rol'];

   if($rol === 'Admin') {
?>
      <header class="header">
         <nav class="nav container">
            <div class="nav__data">
               <a href="../../bienvenida.php" class="nav__logo">
                  <img src="img/logo.png" style="width: 100px; height: auto;  padding: 15px;"></img>  
                  Inventario de notas
               </a>
               
               <div class="nav__toggle" id="nav-toggle">
                  <i class="ri-menu-line nav__burger"></i>
                  <i class="ri-close-line nav__close"></i>
               </div>
            </div>

            <!--=============== nav bar===============-->
            <div class="nav__menu" id="nav-menu">
               <ul class="nav__list">

                        <li class="dropdown__item">
                            <div class="nav__link">
                                <i class="ri-bar-chart-line"></i><a href="#" class="nav__link" title="Reportes de alumnos"> Reportes </a><i class="ri-add-line dropdown__add"></i>
                            </div>
                        </li>
            <!--=============== dropdown usuarios ===============-->
            <li class="dropdown__item">
                     <div class="nav__link">
                     <a href="#" class="nav__link" title="Listado de usuarios">Usuarios</a><i class="ri-arrow-down-s-line dropdown__arrow"></i>
                     </div>

                     <ul class="dropdown__menu">
                        <li>
                           <a href="#" class="dropdown__link">
                              <i class="ri-user-line" title="Gestion de perfiles"></i> Perfiles
                           </a>                          
                        </li>

                        <li>
                           <a href="#" class="dropdown__link">
                              <i class="ri-lock-line" title="Permisos de usuarios"></i> Permisos
                           </a>
                        </li>
                     </ul>
                  </li>

                  <!--=============== dropdown estudiantes ===============-->
                  <li class="dropdown__item">
                     <div class="nav__link" >
                     <a href="modulos/estudiantes/index.php" class="nav__link" title="Listado de estudiantes">Estudiantes </a><i class="ri-arrow-down-s-line dropdown__arrow"></i>
                     </div>

                     <ul class="dropdown__menu">
                        <li>
                           <a href="#" class="dropdown__link">
                              <i class="ri-arrow-up-down-line"></i> -Modulo en construccion  
                           </a>  
                           <!-- class="ri-pie-chart-line"                         -->
                        </li>
                     </ul>
                  </li>
                  <li class="dropdown__item"><a href="#" class="nav__link" title="Actividades de alumnos">Actividades<i class="ri-arrow-down-s-line dropdown__arrow"></i></a></li>
                  <li class="dropdown__item"><a href="config/logout.php" class="nav__link" title="Cerrar sesion">Salir<i class="ri-logout-box-r-line"></i></a></li>  
               </ul>
            </div>
         </nav>
      </header>
<?php
   }
}

//Profesor, crud
if(isset($_SESSION['rol'])) {
   $rol = $_SESSION['rol'];

   if($rol === 'Profesor') {
?>
      <header class="header">
         <nav class="nav container">
            <div class="nav__data">
               <a href="#" class="nav__logo">
                  <img src="img/logo.png" style="width: 100px; height: auto;  padding: 15px;"></img>  
                  Inventario de notas
               </a>
               
               <div class="nav__toggle" id="nav-toggle">
                  <i class="ri-menu-line nav__burger"></i>
                  <i class="ri-close-line nav__close"></i>
               </div>
            </div>

            <!--=============== nav bar===============-->
            <div class="nav__menu" id="nav-menu">
               <ul class="nav__list">

                        <li class="dropdown__item">
                            <div class="nav__link">
                                <i class="ri-bar-chart-line"></i><a href="#" class="nav__link" title="Reportes de alumnos"> Reportes </a><i class="ri-add-line dropdown__add"></i>
                            </div>
                        </li>
                  <!--=============== dropdown estudiantes ===============-->
                  <li class="dropdown__item">
                     <div class="nav__link" >
                     <a href="#" class="nav__link" title="Listado de estudiantes">Estudiantes </a><i class="ri-arrow-down-s-line dropdown__arrow"></i>
                     </div>

                     <ul class="dropdown__menu">
                        <li>
                           <a href="#" class="dropdown__link">
                              <i class="ri-arrow-up-down-line"></i> -Modulo en construccion  
                           </a>  
                           <!-- class="ri-pie-chart-line"                         -->
                        </li>
                     </ul>
                  </li>
                  <li class="dropdown__item"><a href="#" class="nav__link" title="Actividades de alumnos">Actividades<i class="ri-arrow-down-s-line dropdown__arrow"></i></a></li>
                  <li class="dropdown__item"><a href="config/logout.php" class="nav__link" title="Cerrar sesion">Salir<i class="ri-logout-box-r-line"></i></a></li>  
               </ul>
            </div>
         </nav>
      </header>
<?php
   }
}

//consultor, no derecho a nada mas que consultas
if(isset($_SESSION['rol'])) {
   $rol = $_SESSION['rol'];

   if($rol === 'Consultor') {
?>
      <header class="header">
         <nav class="nav container">
            <div class="nav__data">
               <a href="#" class="nav__logo">
                  <img src="img/logo.png" style="width: 100px; height: auto;  padding: 15px;"></img>  
                  Inventario de notas
               </a>
               
               <div class="nav__toggle" id="nav-toggle">
                  <i class="ri-menu-line nav__burger"></i>
                  <i class="ri-close-line nav__close"></i>
               </div>
            </div>

            <!--=============== nav bar===============-->
            <div class="nav__menu" id="nav-menu">
               <ul class="nav__list">

                        <li class="dropdown__item">
                            <div class="nav__link">
                                <i class="ri-bar-chart-line"></i><a href="#" class="nav__link" title="Reportes de alumnos"> Reportes </a><i class="ri-add-line dropdown__add"></i>
                            </div>
                        </li>

                  <li class="dropdown__item"><a href="config/logout.php" class="nav__link" title="Cerrar sesion">Salir<i class="ri-logout-box-r-line"></i></a></li>  
               </ul>
            </div>
         </nav>
      </header>
<?php
   }
}
?> 
<script>
    /*=============== SHOW MENU ===============*/
const showMenu = (toggleId, navId) =>{
   const toggle = document.getElementById(toggleId),
         nav = document.getElementById(navId)

   toggle.addEventListener('click', () =>{
       // Add show-menu class to nav menu
       nav.classList.toggle('show-menu')

       // Add show-icon to show and hide the menu icon
       toggle.classList.toggle('show-icon')
   })
}

showMenu('nav-toggle','nav-menu')
</script>


