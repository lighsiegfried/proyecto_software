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

        case 'guardar_clase':
            $grado = $_POST['grado'];
            $seccion = $_POST['seccion'];

            $modelo->add_class($grado,$seccion);
        break;

        case 'guardar_alumno':
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $puesto = $_POST['puesto'];
            $clave = $_POST['clave'];
            $id_clase = $_POST['clase'];
            $id_persona_mas=$modelo->id_up_personas();
            foreach ($id_persona_mas as $valor) {
                $id_persona_mas_uno=$valor['id'];
            }
            $id_clav=$modelo->existe_clase_asignacion($id_clase);
            if($id_clav === null)
            {
                $id_clave = 1;
            } else {
                foreach ($id_clav as $valor1) {
                    $id_clave=$valor1['clave'];
                }
            }
            $modelo->agregar_nuevo_alumno($nombres,$apellidos,$correo,$puesto,$id_clave,$id_persona_mas_uno,$id_clase);
        break;

        case 'get_lista_vista':
            $lista_class=$modelo->show_class();
            $vista->get_lista_vista($lista_class);
        break;

        case 'get_lista_datos':
            $lista_de_alumnos=$modelo->get_alumnos();
            echo json_encode($lista_de_alumnos,true);
        break;

        case 'editar_alumno':
            $id = $_POST['id'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $puesto = $_POST['puesto'];
            $clave = $_POST['clave'];
            $clase = $_POST['clase'];

            // $id_per=$modelo->capturar_personas($id);
            // foreach ($id_per as $valor) {
            //     $id_personas=$valor['id_personas'];
            // }

            // $resultado1=$modelo->editar_usuario($id,$nombres,$apellidos,$correo,$puesto,$usuario,$rol,$id_personas,$contrasenia);
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
