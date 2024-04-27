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
        get_lista_usuarios();
    }

    get_contenido();

    function get_lista_usuarios(){
        $('#lista').html(set_spinner);
        $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
            accion: 'get_lista_vista'
        }, success: function (data) {
            $('#lista').html(data);
            //estructura de la datatable
            $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                accion: 'get_lista_datos'
            }, success: function (data) {
                var datos;
                try {
                    datos = JSON.parse(data);
                   } catch (error) {
                   //console.error("Error al analizar JSON:", error);
                   }
                now = new Date();
                fecha = now.getDate()+' / '+meses[now.getMonth()]+' / '+now.getFullYear();
                var contarsigeneral=0;
                var contarnogeneral=0;
                tablaOrigen = $('#tablaOrigen').DataTable({
                      data:datos,
                      select: 'single',
                    columns:[
                        { data: 'id'},
                        { data: 'usuario'},
                        { data: 'rol'},
                        { data: 'nombres'},
                        { data: 'apellidos'},
                        { data: 'correo',"bSortable": false,},
                        { data: 'descripcion'},
                        { data: 'acciones'}
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
                                title:'Usuarios registrados',
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
                                title:'Usuarios registrados',
                                titleAttr: 'PDF',
                                className: 'btn btn-app export pdf',
                                filename: `Usuarios registrados - ${fecha.toString()}`,
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
                                title:'Usuarios registrados',
                                titleAttr: 'Excel',
                                className: 'btn btn-app export excel',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                },
                            },
                            {
                                extend:    'csvHtml5',
                                text:      '<i class="material-icons">open_in_browser</i><br>CSV',
                                title:'Usuarios registrados CSV',
                                titleAttr: 'CSV',
                                className: 'btn btn-app export csv',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
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
                    columnDefs: [{
                        targets: 7,
                        sortable: false,
                        render: function(data, type, full, meta) {
                            return "<center>" +
                                        "<button type='button' class='btn btn-secondary btn-sm btnEditar' data-toggle='modal' data-target='#modal-actualizar-categoria'> " +
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

        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });
    }

    $(this).on('click','.btnEditar', function(e){e.preventDefault();  //editar
        var datos = tablaOrigen.row($(this).parents('tr')).data();
        console.log(datos);
        var id = datos["id"];
        var usuario = datos["usuario"];
        var rol = datos["rol"];
        var nombres = datos["nombres"];
        var apellidos = datos["apellidos"];
        var correo = datos["correo"];
        var descripcion = datos["descripcion"]; //puesto
        if(rol === "Admin"){
            rol = 1
        } else if ( rol === "Profesor"){
            rol = 2
        } else if ( rol === "Consultor"){
            rol = 3
        }
        if (descripcion === "Gestor del Sistema"){
            descripcion = 1
        } else if (descripcion === "Director"){
            descripcion = 2
        } else if (descripcion === "Subdirector"){
            descripcion = 3
        } else if (descripcion === "Profesor"){
            descripcion = 4
        } else if (descripcion === "Presidente de clase"){
            descripcion = 5
        } else if (descripcion === "Alumno"){
            descripcion = 6
        } else if (descripcion === "Padres"){
            descripcion = 7
        }
        $("#txtid").val(id);
        $("#txtusuario").val(usuario);
        $("#txtrol").val(rol);
        $("#txtnombres").val(nombres);
        $("#txtapellidos").val(apellidos);
        $("#txtcorreo").val(correo);
        $("#txtpuesto").val(descripcion);
        $("#modal-gestionar-usuario").modal('show');
        $("#btnGuardar").click(function () {
            id = $('#txtid').val()
            nombres = $('#txtnombres').val(),
            apellidos = $('#txtapellidos').val(),
            correo = $('#txtcorreo').val(),
            descripcion = $('#txtpuesto').val(), //puesto
            usuario = $('#txtusuario').val(),
            rol = $('#txtrol').val(),
            contrasenia = $('#txtcontrasenia').val() //captura nueva contrasenia
            var datos = new FormData();
            datos.append('id', id);
            datos.append('nombres', nombres);
            datos.append('apellidos', apellidos);
            datos.append('correo', correo);
            datos.append('puesto', descripcion);
            datos.append('usuario', usuario);
            datos.append('rol', rol);
            datos.append('contrasenia', contrasenia)
            var formDataArray = [];
            for (var pair of datos.entries()) {
                formDataArray.push(pair);
            }
                if(nombres === null || nombres === undefined || nombres === '' || 
                   apellidos === null || apellidos === undefined || apellidos === '' ||
                   correo === null || correo === undefined || correo === '' || 
                   usuario === null || usuario === undefined || usuario === '' || 
                   contrasenia === null || contrasenia === undefined || contrasenia === '' 
                ){
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Llenar todos los campos, por favor.."
                      });
                      
                } else {
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
                          Swal.fire({
                            title: "Actualizacion efectuada",
                            text: "Se recargara la lista..",
                            icon: "success"
                          });
                                $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                                    accion: 'editar_usuario',
                                    id:id,
                                    nombres: nombres,
                                    apellidos: apellidos,
                                    correo: correo,     
                                    puesto: descripcion,
                                    usuario: usuario,
                                    rol: rol,
                                    contrasenia: contrasenia
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


    });

    $(this).on('click','.btnEliminar', function(e){e.preventDefault(); //eliminar
        var data = tablaOrigen.row($(this).parents('tr')).data();
        var id = data["id"];
        var datos = new FormData();
        datos.append('id', id);
        Swal.fire({
            title: "Deseas eliminar el usuario?",
            text: "Proceso no revertible..",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Se elimino usuario!",
                text: "Se recargara la lista..",
                icon: "success"
              });
                    $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                        accion: 'eliminar_usuario',
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

    $(this).on('click','#agregar_alumno', function(e){e.preventDefault();
        //llamo el modal y despliego las variables para almacenar los datos
        $("#modal-gestionar-alumno").modal('show'); 
        var accion_data = "";
        //boton guardar, mando la inf al controlador y lueego al modelo
        $("#btnGuardarAlumno").click(function () {
            var nombres = $('#txtnombres').val(),
                apellidos = $('#txtapellidos').val(),
                correo = $('#txtcorreo').val(),
                puesto = $('#txtpuesto').val(),
                usuario = $('#txtusuario').val(),
                rol = $('#txtrol').val(),
                contrasenia = $('#txtcontrasenia').val()
            var datos = new FormData();
            datos.append('nombres', nombres);
            datos.append('apellidos', apellidos);
            datos.append('correo', correo);
            datos.append('puesto', puesto);
            datos.append('usuario', usuario);
            datos.append('rol', rol);
            datos.append('contrasenia', contrasenia)
            var formDataArray = [];
            for (var pair of datos.entries()) {
                formDataArray.push(pair);
            }
            console.log("Datos del FormData:");
            formDataArray.forEach(pair => {
                console.log(pair[0] + ": " + pair[1]);
            });
                if(nombres === null || nombres === undefined || nombres === '' || 
                   apellidos === null || apellidos === undefined || apellidos === '' ||
                   correo === null || correo === undefined || correo === '' || 
                   usuario === null || usuario === undefined || usuario === '' || 
                   contrasenia === null || contrasenia === undefined || contrasenia === '' 
                ){
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Llenar todos los campos, por favor.."
                      });
                } else {
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
                                $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                                    accion: 'guardar_alumno',
                                    nombres: nombres,
                                    apellidos: apellidos,
                                    correo: correo,     
                                    puesto: puesto,
                                    usuario: usuario,
                                    rol: rol,
                                    contrasenia: contrasenia
                                }, success: function (data) { 
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

    $(this).on('click','#agregar_clase', function(e){e.preventDefault();
        //llamo el modal y despliego las variables para almacenar los datos
        $("#modal-gestionar-clase").modal('show'); 
        //boton guardar, mando la inf al controlador y lueego al modelo
        $("#btnGuardarClase").click(function () {
            var grado = $('#txtgrado').val(),
                seccion = $('#txtseccion').val()
            var datos = new FormData();
            datos.append('grado', grado);
            datos.append('seccion', seccion);
            var formDataArray = [];
            for (var pair of datos.entries()) {
                formDataArray.push(pair);
            }
            console.log("Datos del FormData:");
            formDataArray.forEach(pair => {
                console.log(pair[0] + ": " + pair[1]);
            });
                if(grado === null || grado === undefined || grado === '' || 
                   seccion === null || seccion === undefined || seccion === ''
                ){
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Llenar todos los campos, por favor.."
                      });
                } else {
                    Swal.fire({
                        title: "Estas seguro?",
                        text: "Se creara una nueva clase",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si!"
                      }).then((result) => {
                        if (result.isConfirmed) {
                          Swal.fire({
                            title: "Se creo la nueva clase",
                            text: "Se recargara la lista..",
                            icon: "success"
                          });
                                $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                                    accion: 'guardar_clase',
                                    grado: grado,
                                    seccion: seccion
                                }, success: function (data) { 
                                    $("#modal-gestionar-clase").modal('hide');
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close
                        }//confirmacion sweet-close
                      });//modal guardar sweet-close
                } //fin else-close



            
        });//btnGuardar-close

    });//formulario-close

    function get_example(){
        $('#grafo').html(set_spinner);
        $.ajax({ async: true, type: 'post', url: 'bulto_controlador.php', data: {
            accion: 'get_grafo_bodega_ubicaciones'
        }, success: function (data) {   
            $('#grafo').html(data);
        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });
    }
   
    
});