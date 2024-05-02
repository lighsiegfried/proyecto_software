<?php
//variables globales encod base64 para pdf
class actividades_vista
{
    //funciones de vista

    function get_lista_vista($lista)
    {
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
                <div class="btn-agregar-actividad">
                    <button id="agregar_actividad" type="button" class="btn btn-light btn-sm mb-4" data-toggle="modal"
                        data-target="#modal-gestionar-actividad" data-dismiss="modal">
                        <i class="material-icons">group_add</i>
                        Agregar actividad
                    </button>
                </div>
                <div class="modal fade" id="modal-gestionar-actividad">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <!-- modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Actividad</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id=></button>
                            </div>
                            <!-- modal body -->
                            <div class="modal-body">
                                <!-- çategoria ruta y estado -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtnombre_actividad">Nombre actividad</label>
                                            <input type="text" class="form-control no-uppercase" name="nombre_actividad" id="txtnombre_actividad"
                                                placeholder="Ingrese Nombre de actividad" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtdescripcion">Descripcion(Opcional)</label>
                                            <input type="text" class="form-control no-uppercase" name="descripcion"
                                                id="txtdescripcion" placeholder="Ingrese descripcion" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtpunteo">Punteo</label>
                                            <input type="text" class="form-control no-uppercase" name="punteo" id="txtpunteo"
                                                placeholder="Ingrese punteo de actividad" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtetapa">Etapa</label>
                                            <select name="etapa" class="form-control" id="txtetapa" required>
                                                <option value="<?php if (!isset($_POST['id']))
                                                    echo 'null'; ?>" <?php if (!isset($_POST['id']))
                                                          echo 'selected'; ?>>Asignar etapa</option>
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
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" id="txtid">
                                </div>
                            </div>

                            <!-- modal footer  -->
                            <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" id="btnGuardaractividad" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------------------------------------------------------------------------------- -->

                <div class="btn-agregar-etapa btnAgregaretapa d-flex justify-content-center">
                    <button id="agregar_etapa" type="button" class="btn btn-light btn-sm mb-4" data-toggle="modal"
                        data-target="#modal-dialog modal-sm modal-dialog-centered" data-dismiss="modal">
                        <i class="material-icons">group_add</i>
                        Agregar etapa
                    </button>
                </div>
                <div class="modal fade" id="modal-gestionar-etapa">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <!-- modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar nueva etapa</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id=></button>
                            </div>
                            <!-- modal body -->
                            <div class="modal-body">
                                <!-- çategoria ruta y estado -->
                                <div class="row">
                                    <div class="">
                                        <div class="form-group">
                                            <label for="txtnombre_etapa">Nombre etapa</label>
                                            <input type="text" class="form-control no-uppercase" name="nombre_etapa" id="txtnombre_etapa"
                                                placeholder="Ingrese Nombre de etapa" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal footer  -->
                            <div class="modal-footer justify-content-end">
                                <div class="row">
                                    <button id="eliminar_etapa" type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#modal-dialog modal-sm modal-dialog-centered" data-dismiss="modal">Eliminar etapa</button>
                                    <button type="button" class="btn btn-dark mt-2" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" id="btnGuardaretapa" class="btn btn-primary mt-2">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-gestionar-etapa_eliminar">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <!-- modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Eliminar etapa</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id=></button>
                            </div>
                            <!-- modal body -->
                            <div class="modal-body">
                                <!-- çategoria ruta y estado -->
                                <div class="row">
                                        <div class="form-group">
                                            <label for="txtetapa2">Etapa</label>
                                            <select name="etapa2" class="form-control" id="txtetapa2" required>
                                                <option value="<?php if (!isset($_POST['id']))
                                                    echo 'null'; ?>" <?php if (!isset($_POST['id']))
                                                          echo 'selected'; ?>>seleccionar etapa a eliminar</option>
                                                <?php
                                                foreach ($lista as $valor2) {
                                                    ?>
                                                    <option value="<?php echo $valor2['id']; ?>" <?php if (isset($_POST['id']) and $valor2['id'] == $_POST['id'])
                                                           echo "selected"; ?>>
                                                        <?php echo $valor2['nombre_etapa']; ?>
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
                                    <button type="button" id="btnetapaeliminar" class="btn btn-danger mt-2">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <div class="col-11">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> Actividades</h5>
                    </div>
                    <div class="card-body">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <div class="table-responsive">
                                <table id="tablaOrigen" class="table table-striped table-bordered table-ml table-hover  p-3"
                                    style="width:100%">
                                    <thead class="table-active ">
                                        <tr>
                                            <th scope="col" class="text-center">No.</th>
                                            <th scope="col" class="text-center">Clave etapa</th>
                                            <th scope="col" class="text-center">Nombre actividad</th> <!--codigos quemados -->
                                            <th scope="col" class="text-center">Descripcion</th>
                                            <th scope="col" class="text-center">Punteo</th>
                                            <th scope="col" class="text-center">etapa</th>
                                            <th scope="col" class="text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Se auto llena con informacion desde el Javascript -->
                                    </tbody>
                                    <tfoot class="table-active">
                                        <tr>
                                            <th scope="col" class="text-center">No.</th>
                                            <th scope="col" class="text-center">Clave etapa</th>
                                            <th scope="col" class="text-center">Nombre actividad</th> <!--codigos quemados -->
                                            <th scope="col" class="text-center">Descripcion</th>
                                            <th scope="col" class="text-center">Punteo</th>
                                            <th scope="col" class="text-center">etapa</th>
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

}
?>