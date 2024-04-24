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

        case 'guardar_usuario':
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $puesto = $_POST['puesto'];
            $usuario = $_POST['usuario'];
            $rol = $_POST['rol'];
            $contrasenia = $_POST['contrasenia'];

            $id_persona_mas=$modelo->id_up_personas();
            foreach ($id_persona_mas as $valor) {
                $id_persona_mas_uno=$valor['id'];
            }
            $modelo->agregar_nuevo_usuario($nombres,$apellidos,$correo,$puesto,$usuario,$rol,$id_persona_mas_uno,$contrasenia);
            // $respuesta = ["mensaje" => "Usuario guardado correctamente"];
            // echo json_encode($respuesta);
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
