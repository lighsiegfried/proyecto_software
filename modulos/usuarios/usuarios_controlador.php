<?php 
    require_once '../../config/validate_session.php';
    require_once('../../config/config.php');
    get_pdo();
    
    //especial para este modulo
    require_once('usuarios_modelo.php');
    $modelo= new usuarios_modelo();      
    require_once('usuarios_vista.php');
    $vista= new usuarios_vista();       

// ESTRUCTURA DE CONTROL
if (isset($_POST['accion'])) {
    $cod_menu = $_POST['accion'];
    switch ($cod_menu) { 

        case 'get_lista_vista':
            $vista->get_lista_vista();
        break;

        case 'get_lista_datos':
            $lista_de_usuarios=$modelo->get_usuarios();
            echo json_encode($lista_de_usuarios,true);
        break;


        default:
            $respuesta = [];
            $respuesta['estado'] = 0;
            $respuesta['contenido'] = "Accion no registrada($cod_menu) en ui_vista_u";
            echo json_encode($respuesta);
    }
    unset($_POST);
    exit;

 }
?>
