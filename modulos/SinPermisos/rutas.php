<?php 
//ruta  
$server_main = $_SERVER['DOCUMENT_ROOT'];

//server esquema ejemplo:  http
$server_schema = $_SERVER['REQUEST_SCHEME'];

//enlace logico
$division = '://';

//localhost ||  ejemplo: 192.170.125.1 en el hostting o el name
$server_host = $_SERVER['HTTP_HOST'];

//Logo web
$logoapp = '/proyecto_software/img/logo.png';

//retorna al index si en dicho caso no tienen privilegios para visitar ese modulo mendiante el link.
$retornoIndex = '/proyecto_software/config/logout.php';

//bienvenida
$bienvenida = '/proyecto_software/bienvenida.php';

//reportes
$reportes = '/proyecto_software/modulos/reportes/index.php';

//usuarios
$usuariosver = '/proyecto_software/modulos/usuarios/index.php';

//estudiantes
$estudiantes = '/proyecto_software/modulos/estudiantes/index.php';

//agregar grupo de estudiantes
$estudiantes2 = '/proyecto_software/modulos/estudiantes/agregar_grupo_alumnos/index.php';

//actividades
$actividades = '/proyecto_software/modulos/actividades/index.php';

//actividades asignadas, ver por lista de clase y etapa
$actividades2 = '/proyecto_software/modulos/actividades_asignadas/index.php';

//reportes
$reportes = '/proyecto_software/modulos/reportes/index.php';

//3312.gif
$gif3312 = '/proyecto_software/modulos/SinPermisos/3312.gif';

//3312.jpg
$jpg3312 = '/proyecto_software/modulos/SinPermisos/3312.jpg'; 

//recovery
$recovery = '/proyecto_software/change_password.php';

