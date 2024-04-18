<?php
session_start();
require_once('../../bd_conexion.php');
get_pdo();

//servicio      google_charts
require_once("../../pr_servicio_principal.php");

$servicio = new servicio_principal();


//RUTAS DEL REGISTRO DE RUTAS EN PR_SERVICIO_PRINCIPAL.PHP
$bootstrap_css=$servicio->get_ruta("bootstrap_css_5");
$bootstrap_js=$servicio->get_ruta("bootstrap_js_5");
$materialize=$servicio->get_ruta("materialize-icono");
$jquery=$servicio->get_ruta("jquery");
$tablecss=$servicio->get_ruta("tablecss");
$tablejs=$servicio->get_ruta("tablejs");
$alert2=$servicio->get_ruta("alert2");

$selecttablejs=$servicio->get_ruta("selecttablejs");
$selecttablecss=$servicio->get_ruta("selecttablecss");
$searchtablejs=$servicio->get_ruta("searchtablejs");
$searchtablecss=$servicio->get_ruta("searchtablecss");
$google_charts=$servicio->get_ruta("google_charts");

$tablepdf=$servicio->get_ruta("tablepdf");
$vfsfonts=$servicio->get_ruta("vfsfonts");

$tablecss_btn=$servicio->get_ruta("tablecss_btn");
$tablejs_btn=$servicio->get_ruta("tablejs_btn");
$tablejs_btn_bootstrap4=$servicio->get_ruta("tablejs_btn_bootstrap4");
$tablejs_btn_html5=$servicio->get_ruta("tablejs_btn_html5");
$tablejs_btn_print=$servicio->get_ruta("tablejs_btn_print");
$tablejs_btn_colvis=$servicio->get_ruta("tablejs_btn_colvis");

$tables_responsive=$servicio->get_ruta("tables_responsive");
$tables_header=$servicio->get_ruta("tables_header");

$momentables=$servicio->get_ruta("momentables");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--LIBRERIAS-->
    <link rel="stylesheet" href="<?php echo $bootstrap_css; ?>">
    <link rel="stylesheet" href="<?php echo $materialize; ?>">
    
    
    <link rel="stylesheet" href="<?php echo $tablecss_btn; ?>">
    <link rel="stylesheet" href="<?php echo $tablecss; ?>">
    <link rel="stylesheet" href="<?php echo $materializecss; ?>">
    <link rel="stylesheet" href="<?php echo $selecttablecss; ?>">
    <link rel="stylesheet" href="<?php echo $searchtablecss; ?>">
    
    
    <script src="<?php echo $jquery; ?>"></script>
    <script src="<?php echo $tablejs; ?>"></script>
    <script src="<?php echo $selecttablejs; ?>"></script>
    <script src="<?php echo $tablepdf; ?>"></script>
    <script src="<?php echo $vfsfonts; ?>"></script>
    <script src="<?php echo $tables_responsive; ?>"></script>
    <script src="<?php echo $tablejs_btn; ?>"></script>
    <script src="<?php echo $tablejs_btn_bootstrap4; ?>"></script>
    <script src="<?php echo $tablejs_btn_html5; ?>"></script>
    <script src="<?php echo $tablejs_btn_print; ?>"></script>
    <script src="<?php echo $tablejs_btn_colvis; ?>"></script>
    <script src="<?php echo $bootstrap_js; ?>"></script>
    <script src="<?php echo $alert2; ?>"></script>
    <script src="<?php echo $momentables; ?>"></script>
    <script src="<?php echo $google_charts; ?>"></script> 
    <script type="text/javascript" src="bulto_js.js"></script> 
    
    <title > Diario de bultos </title>
</head>

<body>

    <div class="card-body">
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-3">
                <h1>Kardex Procesos</h1>
            </div>
        </div>
        <div id="lista_completa"></div> 
        <div id="lista_bodega" class="mt-4"></div>
        <div id="grafo" class="mb-4"></div>
    </div>
    

</body>

</html>
