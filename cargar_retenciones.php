<?php
require_once('../bd_conexion.php');
get_pdo();




//SERVICIO
require_once("../pr_servicio_principal.php");
$servicio=new servicio_principal();

//RUTAS DEL REGISTRO DE RUTAS EN PR_SERVICIO_PRINCIPAL.PHP
$bootstrap_css=$servicio->get_ruta("bootstrap_css");
$bootstrap_js=$servicio->get_ruta("bootstrap_js");
$jquery=$servicio->get_ruta("jquery");
$alert2=$servicio->get_ruta("alert2");

$tablecss=$servicio->get_ruta("tablecss");
$tablejs=$servicio->get_ruta("tablejs");
$materialize=$servicio->get_ruta("materialize-icono");

$selecttablejs=$servicio->get_ruta("selecttablejs");
$tablepdf=$servicio->get_ruta("tablepdf");
$vfsfonts=$servicio->get_ruta("vfsfonts");


$tablecss_btn=$servicio->get_ruta("tablecss_btn");
$tablejs_btn=$servicio->get_ruta("tablejs_btn");
$tablejs_btn_bootstrap4=$servicio->get_ruta("tablejs_btn_bootstrap4");
$tablejs_btn_html5=$servicio->get_ruta("tablejs_btn_html5");
$tablejs_btn_print=$servicio->get_ruta("tablejs_btn_print");
$tablejs_btn_colvis=$servicio->get_ruta("tablejs_btn_colvis");
$moment=$servicio->get_ruta("moment");
$momentables=$servicio->get_ruta("momentables");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Contado</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">

        <!--LIBRERIAS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo $bootstrap_css; ?>">
        <link rel="stylesheet" href="<?php echo $tablecss; ?>">
        <link rel="stylesheet" href="<?php echo  $tablecss_btn; ?>">
        <link rel="stylesheet" href="<?php echo $materialize; ?>">


        <script src="<?php echo $jquery; ?>"></script>
		<script src="<?php echo $bootstrap_js; ?>"></script>
        <script src="https://unpkg.com/papaparse@latest/papaparse.min.js"></script>
		<script src="<?php echo $alert2; ?>"></script>
        <script src="<?php  echo $tablejs; ?>"></script>
        <script src="<?php echo $selecttablejs; ?>"></script>
        <script src="<?php echo $tablepdf; ?>"></script>
        <script src="<?php echo $vfsfonts; ?>"></script>

        <script src="<?php echo $tablejs_btn; ?>"></script>
        <script src="<?php echo $tablejs_btn_bootstrap4; ?>"></script>
        <script src="<?php  echo $tablejs_btn_html5; ?>"></script>
        <script src="<?php echo $tablejs_btn_print; ?>"></script>
        <script src="<?php echo $tablejs_btn_colvis; ?>"></script>
        <script src="<?php echo $moment; ?>"></script>
        <script src="<?php echo $momentables; ?>"></script>

        <script src="../librerias/CSV/csv.js"></script>
		<style>
			body{
				margin: 0;
				/* background-color: #EADDFF; */
			}
			.content {
				display: flex;
				justify-content: center;
				align-items: center;
				margin-top: 30px;
				flex-direction: column;
			}

			.item {
				background-color: white;
				/* color: white; */
				/* background-image: url('imagenes/paletaColoresEnvaseal.jpg'); */
				/* background-repeat: no-repeat;
				object-fit: cover;
				width: 100% */
			}

			input {
				box-shadow: 6px 6px 10px gray;
			}

			input:hover {
				box-shadow: 6px 6px 10px #2f2f79;
			}

			select {
				box-shadow: 6px 6px 10px gray;
			}

			select:hover {
				box-shadow: 6px 6px 10px #2f2f79;
			}

			h3{
				font-family: serif;
				font-weight: 800;
				font-size: 250%;
			}
            
            .marco {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                width: 95%;
                height: auto;
                margin: 2% 0;
                border: 3px solid black;
                border-image: linear-gradient(to right, var(--color1), var(--color2), var(--color3), var(--color4), var(--color5), var(--color6)) 2 / 1 / 0 stretch;
            }

            :root {
                --color1: #FDB913; /* Amarillo */
                --color2: #C4D82E; /* Lima */
                --color3: #00B3DC; /* Celeste */
                --color4: #652B7C; /* Morado */
                --color5: #EC0089; /* Rosado */
                --color6: #263287; /* Azul */
            }
            
		</style>
    </head>
    <body>
        <div class="content">
			<div class="marco">
				<div class="item  pt-5" style="width: 100%;">
                    <h3 class="pb-3 text-center text-uppercase">Importar datos de retenciones ( archivo csv )</h3>
        
                    <form method="post" id="import_excel_form" enctype="multipart/form-data" action="">
                        <div class="form-row align-items-center justify-content-center text-center p-5">
                            
                            <div class="d-flex w-100 justify-content-center pb-2">

                                <div class="col-6">
                                    <div class="row w-100 px-3">
                                        <div class="col-5 text-left">
                                            <label for="fec1" class="font-weight-bold">Cargar Archivo:</label>
                                        </div>
                                        <div class="col-7">
                                            <label class="btn btn-info w-100" title="CARGAR ARCHIVOS">
                                                <i class="fa fa-upload fa-2x" aria-hidden="true"></i>
                                                <input type="file" id="fileRetencion" name="fileRetencion" style="display: none;" accept=".xlsx, .xls, .csv">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="row w-100 px-3">
                                        <div class="col-5 text-left">
                                            <label for="fec1" class="font-weight-bold">Vaciar Datos:</label>
                                        </div>
                                        <div class="col-7">

                                            <script src="../componentesERP/buttonDelete.js" type="module"></script>
                                            <delete-button id="vaciar"></delete-button>
                                            <!-- <label class="btn btn-danger w-100" title="VACIAR DATOS">
                                                <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
                                                <input type="button" class="d-none" id="vaciar" name="vaciar">
                                            </label> -->
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex w-100 justify-content-center py-4">

                                <div class="row w-25 px-3">
									
									<div class="col">
                                        <input type="submit" name="import" id="import" class="btn btn-success w-50" value="Mostrar" />
									</div>
								</div>
							</div>

                            <div class="d-flex w-100 justify-content-center py-4">

                                <div class="row justify-content-md-center p-4">
                                    <div class="col-md-auto">
                                        <div class="table-responsive">
                                            <h3 class="pb-3 text-center text-uppercase">RETENCIONES</h3>
                                            <table id="tablaCSV" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                    <th scope="col" class="font-weight-bold">NIT</th>
                                                    <th scope="col" class="font-weight-bold">NOMBRE RETENEDOR</th>
                                                    <th scope="col" class="font-weight-bold">ESTADO CONSTANCIA</th>
                                                    <th scope="col" class="font-weight-bold">CONSTANCIA</th> 
                                                    <th scope="col" class="font-weight-bold">FECHA EMISION</th>
                                                    <th scope="col" class="font-weight-bold">TOTAL FACTURA</th>
                                                    <th scope="col" class="font-weight-bold">IMPORTE NETO</th>
                                                    <th scope="col" class="font-weight-bold">AFECTO RETENCIÓN</th>
                                                    <th scope="col" class="font-weight-bold">TOTAL RETENCIÓN</th>
                                                    <th scope="col" class="font-weight-bold">MONTO FACTURA</th>
                                                    <th scope="col" class="font-weight-bold">NUMERO FACTURA</th>
                                                    <th scope="col" class="font-weight-bold">CÓDIGO SAT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
							</div>

                        </div>
        
                        <!-- <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="file" required accept=".csv">
                                    <label class="custom-file-label" for="import_excel">Seleccione el archivo</label>
                                </div>
                            </div>
                        </div>
        
                        <div class="row justify-content-md-center">               
                            <input type="submit" name="import" id="import" class="btn btn-info" value="importar" />
                        </div> -->
        
                    </form>
                    <div id="btnGuardar" class="d-flex w-100 justify-content-center pb-2"></div>
                    <div class="w-100">
						<script src="../componente_FooterEnvaseal.js" type="module"></script>
						<footer-envaseal class="w-100"></footer-envaseal>
						<!-- <img src="imagenes/paletaColoresEnvasealBottom.jpg" style="object-fit: cover; width: 100%" alt="Paleta de Colores Envaseal"> -->
					</div>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function (){
        $('#import').on("click",function(e){
            e.preventDefault();
            $('#fileRetencion').parse({
                config: {
                    delimiter: ",",
                    complete: displayHTMLTable,
                    header: true,
                    skipEmptyLines: true,
                },
                before: function(file, inputElem)
                {
                    //console.log("Parsing file...", file);
                },
                error: function(err, file)
                {
                    //console.log("ERROR:", err, file);
                },
                complete: function()
                {
                    //console.log("Done with all files");
                }
            });
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        var idioma_espanol={
                select: {
                    rows: "%d fila seleccionada"
                },
                "sProcessing": "Procesando....",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros ",
                "sInfoEmpty": " Registros del (0 al 0) total de 0 registros ",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros) ",
                "sInfoPostFix": "",
                "sSearch": "Buscar",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "<b>No se encontraron datos</b>",
                "oPaginate":{
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": " Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": " Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad",
                "collection": "Colección",
                "colvisRestore": "Restaurar visibilidad",
                "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                "copySuccess": {
                    "1": "Copiada 1 fila al portapapeles",
                    "_": "Copiadas %ds fila al portapapeles"
                },
                "copyTitle": "Copiar al portapapeles",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todas las filas",
                    "_": "Mostrar %d filas"
                },
                "pdf": "PDF",
                "print": "Imprimir",
                "renameState": "Cambiar nombre",
                "updateState": "Actualizar",
                "createState": "Crear Estado",
                "removeAllStates": "Remover Estados",
                "removeState": "Remover",
                "savedStates": "Estados Guardados",
                "stateRestore": "Estado %d"
                }
        };


        function displayHTMLTable(results) {
            let response = results.data;
            // console.log(response);
            
            $('#tablaCSV').DataTable({
                data:response,
                "language":idioma_espanol, responsive: true, 

                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "order": [
                    [0, "asc"]
                ], 
                columns:[
                    { data: "NIT_RETENEDOR"},
                    { data: "NOMBRE_RETENEDOR"},
                    { data: "ESTADO_CONSTANCIA"},
                    { data: "CONSTANCIA"},
                    { data: "FECHA_EMISION"},
                    { data: "TOTAL_FACTURA"},
                    { data: "IMPORTE_NETO"},
                    { data: "AFECTO_RETENCION"},
                    { data: "TOTAL_RETENCION"},
                    { data: "MONTO_FACTURA"},
                    { data: "NUMERO_FACTURA"},
                    { data: "CODIGO_SAT"}
                    ],
                    columnDefs: [
                        
                        {
                            searchable: false,
                            orderable: false,
                            targets: 3
                        },
                        {
                            searchable: false,
                            orderable: false,
                            targets: 4
                        },
                        {
                            searchable: false,
                            orderable: false,
                            targets: 5
                        },
                        {
                            searchable: false,
                            orderable: false,
                            targets: 6
                        }
                    ],
                    // dom: 'Bfrtip',
                    dom: 'frt<"col-md-6 inline"i> <"col-md-6 inline"p>',
                    select: {
                            style: 'multi'
                        },
                        
                        buttons: {
                            dom: {
                                container:{
                                    tag:'div',
                                    className:'flexcontent'
                                }
                            },
                        }
                    });

            const boton = $('<button>', {
                text: 'Guardar',
                class: 'btn btn-success',
                click: function() {
                    guardarCSV(response);

                }
            });

            boton.appendTo('#btnGuardar');
            
                    
        }

        async function guardarCSV(response) {
            let resultado = null;
            // console.log(response);
            try {
                const respuesta = await fetch('guardarRetenciones.php', {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json; charset=utf-8'
                    },
                    body: JSON.stringify(response)
                });
                resultado = await respuesta.json();
            } catch (error) {
                console.error(error);
            }
            // console.log(resultado);
            if(resultado.estado == 1){
                Toast.fire({
                        icon: 'success',
                        title: 'Carga exitosa'
                    })
            }else{
                Toast.fire({
                        icon: 'error',
                        title: 'Carga fallida'
                    })
            }
            // return resultado;
        }


        let borradoCompleto = document.getElementById('vaciar').addEventListener('click', borrarTodo);

        async function borrarTodo(){
            let resultado = null;
            try {
                const respuesta = await fetch('guardarRetenciones.php');
                resultado = await respuesta.json();
            } catch (error) {
                console.error(error);
            }
            if(resultado.estado == 1){
                Toast.fire({
                        icon: 'success',
                        title: 'Vaciado exitoso'
                    })
            }else{
                Toast.fire({
                        icon: 'error',
                        title: 'Vaciado fallido'
                    })
            }
        }
    
    });
        
</script>