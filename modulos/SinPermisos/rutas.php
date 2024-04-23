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

//actividades
$actividades = '/proyecto_software/modulos/actividades/index.php';

//reportes
$reportes = '/proyecto_software/modulos/reportes/index.php';

