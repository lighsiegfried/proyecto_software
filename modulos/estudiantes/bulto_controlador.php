<?php 
    session_start();
    require_once('../../bd_conexion.php');
    get_pdo();
    //especial para este modulo
    require_once('bulto_modelo.php');
    $modelo= new bulto_modelo();      
    require_once('bulto_vista.php');
    $vista= new bulto_vista();  

    //reciclar cod..
    require_once('../../modulo_produccion/mp_modelo.php');
    $modelo_general= new mp_modelo();
    require_once('../../modulo_produccion/mp_vista.php');
    $vista_general= new mp_vista();

     


// ESTRUCTURA DE CONTROL
if (isset($_POST['accion'])) {
    $cod_menu = $_POST['accion'];
    switch ($cod_menu) { 
        case 'get_user':
            $info = $_SESSION['usuario'];
            $respuesta = [];
            if ($info['cod_usuario'] == 43 or $info['cod_usuario'] == 162 or $info['cod_usuario'] == 25) {
                $respuesta['estado'] = 1;
                $respuesta['contenido'] = "permitido";
            } else {
                $respuesta['estado'] = 0;
                $respuesta['contenido'] = "no permitido";
            }

            case 'get_kardex_procesos_general_vista':
                $vista->mostrar_lista_general();
            break;

            case 'get_kardex_procesos_general_datos':
                $lista_general=$modelo->get_kardex_procesos(); 
                echo json_encode($lista_general,true);
             break;

            case 'get_kardex_procesos_bodega_vista':
            $lista_fecha=$modelo->get_fechas();
            $vista->mostrar_lista_bodega($lista_fecha);
            break;

            case 'get_kardex_procesos_bodega_datos':
                $year=$_POST['year'];
                $month=$_POST['month'];
                $fecha=$_POST['fecha_seleccionada'];
                $lista_bodega=$modelo->get_kardex_procesos_bodega($year,$month);
                echo json_encode($lista_bodega,true);
            break;


            case 'get_grafo_bodega_ubicaciones':
                $vista->get_grafo();
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
