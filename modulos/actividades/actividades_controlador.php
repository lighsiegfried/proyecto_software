<?php 
    require_once '../../config/validate_session.php';
    require_once('../../config/config.php');
    get_pdo();
    
    //especial para este modulo
    require_once('actividades_modelo.php');
    $modelo= new actividades_modelo();      
    require_once('actividades_vista.php');
    $vista= new actividades_vista();       

// ESTRUCTURA DE CONTROL
if (isset($_POST['accion'])) {
    $cod_menu = $_POST['accion'];
    switch ($cod_menu) { 

        case 'guardar_etapa':
            $nombre_etapa = $_POST['nombre_etapa'];
            $id_usuario = $_POST['id_usuario'];
            $modelo->add_etapa($nombre_etapa,$id_usuario);
        break;

        case 'guardar_actividad':
            $nombre_actividad = $_POST['nombre_actividad'];
            $descripcion = $_POST['descripcion'];
            $punteo = $_POST['punteo'];
            $etapa = $_POST['etapa'];
            $id_usuario = $_POST['id_usuario'];
            $modelo->agregar_nuevo_actividad($nombre_actividad,$descripcion,$punteo,$etapa,$id_usuario);
        break;

        case 'get_lista_vista':
            $lista=$modelo->show();
            $vista->get_lista_vista($lista);
        break;

        case 'get_lista_datos':
            $lista_actividades=$modelo->get_actividades();
            echo json_encode($lista_actividades,true);
        break;

        case 'editar_actividad':
            $id = $_POST['id'];
            $nombre_actividad = $_POST['nombre_actividad'];
            $descripcion = $_POST['descripcion'];
            $punteo = $_POST['punteo'];
            $etapa = $_POST['etapa'];

            $modelo->editar_actividad1($id,$nombre_actividad,$descripcion,$punteo,$etapa);
        break;

        case 'eliminar_actividad':
            $id = $_POST['id'];
            $modelo->eliminar_actividad($id);
        break;

        case 'eliminar_etapa':
            $id = $_POST['id'];
            $modelo->eliminar_etapa($id);
        break;

        case 'consulta_etapa':
            $id = $_POST['id'];
            $lista=$modelo->consultar_etapa($id);
            echo json_encode($lista,true);
        break;

        default:
            $respuesta = [];
            $respuesta['estado'] = 0;
            $respuesta['contenido'] = "Accion no registrada($cod_menu), checkear controlador.";
            echo json_encode($respuesta);
    }
    unset($_POST);
    exit;

 }
?>
