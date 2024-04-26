<?php 
    require_once '../../config/validate_session.php';
    require_once('../../config/config.php');
    get_pdo();
    
    //especial para este modulo
    require_once('estudiantes_modelo.php');
    $modelo= new estudiantes_modelo();      
    require_once('estudiantes_vista.php');
    $vista= new estudiantes_vista();       

// ESTRUCTURA DE CONTROL
if (isset($_POST['accion'])) {
    $cod_menu = $_POST['accion'];
    switch ($cod_menu) { 

        case 'guardar_alumno':
            $grado = $_POST['grado'];
            $seccion = $_POST['seccion'];

            $modelo->add_class($grado,$seccion);
        break;

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
        break;

        case 'editar_usuario':
            $id = $_POST['id'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $puesto = $_POST['puesto'];
            $usuario = $_POST['usuario'];
            $rol = $_POST['rol'];
            $contrasenia = $_POST['contrasenia'];

            $id_per=$modelo->capturar_personas($id);
            foreach ($id_per as $valor) {
                $id_personas=$valor['id_personas'];
            }

            $resultado1=$modelo->editar_usuario($id,$nombres,$apellidos,$correo,$puesto,$usuario,$rol,$id_personas,$contrasenia);
        break;

        case 'eliminar_usuario':
            $id = $_POST['id'];

            $person=$modelo->capturar_personas($id);
            foreach ($person as $valor) {
                $persona=$valor['id_personas'];
            }
            $modelo->eliminar_usuario($id,$persona);
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
