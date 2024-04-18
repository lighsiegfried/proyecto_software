$(document).ready(function (){

    //variables GLOBALES
    var set_spinner = `<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" role="status"> <span class="sr-only"></span> </div> </div>`;
    var fecha_seleccionada,year,month,pdf,logo,ascen,desc,fechaPedidoDesc,pedidoDesc,barraDesc,ordMovi,ascDesFinbarra,ascDesFinpedido,ascDesFinfecha,tabladata,legend,color='red';
    var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];


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
    //---------------------------------------------------------------------------------------------------------------------------------------

    function get_contenido(){
        //get_lista_completa();
        //get_lista_bodega();
        
        get_grafiti();
    }

    get_contenido();

    function get-info_user(){
        $('#grafo').html(set_spinner);
        $.ajax({ async: true, type: 'post', url: 'bulto_controlador.php', data: {
            accion: 'get_grafo_bodega_ubicaciones'
        }, success: function (data) {   
            $('#grafo').html(data);
        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });
    }

    function get_lista_completa(year,month){
        $('#lista_completa').html(set_spinner);
        $.ajax({ async: true, type: 'post', url: 'bulto_controlador.php', data: {
            accion: 'get_kardex_procesos_general_vista'
        }, success: function (data) {
            $('#lista_completa').html(data);
            //estructura de la tabla
            $.ajax({ async: true, type: 'post', url: 'bulto_controlador.php', data: {
                accion: 'get_kardex_procesos_general_datos',
                year: year,
                month: month,
                fecha_seleccionada:fecha_seleccionada
            }, success: function (data) {
                 var datos = JSON.parse(data);
                var contarsigeneral=0;
                var contarnogeneral=0;
                var tablaOrigen= $('#tablaOrigen').DataTable({
                      data:datos,
                      select: 'single',
                    columns:[
                        { data: 'id_copia'},
                        { data: 'codigo_barra'},
                        { data: 'tipo_orden'},
                        { data: 'pedido'},
                        { data: 'paso',"bSortable": false,},
                        { data: 'bodega'},
                        { data: 'proceso_bodega',"bSortable": false,},
                        { data: 'estado',"bSortable": false,},
                        { data: 'actual',"bSortable": false,},
                        { data: 'activo'},
                        { data: 'accion_observacion',"bSortable": false,},
                        { data: 'fecha_solicitud'},
                        { data: 'nombre'},
                        { data: 'fecha_usuario',"bSortable": false,},
                        {
                            data: 'tiempo_transcurrido',
                            render: function (data, type , column) {
                                var conversion = DataTable.render
                                    if (type === 'display') {
                                        let color = 'green';
                                            
                                        if (data === '' ) {
                                            color = 'green';
                                            contarsigeneral++;
                                        }else {
                                            color = 'red';
                                            contarnogeneral++;
                                        }
                                        return `<span style="color:${color}">${data}</span>`;
                                    }
                                return conversion;
                            }
                        }, 
                    ],
                    order:[
                       [0, 'desc']
                    ],
                    dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',
                    
                    buttons: {
                        dom: {
                            container:{
                            tag:'div',
                            className:'flexcontent'
                            },
                            buttonLiner: {
                            tag: null
                            }
                        },
                        buttons:[                
                            {
                                extend:    'copyHtml5',
                                text:      '<i class="material-icons">content_copy</i><br>Copiar',
                                title:'Kardex - Inventario de Movimientos  ',
                                titleAttr: 'Copiar',
                                className: 'btn btn-app export barras',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                }
                            },
                            {
                                extend:    'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                text:      '<i class="material-icons">picture_as_pdf</i><br>PDF',
                                title:'Kardex - Inventario de Movimientos  ',
                                titleAttr: 'PDF',
                                className: 'btn btn-app export pdf',
                                exportOptions: {
                                    // columns: [ 0, 1,2,3,4,5,6 ]
                                    columnsDefs:[{
                                        className: "text-center", "targets": data
                                    }
                                    ],
                                columns: ':visible',
                                search: 'applied',
                                order: 'applied',
                                row: {
                                    selected: true
                                },
                                },//tr > td > colspan > 7  
                                customize:function(doc) {
                                    doc.styles.title = {
                                        color: '#ae8b68',
                                        fontSize: '20',
                                        alignment: 'center'
                                    },
                                    doc.styles['td:nth-child(2)'] = { 
                                        width: '100px',
                                        'max-width': '70px',
                                    },
                                    doc.styles.tableHeader = {
                                        fillColor:'#ae8b68', 
                                        color:'white',
                                        alignment:'center'
                                    },
                                    doc.content[1].margin = [ 1, 0, 2.5, 0 ],
                                    doc.defaultStyle.fontSize = 6,
                                    doc.defaultStyle.alignment='center'
                                }

                            },

                            {
                                extend:    'excelHtml5',
                                text:      '<i class="material-icons">content_copy</i><br>Excel',
                                title:'Kardex - Inventario de Movimientos Excel ',
                                titleAttr: 'Excel',
                                className: 'btn btn-app export excel',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                },
                            },
                            {
                                extend:    'csvHtml5',
                                text:      '<i class="material-icons">open_in_browser</i><br>CSV',
                                title:'Kardex - Inventario de Movimientos CSV',
                                titleAttr: 'CSV',
                                className: 'btn btn-app export csv',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                }
                            },
                            {
                                extend:    'print',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                autoPrint: false,
                                text:      '<i class="material-icons">local_printshop</i><br>Imprimir',
                                title:'Kardex - Inventario de Movimientos ',
                                titleAttr: 'Imprimir',
                                className: 'btn btn-app export imprimir',
                                exportOptions: {
                                    // columns: [ 0, 5 ]
                                }
                            },
                            {
                                extend:    'colvis',
                                text:      '<i class="material-icons">remove_red_eye</i><br>Visibilidad',
                                title:'Kardex - Inventario de Movimientos  ',
                                titleAttr: 'Copiar',
                                className: 'btn btn-app export barras',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                }
                            },
                            {
                                extend:    'pageLength',
                                titleAttr: 'Registros a mostrar',
                                className: 'selectTable',
                                exportOptions: {
                                    columns: [ 0, 1 ]
                                }
                            }
                        ]
                    }, 
                    columnDefs: [ {
                        // targets: [
                        //     -1
                        // ], 
                        // visible: false
                        targets: [1],
                        selectable: false,
                        copy: false

                    } ],
                    "language":idioma_espanol,
                    select: true, "responsive": true, "lengthChange": false, "autoWidth": true, "paging": true,"Sortable":false, 
                    "lengthMenu": [[10,40,70,100, -1],[10,40,70,100,"Mostrar Todo"]],
                });
    
            }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });

        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });
    }

    $(this).on('submit','#lista_general_bodega', function(e){e.preventDefault();
        fecha_seleccionada=$('#select_fecha').val();
        ascen = $('#asc').prop('checked');
        desc = $('#desc').prop('checked');
        barraDesc = $('#barraDesc').prop('checked'); 
        pedidoDesc = $('#pedidoDesc').prop('checked');
        fechaPedidoDesc = $('#fechaPedidoDesc').prop('checked');
        ascDesFinbarra= ''; ascDesFinpedido=''; ascDesFinfecha=''; ordMovi='';

                     if (fecha_seleccionada==='null'){
                            Swal.fire({
                                icon: "error",
                                title: "Error de consulta",
                                text: "Elegir una fecha por favor.",
                            });
                        }else{
                            [year, month] = fecha_seleccionada.split('-');
                            get_lista_bodega(year,month);
                            get_grafiti();
                            if (desc && barraDesc && pedidoDesc && fechaPedidoDesc){ //seleccion multiple DESCENDENTE
                                ascDesFinbarra = 'desc';
                                ascDesFinpedido = 'desc';
                                ascDesFinfecha = 'desc';
                            } else if (desc && barraDesc && pedidoDesc){ 
                                ascDesFinbarra = 'desc';
                                ascDesFinpedido = 'desc';
                            } else if (desc && barraDesc && fechaPedidoDesc){ 
                                ascDesFinbarra = 'desc';
                                ascDesFinfecha = 'desc';
                            } else if (desc && pedidoDesc && fechaPedidoDesc){ 
                                ascDesFinpedido = 'desc';
                                ascDesFinfecha = 'desc';
                            } else if (ascen && barraDesc && pedidoDesc && fechaPedidoDesc){ //seleccion multiple ASCENDENTE
                                ascDesFinbarra = 'asc';
                                ascDesFinpedido = 'asc';
                                ascDesFinfecha = 'asc';
                            } else if (ascen && barraDesc && pedidoDesc){ 
                                ascDesFinbarra = 'asc';
                                ascDesFinpedido = 'asc';
                            } else if (ascen && barraDesc && fechaPedidoDesc){ 
                                ascDesFinbarra = 'asc';
                                ascDesFinfecha = 'asc';
                            } else if (ascen && pedidoDesc && fechaPedidoDesc){ 
                                ascDesFinpedido = 'asc';
                                ascDesFinfecha = 'asc';
                            } else if (ascen && barraDesc) { //seleccion unitaria
                                ascDesFinbarra = 'asc'; 
                            } else if (desc && barraDesc) {
                                ascDesFinbarra = 'desc';
                            } else if (ascen && pedidoDesc) {
                                ascDesFinpedido = 'asc';
                            } else if (desc && pedidoDesc) {
                                ascDesFinpedido = 'desc';
                            } else if (ascen && fechaPedidoDesc) {
                                ascDesFinfecha = 'asc';
                            } else if (desc && fechaPedidoDesc) {
                                ascDesFinfecha = 'desc';
                            } else if (!desc && !ascen && !barraDesc  && !pedidoDesc  && !fechaPedidoDesc ) {
                                ordMovi = 'desc';
                            }
                        }
    });

    function get_grafiti(){
        $('#grafo').html(set_spinner);
        $.ajax({ async: true, type: 'post', url: 'bulto_controlador.php', data: {
            accion: 'get_grafo_bodega_ubicaciones'
        }, success: function (data) {   
            $('#grafo').html(data);
        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });
    }
   

    function get_lista_bodega(year,month){
        $('#lista_bodega').html(set_spinner);
        $.ajax({ async: true, type: 'post', url: 'bulto_controlador.php', data: {
            accion: 'get_kardex_procesos_bodega_vista'
        }, success: function (data) {
            $('#lista_bodega').html(data);
            //estructura de la tabla

            $.ajax({ async: true, type: 'post', url: 'bulto_controlador.php', data: {
                accion: 'get_kardex_procesos_bodega_datos',
                year: year,
                month: month,
                fecha_seleccionada:fecha_seleccionada
            }, success: function (data) {
                 var datos = JSON.parse(data);
                 var contarsi=0; 
                 var contarno=0;  
                 var fechaElemento = document.getElementById('fecha');
                 var monthNumber = parseInt(month, 10); 
                 monthNumber = monthNumber - 1;  
                 if (fecha_seleccionada === undefined) {
                 } else {
                     if (fechaElemento !== null) {
                         fechaElemento.value = fecha_seleccionada; //convierte y traspasa fecha
                         //grafica de pastel
                         google.charts.load('current', {'packages':['corechart', 'table']});
                         google.charts.setOnLoadCallback(graficaPastel);

                         function graficaPastel() {
                             var datos = google.visualization.arrayToDataTable([
                             ['Despachos a Tiempo', 'Despachos Fuera de Tiempo'],
                             ['Despachos a Tiempo', contarsif],
                             ['Despachos Fuera de Tiempo', contarnof]
                             ]);

                             var options = {
                             is3D: true,
                             legend: {
                                     position: 'right', 
                                     maxLines: 'top', 
                                     textStyle: {color: 'black', fontSize: 22}
                                     },
                             pieSliceText: 'value-and-percentage',
                             pieSliceTextStyle: {fontSize: 25},
                             slices: {
                                 0: {offset: 0.2},
                             }
                             };
                             
                             var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                             legend = document.getElementById('leyenda');
                             legend.innerHTML += '<div >' + datos.getColumnLabel(0) + ': ' + datos.getValue(0, 1) + ' (' + ((datos.getValue(0, 1) / (contarsif + contarnof)) * 100).toFixed(2) + '%)</div>';
                             legend.innerHTML += '<div >' + datos.getColumnLabel(1) + ': ' + datos.getValue(1, 1) + ' (' + ((datos.getValue(1, 1) / (contarsif + contarnof)) * 100).toFixed(2) + '%)</div>';
                             chart.draw(datos, options);
                             pdf=document.getElementById('variable').value=chart.getImageURI();
                             pdf2 = document.getElementById('fecha').value = fecha_seleccionada; //se manda dato de fecha_seleccionada en grafo
                             logo = document.getElementById('logoTipo').value; //trae el logotipo encabezado pdf
                             // Crear y dibujar la tabla
                            // var tablad = new google.visualization.Table(document.getElementById('dataTablaa'));
                            // tablad.draw(datos, {showRowNumber: true});
                            // tabladata=document.getElementById('dataTablaaa').value=Table.getImageURI();

                        }

                     } else {
                         console.error("El elemento con el id 'fecha', verificar codigo nuevamente Javascript-");
                     }
                 } 

                var tablaOrigen= $('#tablaBodega').DataTable({
                      data:datos,
                      select: 'single',
                    columns:[
                        { data: 'id_copia'},
                        { data: 'id_codigo_barra'},
                        { data: 'tipo_orden'},
                        { data: 'pedido'},
                        { data: 'paso',"bSortable": false,},
                        { data: 'bodega'},
                        { data: 'proceso_bodega',"bSortable": false,},
                        { data: 'estado'},
                        { data: 'actual',"bSortable": false,},
                        { 
                            data: 'activo',
                            render: function (data, type , row) {
                                
                                    if (type === 'display') {
                                        
                                        var color = data.toLowerCase() === 'activo' ? 'green' : 'red';

                                        return `<span style="color:${color}">${data}</span>`;
                                    }
                                return data;
                            }
                        },
                        { data: 'accion_observacion',"bSortable": false,},
                        { data: 'fecha_solicitud'},
                        { data: 'nombre'},
                        { data: 'fecha_usuario',"bSortable": false,},
                        {
                            data: 'tiempo_transcurrido',"bSortable": false,
                            render: function (data, type , column) {
                                var conversion = DataTable.render
                                    if (type === 'display') {
                                        
                                        if (data.endsWith('hora') || data.endsWith('horas')) {
                                            color = 'green';
                                            contarsi++;
                                        } else {
                                            color = 'red';
                                            contarno++;
                                        }

                                        return `<span style="color:${color}">${data}</span>`;
                                    }
                                return conversion;
                            }
                        } 
                    ],
                    order:[
                       [0, `${ordMovi}`],
                       [1, `${ascDesFinbarra}`],
                       [3, `${ascDesFinpedido}`],
                       [11, `${ascDesFinfecha}`]
                    ],
                    dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',
                    
                    buttons: {
                        dom: {
                            container:{
                            tag:'div',
                            className:'flexcontent'
                            },
                            buttonLiner: {
                            tag: null
                            }
                        },
                        buttons:[                
                            {
                                extend:    'copyHtml5',
                                text:      '<i class="material-icons">content_copy</i><br>Copiar',
                                title:'Kardex - Inventario de Movimientos de Bodega - Ubicaciones',
                                titleAttr: 'Copiar',
                                className: 'btn btn-app export barras',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                }
                            },
                            {
                                extend:    'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                text:      '<i class="material-icons">picture_as_pdf</i><br>PDF',
                                title:'Kardex - Inventario de Movimientos de Bodega - Ubicaciones',
                                titleAttr: 'PDF',
                                className: 'btn btn-app export pdf',
                                filename: `Kardex - Inventario de Movimientos de Bodega - Ubicaciones - ${meses[monthNumber]}' del '${year}`,
                                exportOptions: {
                                    columnsDefs:[{
                                        className: "text-center", "targets": data ,
                                    }
                                    ],
                                columns: ':visible',
                                search: 'applied',
                                order: 'applied',
                                row: {
                                    selected: true
                                },
                                },
                                customize:function(doc) { //personalizacion del PDF
                                             //lados,top,titulo,piepagina
                                    doc.pageMargins = [53,40,20,40];
                                    doc.styles.title = {
                                        color: '#0c2f78',
                                        fontSize: '20',
                                        alignment: 'center'
                                    },
                                    doc.styles['td:nth-child(2)'] = { 
                                        width: '100px',
                                        'max-width': '150px',
                                    },
                                    doc.styles.tableHeader = {
                                        fillColor:'#0c2f78', 
                                        color:'white',
                                        alignment:'center',
                                        text: 'Marca de agua',
                                    },
                                    doc.content[1].margin = [ 1, 0, 2.5, 0 ],
                                    doc.defaultStyle.fontSize = 6,
                                    doc.defaultStyle.alignment='center',
                                   
                                    doc.content.splice(2, 1, {
                                        image: pdf,
                                        width: 900, 
                                        alignment: 'center',
                                        margin: [-40,0],
                                    }),
                                    now = new Date();
                                    fecha = now.getDate()+'/'+meses[now.getMonth()]+'/'+now.getFullYear();
                                    doc['header']=(function() { //izquierda imprime logo y derecha imprime fecha seleccionada 
                                        return {
                                            columns: [
                                                {
                                                    image: logo,
                                                    width: 50
                                                },
                                                {
                                                    alignment: 'left',
                                                    italics: true,
                                                    text: '',
                                                    fontSize: 18,
                                                    margin: [10,0]
                                                },
                                                {
                                                    alignment: 'right',
                                                    fontSize: 8,
                                                    text: `Movimientos de ${meses[monthNumber]} / ${year}`,
                                                    color: '#0c2f78'
                                                }
                                            ],
                                            margin: 20
                                        }
                                    });
                                    doc['footer']=(function(pagina, paginas) {//izquierda imprime fecha creacion pdf y derecha paginacion
                                        return {
                                            columns: [
                                                {
                                                    alignment: 'left',
                                                    text: ['Creado el: ', { text: fecha.toString() }]
                                                },
                                                {
                                                    alignment: 'right',
                                                    text: ['Pagina ', { text: pagina.toString() },	' de ',	{ text: paginas.toString() }]
                                                }
                                            ],
                                            margin: 20
                                        }
                                    });
                                },
                                iniCompleto: function() { //permite seleccion personalizada de columnas a imprimir en PDF
                                    var tabla = this.api();
                                    var seleccion = tabla.rows({ seleccion: true }).count();
                                
                                    if (seleccion > 0) {
                                        var columnaSeleccionada = tabla.columns({ seleccion: true }).indexes();
                                        var exportOpciones = {
                                            columnas: columnaSeleccionada
                                        };
                                        var botonPDF = tablaOrigen.button('.export.pdf');
                                        botonPDF[0].inst.s.dt.button('.export.pdf').text('Exportar Selección');
                                        botonPDF[0].inst.s.dt.button('.export.pdf').conf.exportOpciones = exportOpciones;

                                        var botonDeColvis = tablaOrigen.button('.export.barras');
                                        botonDeColvis[0].inst.s.dt.button('.export.barras').conf.exportOpciones = {
                                            columnas: columnaSeleccionada
                                        };
                                    }
                                },
                                select: {
                                    style: 'multi'
                                }

                            },

                            {
                                extend:    'excelHtml5',
                                text:      '<i class="material-icons">content_copy</i><br>Excel',
                                title:'Kardex - Inventario de Movimientos Excel',
                                titleAttr: 'Excel',
                                className: 'btn btn-app export excel',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                },
                            },
                            {
                                extend:    'csvHtml5',
                                text:      '<i class="material-icons">open_in_browser</i><br>CSV',
                                title:'Kardex - Inventario de Movimientos CSV',
                                titleAttr: 'CSV',
                                className: 'btn btn-app export csv',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                }
                            },
                            {
                                extend:    'print',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                autoPrint: false,
                                text:      '<i class="material-icons">local_printshop</i><br>Imprimir',
                                title:'Kardex - Inventario de Movimientos ',
                                titleAttr: 'Imprimir',
                                className: 'btn btn-app export imprimir',
                                exportOptions: {
                                    // columns: [ 0, 5 ]
                                },
                            },
                            {
                                extend:    'colvis',
                                text:      '<i class="material-icons">remove_red_eye</i><br>Visibilidad',
                                title:'Kardex - Inventario de Movimientos  ',
                                titleAttr: 'Copiar',
                                className: 'btn btn-app export barras',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                }
                            },
                            {
                                extend:    'pageLength',
                                titleAttr: 'Registros a mostrar',
                                className: 'selectTable',
                                exportOptions: {
                                    columns: [ 0, 1 ]
                                }
                            }
                        ]
                    }, 
                    columnDefs: [ {
                        // targets: [
                        //     -1
                        // ], 
                        // visible: false
                        targets: [1],
                        selectable: false,
                        copy: false

                    } ],
                    "language":idioma_espanol,
                    select: true, "responsive": true, "lengthChange": false, "autoWidth": true, "paging": true,"Sortable":false, 
                    "lengthMenu": [[10,40,70,100, -1],[10,40,70,100,"Mostrar Todo"]],
                });
                //encapsular los datos para mostrar estadistica de pastel
                var contarsif=(contarsi/3);
                var contarnof=(contarno/3);
                // var tem = JSON.parse(data);
                // console.log(tem[0].fecha_solicitud);
            }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });
        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });
    }

    
});