<?php 
require_once('../bd_conexion.php');
get_pdo();

class SalvarRetenciones {
    private $pdo;

    public function __construct(){
        global $pdo;
        $this->pdo=$pdo;
    }

    function guardar($guardar){

      try {
        //code...
        $this->pdo->beginTransaction();
        

        foreach ($guardar as $key => $value) {

          $NIT_RETENEDOR = $value['NIT_RETENEDOR'];
          $NIT_RETENEDOR2 = "$NIT_RETENEDOR";
          $NOMBRE_RETENEDOR = $value['NOMBRE_RETENEDOR'];
          $NOMBRE_RETENEDOR2 = "$NOMBRE_RETENEDOR";
          $ESTADO_CONSTANCIA = $value['ESTADO_CONSTANCIA'];
          $ESTADO_CONSTANCIA2 = "$ESTADO_CONSTANCIA";
          $CONSTANCIA = $value['CONSTANCIA'];
          $FECHA_EMISION = $value['FECHA_EMISION'];
          $FECHA_EMISION2 = "$FECHA_EMISION";
          $TOTAL_FACTURA = floatval(str_replace(',','', $value['TOTAL_FACTURA']));
          $IMPORTE_NETO = floatval(str_replace(',','', $value['IMPORTE_NETO']));
          $AFECTO_RETENCION = floatval(str_replace(',','', $value['AFECTO_RETENCION']));
          $TOTAL_RETENCION = floatval(str_replace(',','', $value['TOTAL_RETENCION']));
          $MONTO_FACTURA = floatval(str_replace(',','', $value['MONTO_FACTURA']));
          $NUMERO_FACTURA = $value['NUMERO_FACTURA'];
          $CODIGO_SAT = $value['CODIGO_SAT'];
  
          $qry = " INSERT into informacionRetenciones 
          values ('$NIT_RETENEDOR2', '$NOMBRE_RETENEDOR2', '$ESTADO_CONSTANCIA2', $CONSTANCIA, '$FECHA_EMISION2', $TOTAL_FACTURA,
          $IMPORTE_NETO, $AFECTO_RETENCION, $TOTAL_RETENCION, $MONTO_FACTURA, $NUMERO_FACTURA, $CODIGO_SAT)
          ";
          $qqry=$this->pdo->query($qry);

        }

        /*FIN BULTO ORIGEN*/
        $respuesta['estado']=1;
        $respuesta['contenido']='Bulto ingresado';
        // $this->pdo->rollback();
        $this->pdo->commit();

      } catch (PDOException $e) {
        $this->pdo->rollback();
        $respuesta['estado']=0;
        $respuesta['contenido']='Error en accion';
        $respuesta['info']='Error: '.$e->getMessage();
      }
        
        // echo "<pre>";
        // print_r($qry);
        // echo "</pre>";
        // $respuesta = $qqry->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;

    }


    function truncarTabla(){
      $qry = " TRUNCATE TABLE `informacionRetenciones`";
      $qqry=$this->pdo->query($qry);
      $respuesta['estado']=1;
      $respuesta['contenido']='Vaciado Completo';
      return $respuesta;
    }
    
}
$imprimir = [];
$guardar = [];
$respuesta=[];

$clase = new SalvarRetenciones();

if($_SERVER['REQUEST_METHOD'] === 'GET'){

  $respuesta = $clase->truncarTabla();

}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
  $data = file_get_contents("php://input");
  $info_bruto = json_decode($data, true);
  if(!empty($info_bruto)){
    foreach ($info_bruto as $key => $value) {
      $imprimir['NIT_RETENEDOR'] = $value['NIT_RETENEDOR'];
      $imprimir['NOMBRE_RETENEDOR'] = $value['NOMBRE_RETENEDOR'];
      $imprimir['ESTADO_CONSTANCIA'] = $value['ESTADO_CONSTANCIA'];
      $imprimir['CONSTANCIA'] = $value['CONSTANCIA'];
      $imprimir['FECHA_EMISION'] = $value['FECHA_EMISION'];
      $imprimir['TOTAL_FACTURA'] = $value['TOTAL_FACTURA'];
      $imprimir['IMPORTE_NETO'] = $value['IMPORTE_NETO'];
      $imprimir['AFECTO_RETENCION'] = $value['AFECTO_RETENCION'];
      $imprimir['TOTAL_RETENCION'] = $value['TOTAL_RETENCION'];
      $imprimir['MONTO_FACTURA'] = $value['MONTO_FACTURA'];
      $imprimir['NUMERO_FACTURA'] = $value['NUMERO_FACTURA'];
      $imprimir['CODIGO_SAT'] = $value['CODIGO_SAT'];
    
      $guardar[$key] = $imprimir;
    }
    
    
    $respuesta = $clase->guardar($guardar);
    
  }
}

// if(isset($_POST)){
// }




header("Content-Type: application/json");
echo json_encode($respuesta);

?>