<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    require_once('../config/config.php');
    //especial para este modulo
    require_once('controlador.php');
    $modelo= new menu_modelo();      
    require_once('vista.php');
    $vista= new menu_vista();  

  

// ESTRUCTURA DE CONTROL
if (isset($_POST['accion'])) {
    $cod_menu = $_POST['accion'];
    switch ($cod_menu) { 


            case 'get_info_user':
                $vista->mostrar_lista_general();
                $vista_general;
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
