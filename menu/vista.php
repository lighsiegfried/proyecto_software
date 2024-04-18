<?php
//variables globales
class menu_vista{
//funciones de vista

//lista general
function mostrar_lista_general(){
?>
<style>
        .checkbox-xl .form-check-input 
            {
                scale: 2;
            }
        .checkbox-xl .form-check-label 
            {
                padding-left: 5px; 
                margin-left: 5px; 
            }
</style>
<form id="lista_general_from1" method="post" class="mt-4">
 <div class="row justify-content-center ">
    <div class="col-11">
    <div class="card shadow">
        <div class="card-header">
            <h6> Movimientos Generales</h6>
        </div>
        <div class="card-body">
          <div class="dataTables_wrapper dt-bootstrap4">
           <div class="table-responsive">
            <table id="tablaOrigen" class="table table-striped table-bordered table-ml table-hover  p-3" style="width:100%">
                <thead class="table-active ">
                <tr>   
                    <th scope="col" class="text-center">Orden Movimiento</th> <!--codigos quemados -->
                    <th scope="col" class="text-center">Codigo de barra</th>
                    <th scope="col" class="text-center">Tipo de Orden</th>
                    <th scope="col" class="text-center">Pedido</th>
                    <th scope="col" class="text-center">Paso</th>
                    <th scope="col" class="text-center">Bodega</th>
                    <th scope="col" class="text-center">Proceso</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Proceso Bulto</th>
                    <th scope="col" class="text-center">Activo</th>
                    <th scope="col" class="text-center">Observaciones</th>
                    <th scope="col" class="text-center">Fecha de Solicitud</th>
                    <th scope="col" class="text-center">Usuario</th>
                    <th scope="col" class="text-center">Fecha que Modifico Usuario</th>
                    <th scope="col" class="text-center">Tiempo transcurrido</th>  
                </tr>
                </thead>
                <tbody>

                </tbody>
                    <tfoot class="table-active">
                        <tr>
                        <th scope="col" class="text-center">Orden Movimiento</th> <!--codigos quemados -->
                        <th scope="col" class="text-center">Codigo de barra</th>
                        <th scope="col" class="text-center">Tipo de Orden</th>
                        <th scope="col" class="text-center">Pedido</th>
                        <th scope="col" class="text-center">Paso</th>
                        <th scope="col" class="text-center">Bodega</th>
                        <th scope="col" class="text-center">Proceso</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col" class="text-center">Proceso Bulto</th>
                        <th scope="col" class="text-center">Activo</th>
                        <th scope="col" class="text-center">Observaciones</th>
                        <th scope="col" class="text-center">Fecha de Solicitud</th>
                        <th scope="col" class="text-center">Usuario</th>
                        <th scope="col" class="text-center">Fecha que Modifico Usuario</th>
                        <th scope="col" class="text-center">Tiempo transcurrido</th>  
                    </tfoot>
            </table>
           </div>
         </div>
       </div>
    </div>
   </div>
  </div>
</form>
<?php
}

function mostrar_lista_bodega($lista_fecha){
    ?>
    <style>
        .checkbox-xl .form-check-input 
            {
                scale: 2;
            }
        .checkbox-xl .form-check-label 
            {
                padding-left: 5px; 
                margin-left: 5px; 
            }
            .vertical-divider 
            {
            border-left: 2px solid #ddd;
            height: 100px;
            margin-top: -50px; 
            margin-left: 15px;
            }
    </style>
    <form id="lista_general_bodega" method="post" class="mt-4">
    <div class="mt-5"></div>
    <div class="row justify-content-center">
     <div class="col-11">
        <div class="card shadow">
            <div class="card-header">
                <h5> Movimientos de Bodega - Ubicaciones </h5>
            </div>
            <div class="card-body">
              <div class="dataTables_wrapper dt-bootstrap4">
               <div class="table-responsive">
               <div class="container row">
                    <div class="col-md-auto">
                        <select id="select_fecha" class="form-control" required>
                            <option value="<?php if (!isset($_POST['fecha_mes'])) echo 'null'; ?>" <?php if (!isset($_POST['fecha_mes'])) echo 'selected'; ?>>Seleccione Fecha</option>
                            <?php
                                foreach ($lista_fecha as $fechaa) {
                            ?>
                                <option value="<?php echo $fechaa['fecha_mes']; ?>" <?php if (isset($_POST['fecha_mes']) and $fechaa['fecha_mes'] == $_POST['fecha_mes']) echo "selected"; ?> >
                                    <?php echo $fechaa['anio'] . ' - ' . $fechaa['meses'] ; ?>
                                </option>
                            <?php
                            } 
                            ?>
                        </select>
                    </div>
                    <div class="col-md-auto checkbox-xl">
                        <input class="form-check-input mt-3" type="checkbox" value="desc" id="barraDesc" >
                        <label class="form-check-label mt-2" for="inlineCheckbox1">Codigo de barra</label>
                    </div>
                    <div class="col-md-auto checkbox-xl">
                        <input class="form-check-input mt-3 " type="checkbox" value="desc" id="pedidoDesc" >
                        <label class="form-check-label mt-2" for="inlineCheckbox1">Pedido</label>
                    </div>
                    <div class="col-md-auto checkbox-xl">
                        <input class="form-check-input mt-3" type="checkbox" value="desc" id="fechaPedidoDesc" >
                        <label class="form-check-label mt-2" for="inlineCheckbox1">Fecha Pedido</label>
                    </div>
                    <div class="col-md-auto vertical-divider "></div>
                    <div class="col-md-auto checkbox-xl ">
                        <input class="form-check-input mt-3 " type="radio" name="flexRadioDefault" id="asc" value="asc" >
                        <label class="form-check-label mt-2" for="flexRadioDefault2">
                            Ascendente
                        </label>
                    </div>
                    <div class="col-md-auto checkbox-xl">
                        <input class="form-check-input mt-3" type="radio" name="flexRadioDefault" id="desc" value="desc">
                        <label class="form-check-label mt-2" for="flexRadioDefault2">
                            Descendente
                        </label>
                    </div>
                    <div class="col-md-auto mb-4">
                        <div class="col-md-auto">
                            <button id="get_fechaa" class="btn btn-secondary justify-content-md-center " type="submit"><i class="material-icons">search</i> Consultar</button>
                        </div>
                    </div>
                </div>
                    <table id="tablaBodega" class="table table-striped table-bordered table-ml table-hover  p-3" style="width:100%">
                        <thead class="table-active ">
                        <tr>   
                            <th scope="col" class="text-center">Orden Movimiento</th> <!--codigos quemados -->
                            <th scope="col" class="text-center">Codigo de barra</th>
                            <th scope="col" class="text-center">Tipo de Orden</th>
                            <th scope="col" class="text-center">Pedido</th>
                            <th scope="col" class="text-center">Paso</th>
                            <th scope="col" class="text-center">Bodega</th>
                            <th scope="col" class="text-center">Proceso</th>
                            <th scope="col" class="text-center">Estado</th>
                            <th scope="col" class="text-center">Proceso Bulto</th>
                            <th scope="col" class="text-center">Activo</th>
                            <th scope="col" class="text-center">Observaciones</th>
                            <th scope="col" class="text-center">Fecha de Solicitud</th>
                            <th scope="col" class="text-center">Usuario</th>
                            <th scope="col" class="text-center">Fecha que Modifico Usuario</th>
                            <th scope="col" class="text-center">Tiempo transcurrido</th>  
                        </tr>
                        </thead>
                        <tbody>
        
                        </tbody>
                            <tfoot class="table-active">
                                <tr>
                                <th scope="col" class="text-center">Orden Movimiento</th> <!--codigos quemados -->
                                <th scope="col" class="text-center">Codigo de barra</th>
                                <th scope="col" class="text-center">Tipo de Orden</th>
                                <th scope="col" class="text-center">Pedido</th>
                                <th scope="col" class="text-center">Paso</th>
                                <th scope="col" class="text-center">Bodega</th>
                                <th scope="col" class="text-center">Proceso</th>
                                <th scope="col" class="text-center">Estado</th>
                                <th scope="col" class="text-center">Proceso Bulto</th>
                                <th scope="col" class="text-center">Activo</th>
                                <th scope="col" class="text-center">Observaciones</th>
                                <th scope="col" class="text-center">Fecha de Solicitud</th>
                                <th scope="col" class="text-center">Usuario</th>
                                <th scope="col" class="text-center">Fecha que Modifico Usuario</th>
                                <th scope="col" class="text-center">Tiempo transcurrido</th>  
                                </tr>
                   
                            </tfoot>
                    </table>
                    <div class="row d-flex flex-row-reverse" id="leyenda"></div>
               </div>
             </div>
           </div>
        </div>
        
      </div>
     </div>              
    </form>
    <?php 
    }


function get_grafo(){
//imagen en formato base64 para pdf
global $imagen_logo1;
global $imagen_logo2;
global $imagen_logo3;
?>
        <div class="d-flex justify-content-center mb-4"> 
            <input type="hidden" name="fecha" id="fecha"></input>
            <input type="hidden" name="variable" id="variable"></input> <!--Grafica Variable a pdf -->
            <input type="hidden" name="logoTipo" id="logoTipo" value="data:image/png;base64,<?php echo $imagen_logo1 . $imagen_logo2 . $imagen_logo3 ?>"></input>
            <input type="hidden" name="dataTablaaa" id="dataTablaaa"></input> <!--tabla Variable a pdf -->
            <div class="row justify-content-center mt-4" id="dataTablaa"></div>
            <!-- <input type="submit" value="Gráfica pdf" class="btn btn-danger mt-5 mr-5 float-right"></input> -->
        </div>
        <div class="d-flex justify-content-center">
                <div class="row d-flex flex-row-reverse mt-4" id="leyenda"></div>
                <div class="row justify-content-center mt-4" id="dataTablee"></div>
            <div id="piechart" style="width: 1200px; height: 800px;"></div>
        </div>
    <?php
}

}
?>