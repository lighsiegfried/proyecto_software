$(document).ready(function (){

    //variables GLOBALES
    var set_spinner = `<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" role="status"> <span class="sr-only"></span> </div> </div>`,
        meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'], //para pdf
        tablaOrigen;

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
        get_lista_Actividades();
    }

    get_contenido();

    function get_lista_Actividades(){
        $('#lista').html(set_spinner);
        $.ajax({ async: true, type: 'post', url: 'actividades_controlador.php', data: {
            accion: 'get_lista_vista',
        }, success: function (data) {
            $('#lista').html(data);
            //estructura de la datatable
            getDataTableData(null);

        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });
    }

    function getDataTableData(idEtapa){
        $.ajax({ async: true, type: 'post', url: 'actividades_controlador.php', data: {
            accion: 'get_lista_datos',
            idEtapa: (idEtapa)? idEtapa : null,
        }, success: function (data) {
            var datos;
            try {
                datos = JSON.parse(data);
               } catch (error) {
               //console.error("Error al analizar JSON:", error);
               }
               console.log(datos),
            now = new Date();
            fecha = now.getDate()+' / '+meses[now.getMonth()]+' / '+now.getFullYear();
            var contarsigeneral=0;
            var contarnogeneral=0;
            tablaOrigen = $('#tablaOrigen').DataTable({
                  data:datos,
                  select: 'single',
                columns:[
                    { data: 'indice'},
                    { data: 'nombres'},
                    { data: 'apellidos'},
                    { data: 'nombreActividad'},
                    { data: 'notaEstudiante'},
                    { data: 'notaActividad'},
                    { data: 'opciones',"bSortable": false,},
                    {data: 'idActividad2', visible: false}
                ],
                order:[
                   [0, 'asc']
                ],
                dom: "<'row'<'col-md-6'B><'col-md-6'f>>" +
                     "<'row'<'col-md-12'tr>>" +
                     "<'row'<'col-md-6'i><'col-md-6'p>>",
                
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
                            title:'Actividades registrados',
                            titleAttr: 'Copiar',
                            className: 'btn btn-app export barras',
                            exportOptions: {
                                // columns: [ 0, 1 ]
                            }
                        },
                        {
                            extend:    'pdfHtml5',
                            orientation: 'letter',
                            pageSize: 'LEGAL',
                            text:      '<i class="material-icons">picture_as_pdf</i><br>PDF',
                            title:'Listado de Actividades',
                            titleAttr: 'PDF',
                            className: 'btn btn-app export pdf',
                            filename: `Actividades registrados - ${fecha.toString()}`,
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
                                    color: '#223673',
                                    fontSize: '20',
                                    alignment: 'center'
                                },
                                doc.styles['td:nth-child(2)'] = { 
                                    width: '100px',
                                    'max-width': '70px',
                                },
                                doc.styles.tableHeader = {
                                    fillColor:'#3068bf', 
                                    color:'white',
                                    alignment:'center'
                                },
                                doc.content[1].margin = [ 1, 0, 2.5, 0 ],
                                doc.defaultStyle.fontSize = 6,
                                doc.defaultStyle.alignment='center'
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
                            title:'Actividades registrados',
                            titleAttr: 'Excel',
                            className: 'btn btn-app export excel',
                            exportOptions: {
                                // columns: [ 0, 1 ]
                            },
                        },
                        {
                            extend:    'csvHtml5',
                            text:      '<i class="material-icons">open_in_browser</i><br>CSV',
                            title:'Actividades registrados CSV',
                            titleAttr: 'CSV',
                            className: 'btn btn-app export csv',
                            exportOptions: {
                                // columns: [ 0, 1 ]
                            }
                        },
                        {
                            extend:    'colvis',
                            text:      '<i class="material-icons">remove_red_eye</i><br>Visibilidad',
                            title:'Actividades',
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
                columnDefs: [{
                    targets: 6,
                    sortable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                                    "<button type='button' class='btn btn-secondary btn-sm btnEditar' data-toggle='modal' data-target='#modal-gestionar-alumno'> " +
                                    "<i class='material-icons'>edit</i></i>" +
                                    "</button>" + "&ensp; "+
                                    "<button type='button' class='btn btn-danger btn-sm btnEliminar'>" +
                                    "<i class='material-icons'>close</i></i>" +
                                    "</button>" +
                               "</center>";
                    },
                    selectable: false,
                    copy: false // Corrección del error tipográfico aquí
                }],
                "language":idioma_espanol,
                select: true, "responsive": true, "lengthChange": false, "autoWidth": true, "paging": true,"Sortable":false, 
                "lengthMenu": [[5,10,40,70,100, -1],[5,10,40,70,100,"Mostrar Todo"]],
            });
            
        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });
    }

    $(this).on('click','.btnEditar', function(e){e.preventDefault();  //editar actividades
        var datos = tablaOrigen.row($(this).parents('tr')).data();
        console.log(datos);
        
        var idActividad2 = datos["idActividad2"];
        var notaTotal = datos["notaActividad"];
        var notaEstudiante = datos["notaEstudiante"];
        
        $("#txt_idActividad2").val(idActividad2);
        $("#txt_notaTotal").val(notaTotal);
        $("#txtpunteo").val(notaEstudiante);

        
        $("#modal-gestionar-actividad").modal('show');
        $("#btnGuardaractividad").click(function () {
            idActividad2 = $('#txt_idActividad2').val(),
            notaActividad = $('#txt_notaTotal').val(),
            notaAsignada = $('#txtpunteo').val(),
            console.log(idActividad2,notaActividad,notaAsignada);
            var datos = new FormData();
            datos.append('idActividad2', idActividad2);
            datos.append('notaActividad', notaActividad);
            datos.append('notaAsignada', notaAsignada);
            var formDataArray = [];
            for (var pair of datos.entries()) {
                formDataArray.push(pair);
            } 
                if((Number(notaActividad) < Number(notaAsignada))){
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Nota Asignada mayor a la nota de la actividad"
                      });
                      
                } else {
                    if (notaAsignada === undefined || notaAsignada === ''){
                        notaAsignada === 0;
                    }
                    Swal.fire({
                        title: "Estas seguro?",
                        text: "Los datos se actualizarán",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si!"
                      }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({ async: true, type: 'post', url: 'actividades_controlador.php', data: {
                                accion: 'editar_actividad',
                                idActividad2 :idActividad2,
                                notaAsignada: notaAsignada,
                            }, success: function (data) { 
                                console.log(data);
                                $("#modal-gestionar-actividad").modal('hide');
                                Swal.fire({
                                    title: "Actualizacion efectuada",
                                    text: "Se recargara la lista..",
                                    icon: "success"
                                });
                                var idEtapaSelect = $('#txtEtapaSelect').val();
                                changeDataTable(idEtapaSelect);
                            }, error: function (request, status, error) { 
                                console.log('error en peticion'); 
                                Swal.fire({
                                    title: "Oops Algo salio mal",
                                    text: "Porfavor intente de nuevo mas tarde",
                                    icon: "error"
                                });
                            } , timeout: 30*60*1000/*esperar 30min*/ 
                            });//ajax-close
                                
                        }//confirmacion sweet-close
                      });//modal guardar sweet-close
                } //fin else-close
        });//btnGuardar-close

    });

    $(this).on('click','.btnEliminar', function(e){e.preventDefault(); //eliminar etapa
        var data = tablaOrigen.row($(this).parents('tr')).data();
        var id = data["id"];
        var datos = new FormData();
        datos.append('id', id);
        Swal.fire({
            title: "Deseas eliminar la actividad?",
            text: "Proceso no revertible..",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Se elimino actividad!",
                text: "Se recargara la lista..",
                icon: "success"
              });
                    $.ajax({ async: true, type: 'post', url: 'actividades_controlador.php', data: {
                        accion: 'eliminar_actividad',
                        id:id
                    }, success: function (data) { 
                        //tablaOrigen.ajax.reload(null, false); no funciona esta accion. evita recargar la pagina entera, sin embargo no es funcional.
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close
            }//confirmacion sweet-close
          });//modal guardar sweet-close
    });//eliminar-close

    $(this).on('click', '#eliminar_etapa', function(e) {
        e.preventDefault(); // Evita el comportamiento predeterminado del enlace
        // muestra el primer modal y oculta el segundo
        $("#modal-gestionar-etapa").modal('hide');
        $("#modal-gestionar-etapa_eliminar").modal('show');
    });

    // evento click para el botón de eliminar dentro del segundo modal
    $(this).on('click', '#btnetapaeliminar', function() {
        // obtiene el valor del campo de selección dentro del segundo modal
        var id = $('#txtetapa2').val();
        $.ajax({ async: true, type: 'post', url: 'actividades_controlador.php', data: {
            accion: 'consulta_etapa',
            id:id,
            }, success: function (data) { 
                var datos;
                try {
                    datos = JSON.parse(data);
                   } catch (error) {
                   //console.error("Error al analizar JSON:", error);
                   }
            if (datos === null){
            Swal.fire({
                title: "Deseas eliminar la etapa?",
                text: "Proceso no revertible..",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Se elimino la etapa!",
                        text: "Se recargara la lista..",
                        icon: "success"
                    });
                    $.ajax({ async: true, type: 'post', url: 'actividades_controlador.php', data: {
                            accion: 'eliminar_etapa',
                            id:id
                            }, success: function (data) { 
                            //tablaOrigen.ajax.reload(null, false); no funciona esta accion. evita recargar la pagina entera, sin embargo no es funcional.
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close
                }
            });
        } else { 
            Swal.fire({
                title: "No es posible eliminar",
                text: "reasigne/elimine las actividades en la etapa, para poder eliminarla",
                icon: "error"
              });
        }
        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close
    });

    $(this).on('click','#agregar_actividad', function(e){e.preventDefault(); //agregar actividad
        //llamo el modal y despliego las variables para almacenar los datos
        $('#txtnombre_actividad').val(''),
        $('#txtdescripcion').val(''),
        $('#txtpunteo').val(''),
        $('#txtetapa').val('');

        $("#modal-gestionar-actividad").modal('show'); 
        //boton guardar, mando la inf al controlador y lueeeeego al modelo
        $("#btnGuardaractividad").click(function () {
            var nombre_actividad = $('#txtnombre_actividad').val().toLowerCase(),
                descripcion = $('#txtdescripcion').val(),
                punteo = $('#txtpunteo').val(),
                etapa = $('#txtetapa').val(),
                id_usuario = $('#txtid_usuario').val();
            var datos = new FormData();
            datos.append('nombre_actividad', nombre_actividad);
            datos.append('descripcion', descripcion);
            datos.append('punteo', punteo);
            datos.append('etapa', etapa);
            datos.append('id_usuario', id_usuario)
            var formDataArray = [];
            for (var pair of datos.entries()) {
                formDataArray.push(pair);
            }
            formDataArray.forEach(pair => {
                console.log(pair[0] + ": " + pair[1]);
            });
                if(nombre_actividad === null || nombre_actividad === undefined || nombre_actividad === '' || 
                   punteo === null || punteo === undefined || punteo === '' ||
                   etapa === null || etapa === undefined || etapa === '' || etapa === 'Asignar etapa' || etapa === 'null'
                ){
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Llenar todos los campos, por favor.."
                      });
                } else {
                    if (descripcion === undefined || descripcion === ''){
                        descripcion === null;
                    }
                    Swal.fire({
                        title: "Estas seguro?",
                        text: "Se creara un nuevo usuario",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si!"
                      }).then((result) => {
                        if (result.isConfirmed) {
                          Swal.fire({
                            title: "Se creo un nuevo usuario",
                            text: "Se recargara la lista..",
                            icon: "success"
                          });
                                $.ajax({ async: true, type: 'post', url: 'actividades_controlador.php', data: {
                                    accion: 'guardar_actividad',
                                    nombre_actividad: nombre_actividad,
                                    descripcion: descripcion,
                                    punteo: punteo,     
                                    etapa: etapa,
                                    id_usuario: id_usuario
                                }, success: function (data) { 
                                    console.log(data); 
                                    $("#modal-gestionar-usuario").modal('hide');
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close
                        }//confirmacion sweet-close
                      });//modal guardar sweet-close
                } //fin else-close



            
        });//btnGuardar-close

    });//formulario-close

    $(this).on('click','#agregar_etapa', function(e){e.preventDefault(); //agregar una etapa raiz
        //llamo el modal y despliego las variables para almacenar los datos
        $("#modal-gestionar-etapa").modal('show'); 
        //boton guardar, mando la inf al controlador y lueego al modelo
        $("#btnGuardaretapa").click(function () {
            var nombre_etapa = $('#txtnombre_etapa').val().toLowerCase() //captura siempre en minuscula
            id_usuario = $('#txtid_usuario').val();
            var datos = new FormData();
            datos.append('nombre_etapa', nombre_etapa);
            datos.append('id_usuario', id_usuario);
            var formDataArray = [];
            for (var pair of datos.entries()) {
                formDataArray.push(pair);
            }
            formDataArray.forEach(pair => {
                console.log(pair[0] + ": " + pair[1]);
            });
                if(nombre_etapa === null || nombre_etapa === undefined || nombre_etapa === ''
                ){
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Llenar todos los campos, por favor.."
                      });
                } else {
                    Swal.fire({
                        title: "Estas seguro?",
                        text: "Se creara una nueva etapa",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si!"
                      }).then((result) => {
                        if (result.isConfirmed) {
                          Swal.fire({
                            title: "Se creo la nueva etapa",
                            text: "Se recargara la lista..",
                            icon: "success"
                          });
                                $.ajax({ async: true, type: 'post', url: 'actividades_controlador.php', data: {
                                    accion: 'guardar_etapa',
                                    nombre_etapa: nombre_etapa,
                                    id_usuario: id_usuario
                                }, success: function (data) { 
                                    console.log(data);
                                    $("#modal-gestionar-etapa").modal('hide');
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close
                        }//confirmacion sweet-close
                      });//modal guardar sweet-close
                } //fin else-close



            
        });//btnGuardar-close

    });//formulario-close

    $(this).on('change', '#txtEtapaSelect', function(){
        id_etapa = $('#txtEtapaSelect').val();
        console.log(id_etapa);
        changeDataTable(id_etapa);
    });

    function changeDataTable(idEtapa){
        tablaOrigen.destroy();
        getDataTableData(idEtapa);
    }
    
});