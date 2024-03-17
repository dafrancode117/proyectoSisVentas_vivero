<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario"><i class="fas fa-user-plus pr-2"></i>Agregar Usuario</button>
                        </div><br>
                        <!-- TABLA DE USUARIOS-->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped tablas">
                                    <thead>
                                        <tr>
                                            <th class="">Id</th>
                                            <th>Nombre</th>
                                            <th>Usuario</th>
                                            <th>Foto</th>
                                            <th>Perfil</th>
                                            <th>Estado</th>
                                            <th>Último Login</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Enviamos los parametros nulos de item y valor, ya que deseamos hacer una lectura de todos los registros de la tabla y no solo de una fila
                                        $item = null;
                                        $valor = null;

                                        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                                        // bucle foreach para iterar los valores de la tabla
                                        foreach ($usuarios as $key => $value) {
                                            echo '
                                                <tr>
                                            <td>' . $value["id"] . '</td>
                                            <td>' . $value["nombreCompleto"] . '</td>
                                            <td>' . $value["usuario"] . '</td>';

                                            // condicional para cargar si el usuario tiene o no tiene una foto de perfil como usuario
                                            if ($value["foto"] != "") {
                                                echo '<td><img src="' . $value["foto"] . '" class="img-thumbnail" width="40px" alt=""></td>';
                                            } else {
                                                echo '<td><img src="view/img/usuarios/default/anonymus.png" class="img-thumbnail" width="40px" alt=""></td>';
                                            }

                                            echo '<td>' . $value["perfil"] . '</td>';

                                            // condicional para establecer los estados
                                            if ($value["estado"] != 0) {
                                                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="0">Activado</button></td>';
                                            } else {
                                                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="1">Desactivado</button></td>';
                                            }

                                            echo '<td>' . $value["ultimoLogin"] . '</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-warning btnEditarUsuario" id="editarNombre" idUsuario="' . $value["id"] . '" data-toggle="modal"  data-target="#modalEditarUsuario"><i class="fas fa-pen"></i></button>
                                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                                ';
                                        }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- ========== Start MODAL AGREGAR USUARIO ========== -->
<div class="modal fade" id="modalAgregarUsuario">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <form role="form" method="POST" enctype="multipart/form-data"> <!-- Habilitamos la subida de archivos con multipart/form-data -->
                <div class="modal-header" style="background:#001f3f;">
                    <h4 class="modal-title text-white">Agregar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h4>Datos</h4>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Nombre</label>
                            <input type="text" class="form-control form-control-border" placeholder="Ingresa el nombre" name="nuevoNombre" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Usuario</label>
                            <input type="text" class="form-control form-control-border" placeholder="Ingresa el nombre de usuario" name="nuevoUsuario" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Contraseña</label>
                            <input type="password" class="form-control form-control-border" placeholder="Ingresa la contraseña" name="nuevoPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Tipo de Perfil</label>
                            <select class="custom-select form-control-border" name="nuevoPerfil">
                                <option value="Administrador">Administrador</option>
                                <option value="Especial">Especial</option>
                                <option value="Vendedor">Vendedor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Foto de Perfil</label>
                            <div class="text-center">
                                <input type="file" class="form-control-file form-control-border nuevaFoto" name="nuevaFoto" placeholder="Ingresa el nombre de usuario">
                                <br>
                                <p class="help-block">Peso máximo de la foto 2MB</p>
                                <img src="view/img/usuarios/default/anonymus.png" alt="Foto de perfil" class="img-thumbnail previsualizar" width="100px">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btn-secondary text-white" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-secondary btn-outline-dark text-white">Guardar Cambios</button>
                </div>

                <!-- Objeto para guardar el usuario -->
                <?php
                $crearUsuario = new ControladorUsuarios();
                $crearUsuario->ctrCrearUsuario();
                ?>

            </form>
        </div>
    </div>
</div>
<!-- ========== End MODAL AGREGAR USUARIO ========== -->

<!-- ========== Start MODAL EDITAR USUARIO ========== -->
<div class="modal fade" id="modalEditarUsuario">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <form role="form" method="POST" enctype="multipart/form-data"> <!-- Habilitamos la subida de archivos con multipart/form-data -->
                <div class="modal-header" style="background:#001f3f;">
                    <h4 class="modal-title text-white">Editar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h4>Datos</h4>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Nombre</label>
                            <input type="text" class="form-control form-control-border" value="" name="editarNombre" id="editarNombre" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Usuario</label>
                            <input type="text" class="form-control form-control-border" value="" name="editarUsuario" id="editarUsuario" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Contraseña</label>
                            <input type="password" class="form-control form-control-border" placeholder="Escriba una nueva contraseña" name="editarPassword" id="editarPassword">
                            <!-- Input oculto para guardar el password en caso de no ser cambiado -->
                            <input type="hidden" name="passwordActual" id="passwordActual">
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Tipo de Perfil</label>
                            <select class="custom-select form-control-border" id="exampleSelectBorder" name="editarPerfil">
                                <option value="" id="editarPerfil"></option>
                                <option value="Administrador">Administrador</option>
                                <option value="Especial">Especial</option>
                                <option value="Vendedor">Vendedor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Foto de Perfil</label>
                            <div class="text-center">
                                <input type="file" class="form-control-file form-control-border nuevaFoto" name="editarFoto" placeholder="Ingresa el nombre de usuario">
                                <br>
                                <p class="help-block">Peso máximo de la foto 2MB</p>
                                <!-- Input oculto para guardar la imagen en caso de no ser cambiada -->
                                <input type="hidden" name="fotoActual" id="fotoActual">
                                <img src="view/img/usuarios/default/anonymus.png" alt="Foto de perfil" class="img-thumbnail previsualizar" width="100px">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger btn-secondary text-white" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-secondary btn-outline-dark text-white">Modificar Usuario</button>
                </div>

                <!-- Objeto para guardar el usuario editado -->

                <?php
                $editarUsuario = new ControladorUsuarios();
                $editarUsuario->ctrEditarUsuario();

                ?>

            </form>
        </div>
    </div>
</div>
<!-- ========== End MODAL EDITAR USUARIO ========== -->