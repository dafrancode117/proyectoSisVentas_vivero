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
                                            <td>'.$value["id"].'</td>
                                            <td>'.$value["nombreCompleto"].'</td>
                                            <td>'.$value["usuario"].'</td>';

                                            // condicional para cargar si el usuario tiene o no tiene una foto de perfil como usuario
                                            if($value["foto"] != ""){
                                                echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px" alt=""></td>';
                                            }else{
                                                echo '<td><img src="view/img/usuarios/default/anonymus.png" class="img-thumbnail" width="40px" alt=""></td>';
                                            }
                                            
                                            echo '<td>'.$value["foto"].'</td>
                                            <td><button class="btn btn-success btn-xs">Activado</button></td>
                                            <td>01-03-2024</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-warning"><i class="fas fa-pen"></i></button>
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
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row no-print">
                            <div class="col-12">
                                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                    Payment
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
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
                            <input type="text" class="form-control form-control-border" id="exampleInputBorder" placeholder="Ingresa el nombre" name="nuevoNombre" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Usuario</label>
                            <input type="text" class="form-control form-control-border" id="exampleInputBorder" placeholder="Ingresa el nombre de usuario" name="nuevoUsuario" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Contraseña</label>
                            <input type="password" class="form-control form-control-border" id="exampleInputBorder" placeholder="Ingresa la contraseña" name="nuevoPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelectBorder">Tipo de Perfil</label>
                            <select class="custom-select form-control-border" id="exampleSelectBorder" name="nuevoPerfil">
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