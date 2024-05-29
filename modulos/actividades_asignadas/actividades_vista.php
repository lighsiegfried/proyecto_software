<?php
//variables globales encod base64 para pdf
class actividades_vista
{
    //funciones de vista

    function get_lista_vista($lista)
    {
        $id_usuario = $_SESSION['id'];
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
                <div class="d-flex justify-content-center" style="margin-bottom: 10px;">
                    <div class="form-group">
                        <select name="etapa" class="form-control" id="txtEtapaSelect">
                            <option value="<?php if (!isset($_POST['id']))
                                                echo 'null'; ?>" <?php if (!isset($_POST['id']))
                                                                            echo 'selected'; ?>>Filtrar Etapa</option>
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
                <div class="modal fade" id="modal-gestionar-actividad">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <!-- modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar Nota de Actividad</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id=></button>
                            </div>
                            <!-- modal body -->
                            <div class="modal-body">
                                <!-- çategoria ruta y estado -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtpunteo">Punteo</label>
                                            <input type="text" class="form-control no-uppercase" name="punteo" id="txtpunteo" placeholder="Ingrese punteo de actividad" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <input name="txt_idActividad2" id="txt_idActividad2" type="hidden">
                                    <input name="txt_notaTotal" id="txt_notaTotal" type="hidden">
                                    <input type="hidden" name="id_usuario" id="txtid_usuario" value="<?php echo $id_usuario ?>">
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

            </form>
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
                                            <th scope="col" class="text-center">Nombre Actividad</th>
                                            <th scope="col" class="text-center">Nota Estudiante</th>
                                            <th scope="col" class="text-center">Nota Actividad</th>
                                            <th scope="col" class="text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Se auto llena con informacion desde el Javascript -->
                                    </tbody>
                                    <tfoot class="table-active">
                                        <tr>
                                            <th scope="col" class="text-center">No.</th>
                                            <th scope="col" class="text-center">Nombres</th> <!--codigos quemados -->
                                            <th scope="col" class="text-center">Apellidos</th>
                                            <th scope="col" class="text-center">Nombre Actividad</th>
                                            <th scope="col" class="text-center">Nota Estudiante</th>
                                            <th scope="col" class="text-center">Nota Actividad</th>
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