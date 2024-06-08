<?php

class estudiantes_vista
{
    //funciones de vista
    function get_lista_vista($lista,$lista_class)
    {   $id_usuario = $_SESSION['id'];
        ?>
        <style>
            input[type="text"],
            select {
                text-transform: none !important;
            }

            .no-uppercase {
                text-transform: none !important;
            }
        </style>
        <div class="row justify-content-center ">
            <form id="lista_general_from11" method="post" class="mt-4">
                <div class="col-md-8" style="width: 100%; display: flex; justify-content: center;">
                    <div class="btn-agregar-alumno">
                        <button id="agregar_alumno" type="button" class="btn btn-light btn-sm mb-4"  style="display: flex; justify-content: center; align-items: center;" data-toggle="modal"
                            data-target="#modal-gestionar-alumno" data-dismiss="modal">
                            <i class="material-icons">group_add</i>
                            Agregar estudiante
                        </button>
                    </div>
                    &nbsp;&nbsp;
                    <div class="btn-agregar-clase btnAgregarclase">
                        <button id="agregar_clase" type="button" class="btn btn-light btn-sm mb-4" style="display: flex; justify-content: center; align-items: center;" data-toggle="modal"
                            data-target="#modal-gestionar-clase" data-dismiss="modal">
                            <i class="material-icons">group_add</i>
                            Agregar clase
                        </button>
                    </div>
                </div>

                <div class="modal fade" id="modal-gestionar-alumno">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <!-- modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar estudiante</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id=></button>
                            </div>
                            <!-- modal body -->
                            <div class="modal-body">
                                <!-- çategoria ruta y estado -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtnombres">Nombres</label>
                                            <input type="text" class="form-control no-uppercase" name="nombres" id="txtnombres"
                                                placeholder="Ingrese Nombres" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtapellidos">Apellidos</label>
                                            <input type="text" class="form-control no-uppercase" name="apellidos"
                                                id="txtapellidos" placeholder="Ingrese Apellidos" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtcorreo">Correo(opcional)</label>
                                            <input type="text" class="form-control no-uppercase" name="correo" id="txtcorreo"
                                                placeholder="Ingrese Correo" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtpuesto">Puesto</label>
                                            <select name="puesto" class="form-control" id="txtpuesto">
                                                <option value="6">Alumno</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtclave">Clave alumno</label>
                                            <input type="text" class="form-control no-uppercase" name="clave" id="txtclave"
                                                placeholder="Clave auto asignada" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtclase">Clase</label>
                                            <select name="clase" class="form-control" id="txtclase" required>
                                                <option value="<?php if (!isset($_POST['id']))
                                                    echo 'null'; ?>" <?php if (!isset($_POST['id']))
                                                          echo 'selected'; ?>>Asignar clase</option>
                                                <?php
                                                foreach ($lista_class as $valor) {
                                                    ?>
                                                    <option value="<?php echo $valor['id']; ?>" <?php if (isset($_POST['id']) and $valor['id'] == $_POST['id'])
                                                           echo "selected"; ?>>
                                                        <?php echo $valor['grado'] . ' - ' . $valor['seccion']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txttotal_nota">Nota Total (opcional)</label>
                                            <input type="text" class="form-control no-uppercase" name="total_nota" id="txttotal_nota"
                                                placeholder="Asignar nueva nota" autocomplete="off">
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" id="txtid">
                                    <input type="hidden" name="id_usuario" id="txtid_usuario" value="<?php echo $id_usuario ?>">
                                </div>
                            </div>

                            <!-- modal footer  -->
                            <div class="modal-footer justify-content-end">
                                <!-- <button id="ver_actividad" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-dialog modal-sm modal-dialog-centered" data-dismiss="modal">Ver Actividades</button> -->
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" id="btnGuardarAlumno" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------------------------------------------------------------------------------- -->
                <div class="modal fade" id="modal-gestionar-clase">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <!-- modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar nueva clase</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id=></button>
                            </div>
                            <!-- modal body -->
                            <div class="modal-body">
                                <!-- çategoria ruta y estado -->
                                <div class="row">
                                    
                                        <div class="form-group">
                                            <label for="txtgrado">Grado</label>
                                            <input type="text" class="form-control no-uppercase" name="grado" id="txtgrado"
                                                placeholder="Ingrese Grado" autocomplete="off" required>
                                        </div>
                                    
                                    
                                        <div class="form-group mt-2">
                                            <label for="txtaseccion">Seccion</label>
                                            <input type="text" class="form-control no-uppercase" name="seccion" id="txtseccion"
                                                placeholder="Ingrese Seccion" autocomplete="off" required>
                                        </div>
                                    <input type="hidden" name="id_usuario" id="txtid_usuario" value="<?php echo $id_usuario ?>">
                                </div>
                            </div>
                            <!-- modal footer  -->
                            <div class="modal-footer justify-content-end">
                                <div class="row">
                                    <button id="eliminar_clase" type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#modal-dialog modal-sm modal-dialog-centered" data-dismiss="modal">Eliminar clase y seccion</button>
                                    <button type="button" class="btn btn-dark mt-2" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" id="btnGuardarClase" class="btn btn-primary mt-2">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------------------------------------------------------------------------------- -->
                <div class="modal fade" id="modal-gestionar-clase_eliminar">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <!-- modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Eliminar clase</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id=></button>
                            </div>
                            <!-- modal body -->
                            <div class="modal-body">
                                <!-- çategoria ruta y estado -->
                                <div class="row">
                                        <div class="form-group">
                                            <label for="txtclase2">Clase</label>
                                            <select name="clase2" class="form-control" id="txtclase2" required>
                                                <option value="<?php if (!isset($_POST['id']))
                                                    echo 'null'; ?>" <?php if (!isset($_POST['id']))
                                                          echo 'selected'; ?>>Seleccionar clase a eliminar</option>
                                                <?php
                                                foreach ($lista_class as $valor2) {
                                                    ?>
                                                    <option value="<?php echo $valor2['id']; ?>" <?php if (isset($_POST['id']) and $valor2['id'] == $_POST['id'])
                                                           echo "selected"; ?>>
                                                        <?php echo $valor2['grado'] . ' - ' . $valor2['seccion']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                </div>
                            </div>
                            <!-- modal footer  -->
                            <div class="modal-footer d-flex justify-content-center">
                                <div class="">
                                    <button type="button" class="btn btn-dark mt-2" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" id="btnclaseeliminar" class="btn btn-danger mt-2">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------------------------------------------------------------------------------- -->
                <div class="modal fade" id="modal-gestionar-actividades">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Seleccion Etapa para ver actividades de alumno:  </h4>
                                <input type="hidden" id="txt_idAlumnoFiltroActividades">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id=></button>
                            </div>
                            <!-- modal body -->
                            <div class="modal-body">
                                <!-- çategoria ruta y estado -->
                                
                                        <div class="form-group">
                                            <label for="txtetapa">Etapa</label>
                                            <select name="etapa2" class="form-control" id="txtetapa2" required>
                                                <option value="<?php if (!isset($_POST['id']))
                                                    echo 'null'; ?>" <?php if (!isset($_POST['id']))
                                                          echo 'selected'; ?>>Seleccione etapa</option>
                                                <?php
                                                foreach ($lista as $valor) {
                                                    ?>
                                                    <option value="<?php echo $valor['id']; ?>" <?php if (isset($_POST['id']) and $valor['id'] == $_POST['id'])
                                                           echo "selected"; ?>>
                                                        <?php echo $valor['nombre_etapa']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                                    <option value="9999999999">Mostrar todas las Etapas</option>
                                            </select>
                                        </div>
                                    
                            </div>
                            <!-- modal footer  -->
                            <div class="modal-footer d-flex justify-content-center">
                                <div class="">
                                    <button type="button" class="btn btn-danger mt-2" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" id="btnver_actividad" class="btn btn-success mt-2" data-toggle="modal" data-target="#modal-dialog modal-sm modal-dialog-centered" data-dismiss="modal">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------------------------------------------------------------------------------- -->
                <div class="modal fade" id="modal-gestionar-actividades_alumno">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <!-- modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Actividades del alumnno:  </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id=></button>
                            </div>
                            <!-- modal body -->
                            <div class="modal-body">
                                <!-- çategoria ruta y estado -->
                                <div id="mostrar_data_actividades"></div>
                            </div>
                            <!-- modal footer  -->
                            <div class="modal-footer d-flex justify-content-center">
                                <div class="">
                                    <button id="closeM" type="button" class="btn btn-danger mt-2" data-bs-dismiss="modal">Salir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- -------------------------------------------------------------------------------------------------------------------- -->
                <div class="btn-agregar-clase btnGenerarPlantilla col-md-8" style="width: 100%; display: flex; justify-content: center;">
                    <button id="studentsExcelBtn" type="button" class="btn btn-light btn-sm mb-4"
                    style="display: flex; justify-content: center; align-items: center;">
                        <i class="material-icons">
                            add
                        </i>
                        <span>Generar Plantilla</span>
                    </button>
                    &nbsp;                           
                    <button id="studentsExcelUploadBtn" type="button" class="btn btn-light btn-sm mb-4"
                    style="display: flex; justify-content: center; align-items: center; margin-left: 5px">
                        <i class="material-icons">
                            upload
                        </i>
                        <span>Subir Plantilla</span>
                    </button>
                    <input id="uploadFileInput" type="file" accept=".xls, .xlsx, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" hidden>
                    <input type="hidden" name="id_usuario" id="txtid_usuario" value="<?php echo $id_usuario ?>">
                </div>                            
            </form>
            <div class="col-11">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> Listado de alumnos registrados </h5>
                    </div>
                    <div class="card-body">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <div class="table-responsive">
                                <table id="tablaOrigen" class="table table-striped table-bordered table-ml table-hover  p-3"
                                    style="width:100%">
                                    <thead class="table-active ">
                                        <tr>
                                            <th scope="col" class="text-center">No.</th>
                                            <th scope="col" class="text-center">Clave</th> <!--codigos quemados -->
                                            <th scope="col" class="text-center">Nombres</th>
                                            <th scope="col" class="text-center">Apellidos</th>
                                            <th scope="col" class="text-center">Grado</th>
                                            <th scope="col" class="text-center">Seccion</th>
                                            <th scope="col" class="text-center">Nota Total</th>
                                            <th scope="col" class="text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Se auto llena con informacion desde el Javascript -->
                                    </tbody>
                                    <tfoot class="table-active">
                                        <tr>
                                            <th scope="col" class="text-center">No.</th>
                                            <th scope="col" class="text-center">Clave</th> <!--codigos quemados -->
                                            <th scope="col" class="text-center">Nombres</th>
                                            <th scope="col" class="text-center">Apellidos</th>
                                            <th scope="col" class="text-center">Grado</th>
                                            <th scope="col" class="text-center">Seccion</th>
                                            <th scope="col" class="text-center">Nota Total</th>
                                            <th scope="col" class="text-center">Opciones</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    
        <?php
    }
    function get_actividad()
    {
        ?>
            <div class="col-11">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> Actividades</h5>
                    </div>
                    <div class="card-body">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <div class="table-responsive">
                                <table id="tablaOrigen" class="table table-striped table-bordered table-ml table-hover  p-3" style="width:100%">
                                    <thead class="table-active ">
                                        <tr>
                                            <th scope="col" class="text-center">No.</th>
                                            <th scope="col" class="text-center">Nombres</th> <!--codigos quemados -->
                                            <th scope="col" class="text-center">Apellidos</th>
                                            <th scope="col" class="text-center">Actividad / Etapa</th>
                                            <th scope="col" class="text-center">Nota Estudiante</th>
                                            <th scope="col" class="text-center">Nota Actividad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Se auto llena con informacion desde el Javascript -->
                                    </tbody>
                                    <tfoot class="table-active">
                                        <tr>
                                            <th scope="col" class="text-center">Total</th>
                                            <th scope="col" class="text-center"></th> <!--codigos quemados -->
                                            <th scope="col" class="text-center"></th>
                                            <th scope="col" id="notaTotalEstudiante" class="text-center"></th>
                                            <th scope="col" id="notaTotalActividades" class="text-center"></th>
                                            <th scope="col" id="notaTotalReal" class="text-center"></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

    

}
?>