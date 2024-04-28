<?php
//variables globales encod base64 para pdf
class usuarios_vista
{
    //funciones de vista

    function get_lista_vista()
    {
        ?>
        <style>
            input[type="text"],
            input[type="password"],
            select {
                text-transform: none !important;
            }

            .no-uppercase {
                text-transform: none !important;
            }
        </style>
        <div class="row justify-content-center ">
            <form id="lista_general_from1" method="post" class="mt-4">
                <div class="btn-agregar-usuario btnAgregar">
                    <button id="agregar_usuario" type="button" class="btn btn-light btn-sm mb-4" data-toggle="modal"
                        data-target="#modal-gestionar-usuario" data-dismiss="modal">
                        <i class="material-icons">group_add</i>
                        Agregar usuario
                    </button>
                </div>
                <div class="modal fade" id="modal-gestionar-usuario">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <!-- modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Usuarios</h4>
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
                                            <label for="txtcorreo">Correo</label>
                                            <input type="text" class="form-control no-uppercase" name="correo" id="txtcorreo"
                                                placeholder="Ingrese Correo" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtpuesto">Puesto</label>
                                            <select name="puesto" class="form-control" id="txtpuesto">
                                                <option value="1">Gestor del Sistema</option>
                                                <option value="2">Director</option>
                                                <option value="3">Subdirector</option>
                                                <option value="4">Profesor</option>
                                                <option value="5">Presidente de clase</option>
                                                <option value="6">Alumno</option>
                                                <option value="7">Padres</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtusuario">Usuario</label>
                                            <input type="text" class="form-control no-uppercase" name="usuario" id="txtusuario"
                                                placeholder="Ingrese Usuario" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtrol">Rol/Privilegios</label>
                                            <select name="rol" class="form-control" id="txtrol">
                                                <option value="1">Administrador</option>
                                                <option value="2">Profesor</option>
                                                <option value="3">Consultor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="txtcontrasenia">Contraseña</label>
                                            <input type="text" class="form-control no-uppercase" name="contrasenia"
                                                id="txtcontrasenia" placeholder="Ingrese Contraseña" autocomplete="off"
                                                required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" id="txtid">
                                </div>
                            </div>

                            <!-- modal footer  -->
                            <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-11">
                <div class="card shadow">
                    <div class="card-header">
                        <h5> Listado de usuarios registrados</h5>
                    </div>
                    <div class="card-body">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <div class="table-responsive">
                                <table id="tablaOrigen" class="table table-striped table-bordered table-ml table-hover  p-3"
                                    style="width:100%">
                                    <thead class="table-active ">
                                        <tr>
                                            <th scope="col" class="text-center">No.</th>
                                            <th scope="col" class="text-center">Usuario</th> <!--codigos quemados -->
                                            <th scope="col" class="text-center">Rol</th>
                                            <th scope="col" class="text-center">Nombres</th>
                                            <th scope="col" class="text-center">Apellidos</th>
                                            <th scope="col" class="text-center">Correo</th>
                                            <th scope="col" class="text-center">Descripcion de Rol</th>
                                            <th scope="col" class="text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Se auto llena con informacion desde el Javascript -->
                                    </tbody>
                                    <tfoot class="table-active">
                                        <tr>
                                            <th scope="col" class="text-center">No.</th>
                                            <th scope="col" class="text-center">Usuario</th> <!--codigos quemados -->
                                            <th scope="col" class="text-center">Rol</th>
                                            <th scope="col" class="text-center">Nombres</th>
                                            <th scope="col" class="text-center">Apellidos</th>
                                            <th scope="col" class="text-center">Correo</th>
                                            <th scope="col" class="text-center">Descripcion de Rol</th>
                                            <th scope="col" class="text-center">Opciones</th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Show a second modal and hide this one with the button below.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                data-bs-dismiss="modal">Open second modal</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Hide this modal and show the first with the button below.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                                data-bs-dismiss="modal">Back to first</button>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a> -->
        <?php
    }

    //lista general
    function mostrar_lista_general()
    {
        ?>
        <style>
            .checkbox-xl .form-check-input {
                scale: 2;
            }

            .checkbox-xl .form-check-label {
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
                                    <table id="tablaOrigen" class="table table-striped table-bordered table-ml table-hover  p-3"
                                        style="width:100%">
                                        <thead class="table-active ">
                                            <tr>
                                                <th scope="col" class="text-center">Orden Movimiento</th>
                                                <!--codigos quemados -->
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
                                                <th scope="col" class="text-center">Orden Movimiento</th>
                                                <!--codigos quemados -->
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

    function mostrar_lista_bodega($lista_fecha)
    {
        ?>
        <style>
            .checkbox-xl .form-check-input {
                scale: 2;
            }

            .checkbox-xl .form-check-label {
                padding-left: 5px;
                margin-left: 5px;
            }

            .vertical-divider {
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
                                                <option value="<?php if (!isset($_POST['fecha_mes']))
                                                    echo 'null'; ?>" <?php if (!isset($_POST['fecha_mes']))
                                                          echo 'selected'; ?>>Seleccione Fecha</option>
                                                <?php
                                                foreach ($lista_fecha as $fechaa) {
                                                    ?>
                                                    <option value="<?php echo $fechaa['fecha_mes']; ?>" <?php if (isset($_POST['fecha_mes']) and $fechaa['fecha_mes'] == $_POST['fecha_mes'])
                                                           echo "selected"; ?>>
                                                        <?php echo $fechaa['anio'] . ' - ' . $fechaa['meses']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-auto checkbox-xl">
                                            <input class="form-check-input mt-3" type="checkbox" value="desc" id="barraDesc">
                                            <label class="form-check-label mt-2" for="inlineCheckbox1">Codigo de barra</label>
                                        </div>
                                        <div class="col-md-auto checkbox-xl">
                                            <input class="form-check-input mt-3 " type="checkbox" value="desc" id="pedidoDesc">
                                            <label class="form-check-label mt-2" for="inlineCheckbox1">Pedido</label>
                                        </div>
                                        <div class="col-md-auto checkbox-xl">
                                            <input class="form-check-input mt-3" type="checkbox" value="desc"
                                                id="fechaPedidoDesc">
                                            <label class="form-check-label mt-2" for="inlineCheckbox1">Fecha Pedido</label>
                                        </div>
                                        <div class="col-md-auto vertical-divider "></div>
                                        <div class="col-md-auto checkbox-xl ">
                                            <input class="form-check-input mt-3 " type="radio" name="flexRadioDefault" id="asc"
                                                value="asc">
                                            <label class="form-check-label mt-2" for="flexRadioDefault2">
                                                Ascendente
                                            </label>
                                        </div>
                                        <div class="col-md-auto checkbox-xl">
                                            <input class="form-check-input mt-3" type="radio" name="flexRadioDefault" id="desc"
                                                value="desc">
                                            <label class="form-check-label mt-2" for="flexRadioDefault2">
                                                Descendente
                                            </label>
                                        </div>
                                        <div class="col-md-auto mb-4">
                                            <div class="col-md-auto">
                                                <button id="get_fechaa" class="btn btn-secondary justify-content-md-center "
                                                    type="submit"><i class="material-icons">search</i> Consultar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="tablaBodega" class="table table-striped table-bordered table-ml table-hover  p-3"
                                        style="width:100%">
                                        <thead class="table-active ">
                                            <tr>
                                                <th scope="col" class="text-center">Orden Movimiento</th>
                                                <!--codigos quemados -->
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
                                                <th scope="col" class="text-center">Orden Movimiento</th>
                                                <!--codigos quemados -->
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


    function get_grafo()
    {
        //imagen en formato base64 para pdf
        global $imagen_logo1;
        global $imagen_logo2;
        global $imagen_logo3;
        ?>
        <div class="d-flex justify-content-center mb-4">
            <input type="hidden" name="fecha" id="fecha"></input>
            <input type="hidden" name="variable" id="variable"></input> <!--Grafica Variable a pdf -->
            <input type="hidden" name="logoTipo" id="logoTipo"
                value="data:image/png;base64,<?php echo $imagen_logo1 . $imagen_logo2 . $imagen_logo3 ?>"></input>
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