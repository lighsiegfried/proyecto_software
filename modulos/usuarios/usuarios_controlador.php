<?php 
    session_start();
    require_once('../../bd_conexion.php');
    //especial para este modulo
    require_once('usuarios_modelo.php');
    $modelo= new usuarios_modelo();      
    require_once('usuarios_vista.php');
    $vista= new usuarios_vista();       


// ESTRUCTURA DE CONTROL
if (isset($_POST['accion'])) {
    $cod_menu = $_POST['accion'];
    switch ($cod_menu) { 
        case 'get_user':
            $info = $_SESSION['usuario'];
            $respuesta = [];
            // Aquí puedes poner la lógica para verificar los permisos del usuario
            if (/* Condición para verificar los permisos */) {
                $respuesta['estado'] = 1;
                $respuesta['contenido'] = "permitido";
            } else {
                $respuesta['estado'] = 0;
                $respuesta['contenido'] = "no permitido";
            }


            case 'get_lista':
                $vista->get_lista_vista();
            break;
            
            echo json_encode($respuesta);
            break;

        default:
            $respuesta = [];
            $respuesta['estado'] = 0;
            $respuesta['contenido'] = "Accion no registrada($cod_menu)";
            echo json_encode($respuesta);
            break;
    }
    exit;
}

