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
            $id_usuario = $_POST['id_usuario'];
            
            //get_alumnos_eliminar($id)
            $modelo->add_class($grado,$seccion,$id_usuario);
        break;

        case 'consultar_clase':
            $id = $_POST['id'];
            $lista_class=$modelo->consultar_clase($id);
            echo json_encode($lista_class,true);
        break;

        case 'consultar_clase2':
            $id = $_POST['id'];

            $lista_class=$modelo->consultar_clases($id);
            echo json_encode($lista_class,true);
        break;

        case 'guardar_alumno':
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $puesto = $_POST['puesto'];
            $clave = $_POST['clave'];
            $id_clase = $_POST['clase'];

            $modelo->insert_pesona($nombres,$apellidos,$correo,$puesto);
            
            $id_per=$modelo->get_id_pesona();
            foreach ($id_per as $valor) {
                $id_persona=$valor['id'];
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
            $id_usuario = $_POST['id_usuario'];
            $lista_actividades = [];
            $id_nuevo_estudiante = $modelo->agregar_nuevo_alumno($id_clave,$id_persona,$id_clase,$id_usuario);
            if($id_nuevo_estudiante != null && $id_nuevo_estudiante != 0){
                $lista_actividades = $modelo->get_actividades_clase($id_clase);
                $modelo->actualizar_actividades_nuevo_estudiante($id_nuevo_estudiante, $lista_actividades);
            }
            echo json_encode($id_nuevo_estudiante, true);
        break;

        case 'get_lista_vista':
            $lista=$modelo->show();
            $lista_class=$modelo->show_class();
            $vista->get_lista_vista($lista,$lista_class);
        break;

        case 'get_lista_datos':
            $lista_de_alumnos=$modelo->get_alumnos();
            echo json_encode($lista_de_alumnos,true);
        break;

        case 'consultar_actividad':
            $vista->get_actividad();
        break;

        case 'consultar_actividad_datos':
            $idEtapa = $_POST['idEtapa'];
            $idAlumno = $_POST['idAlumno'];
            $lista_actividades;
            $lista_actividades=$modelo->get_actividades($idEtapa, $idAlumno);
            echo json_encode($lista_actividades,true);
        break;

        case 'capturar_id_clase':
            $id = $_POST['id'];
            $grado = $_POST['grado'];
            $seccion = $_POST['seccion'];
            $lista=$modelo->capturar_id_clases($id,$grado,$seccion);
            echo json_encode($lista,true);
        break;

        case 'editar_alumno':
            $id = $_POST['id'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $puesto = $_POST['puesto'];
            $clave = $_POST['clave'];
            $clase = $_POST['clase'];
            $total_nota = $_POST['total_nota'];
            

            $id_per=$modelo->capturar_personas_estudiante($id);
            foreach ($id_per as $valor) {
                $id_personas=$valor['id_persona'];
            }

            $modelo->editar_usuario($id,$nombres,$apellidos,$correo,$puesto,$id_personas,$clave,$clase, $total_nota);
        break;

        case 'eliminar_alumno':
            $id = $_POST['id'];

            $person=$modelo->capturar_personas_estudiante($id);
            foreach ($person as $valor) {
                $persona=$valor['id_persona'];
            }
            $modelo->eliminar_alumno($id,$persona);
        break;

        case 'eliminar_clase':
            $id = $_POST['id'];
            $modelo->eliminar_clase($id);
        break;

        case 'get_lista_clases_excel':
            $clases_excel=$modelo->get_lista_clases_excel();
            echo json_encode($clases_excel,true);
        break;

        case 'get_actividades_clase':
            $id_clase = $_POST['id_clase'];
            $actividades_clases=$modelo->get_actividades_clase($id_clase);
            echo json_encode($actividades_clases,true);

        case 'actualizar_actividades_nuevo_estudiante':
            $id_estudiante = $_POST['id_estudiante'];
            $lista_actividades = $_POST['lista_actividades'];
            $modelo->actualizar_actividades_nuevo_estudiante($id_estudiante, $lista_actividades);


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
