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
        get_lista_alumnos();
    }

    get_contenido();

    function get_lista_alumnos(){
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
                        { data: 'id', visible: false},
                        { data: 'clave'},
                        { data: 'nombres'},
                        { data: 'apellidos'},
                        { data: 'grado'},
                        { data: 'seccion'},
                        { data: 'total_nota'},
                        { data: 'acciones',"bSortable": false,}
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
                                title:'Listado de Alumnos',
                                titleAttr: 'PDF',
                                className: 'btn btn-app export pdf',
                                filename: `Alumnos registrados - ${fecha.toString()}`,
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
                                title:'Alumnos registrados',
                                titleAttr: 'Excel',
                                className: 'btn btn-app export excel',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                },
                            },
                            {
                                extend:    'csvHtml5',
                                text:      '<i class="material-icons">open_in_browser</i><br>CSV',
                                title:'Alumnos registrados CSV',
                                titleAttr: 'CSV',
                                className: 'btn btn-app export csv',
                                exportOptions: {
                                    // columns: [ 0, 1 ]
                                }
                            },
                            {
                                extend:    'colvis',
                                text:      '<i class="material-icons">remove_red_eye</i><br>Visibilidad',
                                title:'Alumnos',
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
                                        "<button type='button' class='btn btn-secondary btn-sm btnEditar' data-toggle='modal' data-target='#modal-gestionar-alumno'> " +
                                        "<i class='material-icons'>edit</i></i>" +
                                        "</button>" + "&ensp; "+
                                        "<button type='button' class='btn btn-danger btn-sm btnEliminar'>" +
                                        "<i class='material-icons'>close</i></i>" +
                                        "</button>" + "&ensp; " +
                                        "<button type='button' class='btn btn-info btn-sm' id='ver_actividad'>" +
                                        "<i class='material-icons'>remove_red_eye</i></i>" +
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
                
            }, error: function (request, status, error) { console.log('error en peticion fffff'); } , timeout: 30*60*1000/*esperar 30min*/ });

        }, error: function (request, status, error) { console.log('error en peticion gggg'); } , timeout: 30*60*1000/*esperar 30min*/ });
    }

    $(this).on('click','.btnEditar', function(e){e.preventDefault();  //editar estudiantes
        var datos = tablaOrigen.row($(this).parents('tr')).data();
        console.log(datos);
        var id = datos["id"];
        var clave = datos["clave"];
        var nombres = datos["nombres"];
        var apellidos = datos["apellidos"];
        var grado = datos["grado"];
        var seccion = datos["seccion"];
        var total_nota = datos["total_nota"]; 

        $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
            accion: 'capturar_id_clase',
            id:id,
            seccion: seccion,
            grado: grado
        }, success: function (data) { 
            var datos;
                try {
                    datos = JSON.parse(data);
                   } catch (error) {
                   //console.error("Error al analizar JSON:", error);
                   }
            var clase = datos[0].id_clase;
            $("#txtid").val(id);
            $("#txtclave").val(clave);
            $("#txtnombres").val(nombres);
            $("#txtapellidos").val(apellidos);
            $("#txtclase").val(clase);
            $("#txttotal_nota").val(total_nota);
            
            $("#modal-gestionar-alumno").modal('show');
            $("#btnGuardarAlumno").click(function () {
                id = $('#txtid').val()
                nombres = $('#txtnombres').val(),
                apellidos = $('#txtapellidos').val(),
                correo = $('#txtcorreo').val(),
                puesto = $('#txtpuesto').val(),
                clave = $('#txtclave').val(),
                clase = $('#txtclase').val(),
                total_nota = $('#txttotal_nota').val()
                var datos = new FormData();
                datos.append('id', id);
                datos.append('nombres', nombres);
                datos.append('apellidos', apellidos);
                datos.append('correo', correo);
                datos.append('puesto', puesto);
                datos.append('clave', clave);
                datos.append('clase', clase); //id de clase
                datos.append('total_nota', total_nota);
                var formDataArray = [];
                for (var pair of datos.entries()) {
                    formDataArray.push(pair);
                }
                    if(nombres === null || nombres === undefined || nombres === '' || 
                    apellidos === null || apellidos === undefined || apellidos === '' 
                    ){
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Llenar todos los campos, por favor.."
                        });
                        
                    } else {
                        if (correo === undefined || correo === '' || total_nota === undefined || total_nota === ''){
                            correo === null; total_nota === null;
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
                            Swal.fire({
                                title: "Actualizacion efectuada",
                                text: "Se recargara la lista..",
                                icon: "success"
                            });
                                    $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                                        accion: 'editar_alumno',
                                        id:id,
                                        nombres: nombres,
                                        apellidos: apellidos,
                                        correo: correo,     
                                        puesto: puesto,
                                        clave: clave,
                                        clase: clase,
                                        total_nota: total_nota
                                    }, success: function (data) { 
                                        console.log(data);
                                        $("#modal-gestionar-alumno").modal('hide');
                                        setTimeout(function() {
                                            location.reload();
                                        }, 2000);
                                    }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close 2
                            }//confirmacion sweet-close
                        });//modal guardar sweet-close
                    } //fin else-close
            });//btnGuardar-close
        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close 1

    });

    $(this).on('click','.btnEliminar', function(e){e.preventDefault(); //eliminar estudiante
        var data = tablaOrigen.row($(this).parents('tr')).data();
        var id = data["id"];
        var datos = new FormData();
        datos.append('id', id);
        Swal.fire({
            title: "Deseas eliminar el alumno?",
            text: "Proceso no revertible..",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Se elimino alumno!",
                text: "Se recargara la lista..",
                icon: "success"
              });
                    $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                        accion: 'eliminar_alumno',
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

    $(this).on('click','#agregar_alumno', function(e){e.preventDefault(); //agregar estudiante
        //llamo el modal y despliego las variables para almacenar los datos
        var esnull;
        $('#txtnombres').val(''),
        $('#txtapellidos').val(''),
        $('#txtcorreo').val(''),
        $('#txtclave').val(''),
        $('#txtclase').val(''),
        
        $("#modal-gestionar-alumno").modal('show'); 
        //boton guardar, mando la inf al controlador y lueeeeego al modelo
        $("#btnGuardarAlumno").click(function () {
            var nombres = $('#txtnombres').val(),
                apellidos = $('#txtapellidos').val(),
                correo = $('#txtcorreo').val(),
                puesto = $('#txtpuesto').val(),
                clave = $('#txtclave').val(),
                clase = $('#txtclase').val(),
                id_usuario = $('#txtid_usuario').val();
            var datos = new FormData();
            datos.append('nombres', nombres);
            datos.append('apellidos', apellidos);
            datos.append('correo', correo);
            datos.append('puesto', puesto);
            datos.append('clave', clave);
            datos.append('clase', clase);
            datos.append('id_usuario', id_usuario);
            var formDataArray = [];
            for (var pair of datos.entries()) {
                formDataArray.push(pair);
            }
            console.log("Datos: ");
            formDataArray.forEach(pair => {
                console.log(pair[0] + ": " + pair[1]);
            });
                if(nombres === null || nombres === undefined || nombres === '' || 
                   apellidos === null || apellidos === undefined || apellidos === '' ||
                   clase === null || clase === undefined || clase === '' || clase === 'Asignar clase' || clase === 'null' ||
                   puesto === null || puesto === undefined || puesto === '' ||
                   clase === null || clase === undefined || clase === '' 
                ){
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Llenar todos los campos, por favor.."
                      });
                } else {
                    if (correo === undefined || correo === '' && clave === undefined || clave === ''){
                        correo === null;
                        clave === null;
                    }
                    console.log(clave);
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
                                clave: clave,
                                clase: clase,
                                id_usuario: id_usuario
                            },
                            success: function (data) {
                                console.log(data); 
                                $("#modal-gestionar-alumno").modal('hide');
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            },error: function (request, status, error) {console.log('error en petición');},timeout: 30 * 60 * 1000 /*esperar 30min*/});//ajax-close
                        }//confirmacion sweet-close
                      });//modal guardar sweet-close
                } //fin else-close



            
        });//btnGuardar-close

    });//formulario-close

    $(this).on('click','#agregar_clase', function(e){e.preventDefault(); //agregar una clase raiz
        //llamo el modal y despliego las variables para almacenar los datos
        $("#modal-gestionar-clase").modal('show'); 
        //boton guardar, mando la inf al controlador y lueego al modelo
        $("#btnGuardarClase").click(function () {
            var grado = $('#txtgrado').val().toLowerCase(), //captura siempre en minuscula
                seccion = $('#txtseccion').val().toUpperCase(),
                id_usuario = $('#txtid_usuario').val(); 
            var datos = new FormData();
            datos.append('grado', grado);
            datos.append('seccion', seccion);
            datos.append('id_usuario', id_usuario);
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
                                    seccion: seccion,
                                    id_usuario:id_usuario
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

    $(this).on('click', '#eliminar_clase', function(e) {
        e.preventDefault(); // Evita el comportamiento predeterminado del enlace
        // muestra el primer modal y oculta el segundo
        $("#modal-gestionar-clase").modal('hide');
        $("#modal-gestionar-clase_eliminar").modal('show');
    });

    // evento click para el botón de eliminar dentro del segundo modal
    $(this).on('click', '#btnclaseeliminar', function() {
        // obtiene el valor del campo de selección dentro del segundo modal
        var id = $('#txtclase2').val(); 
        $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                accion: 'consultar_clase2',
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
                        title: "Deseas eliminar la clase?",
                        text: "Proceso no revertible..",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, eliminar!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Se elimino la clase!",
                                text: "Se recargara la lista..",
                                icon: "success"
                            });
                            $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                                    accion: 'eliminar_clase',
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
                        text: "reasigne/elimine a los alumnos en esta clase para poder eliminarla",
                        icon: "error"
                      });
                }
        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close
    });
   
    $(this).on('click', '#studentsExcelBtn', function(){

        let excelData = {
            dataClassValidators: [],
        }

        let newData = [];

        $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
            accion: 'get_lista_clases_excel',
        }, success: function (data) { 
            //excelData.dataClassValidators.push({});
            const datosV = JSON.parse(data);
            datosV.forEach(function(element) {
                newData.push(element.clase)
            });

            excelData.dataClassValidators.push({column: "D", data: newData});
            window.generate_template(excelData);
            
        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-clos

    });

    $(this).on('click', '#studentsExcelUploadBtn', function(){
        $('#uploadFileInput').click();
    })

    $(this).on('change', '#uploadFileInput', async function(){
        if (this.files.length > 0) {
            const file = this.files[0];
            let studentList = await window.import_template(file);
            let isSuccess = true;
            let idUser = document.getElementById('txtid_usuario').value;

            $('#lista').html(set_spinner);
            studentList.forEach(function(element, index) {
                $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                    accion: 'guardar_alumno',
                    nombres: element.nombres,
                    apellidos: element.apellidos,
                    correo: element.correo,
                    puesto: element.puesto,
                    clave: element.clave,
                    clase: element.clase,
                    id_usuario: idUser
                },
                success: function (data) {
                    console.log(data); 
                    
                },error: function (request, status, error) {
                    console.log('error en petición');
                    isSuccess = false;
                },timeout: 30 * 60 * 1000 /*esperar 30min*/});//ajax-close
            });
            
            if(isSuccess){
                Swal.fire({
                    title: "Se creo la nueva clase",
                    text: "Se recargara la lista..",
                    icon: "success"
                });
                setTimeout(function () {
                        location.reload();
                }, 2000);
            }else{
                Swal.fire({
                    title: "Oops, Hubo un Problema!",
                    text: "Se recargara la lista..",
                    icon: "error"
                });
                setTimeout(function () {
                        location.reload();
                }, 2000);
            }
        }
    })
    
    $(this).on('click', '#ver_actividad', function(e) {
        var datos = tablaOrigen.row($(this).parents('tr')).data();
        console.log(datos);
        e.preventDefault(); // Evita el comportamiento predeterminado del enlace
        // muestra el primer modal y oculta el segundo
        var total_nota = datos["id"]; 
        $("#txt_idAlumnoFiltroActividades").val(total_nota);
        $("#modal-gestionar-alumno").modal('hide');
        $("#modal-gestionar-actividades").modal('show');
    });

    // evento click para el botón de eliminar dentro del segundo modal
    $(this).on('click', '#btnver_actividad', function() {
        $("#modal-gestionar-actividades").modal('hide');
        // obtiene el valor del campo de selección dentro del segundo modal
        var idEtapa = $('#txtetapa2').val(); 
        var idAlumno = $('#txt_idAlumnoFiltroActividades').val();
        $("#modal-gestionar-actividades_alumno").modal('show');
        $('#mostrar_data_actividades').html(set_spinner);
        console.log(idAlumno);
        $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                accion: 'consultar_actividad'
                }, success: function (data) { 
                    $('#mostrar_data_actividades').html(data);
                            $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                                accion: 'consultar_actividad'
                                }, success: function (data) { 
                                        $.ajax({ async: true, type: 'post', url: 'estudiantes_controlador.php', data: {
                                            accion: 'consultar_actividad_datos',
                                            idEtapa:idEtapa,
                                            idAlumno: idAlumno
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
                                                                        "</button>" +
                                                                "</center>";
                                                        },
                                                        selectable: false,
                                                        copy: false // Corrección del error tipográfico aquí
                                                    }],
                                                    "language":idioma_espanol,
                                                    select: true, "responsive": true, "lengthChange": false, "autoWidth": true, "paging": false,"Sortable":false,
                                                    footerCallback: function(row, data, start, end, display) {
                                                        var api = this.api();
                                        
                                                        // Calcula la suma de las notas del estudiante
                                                        var totalNotaEstudiante = api
                                                            .column(4)
                                                            .data()
                                                            .reduce(function(a, b) {
                                                                return a + parseFloat(b) || 0;
                                                            }, 0);
                                        
                                                        // Calcula la suma de las notas de la actividad
                                                        var totalNotaActividad = api
                                                            .column(5)
                                                            .data()
                                                            .reduce(function(a, b) {
                                                                return a + parseFloat(b) || 0;
                                                            }, 0);

                                                        var puntosReales = (20/totalNotaActividad) * totalNotaEstudiante;
                                        
                                                        // Actualiza el footer
                                                        $(api.column(3).footer()).html('Puntos Reales: ' + puntosReales.toFixed(0));
                                                        $(api.column(4).footer()).html('Total: ' + totalNotaEstudiante);
                                                        $(api.column(5).footer()).html('Total: ' + totalNotaActividad);
                                                    }
                                                });
                                        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close
                            }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close
        }, error: function (request, status, error) { console.log('error en peticion'); } , timeout: 30*60*1000/*esperar 30min*/ });//ajax-close
    });

    $(this).on('click', '#closeM', function() {
        setTimeout(function() {
            location.reload();
        }, 200);
    });
});