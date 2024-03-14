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
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
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
                                        <tr>
                                            <td>1</td>
                                            <td>Administrador</td>
                                            <td>Administrador</td>
                                            <td><img src="view/img/usuarios/default/anonymus.png" class="img-thumbnail" width="40px" alt=""></td>
                                            <td>Administrador</td>
                                            <td><button class="btn btn-success btn-xs">Activado</button></td>
                                            <td>01-03-2024</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-warning"><i class="fas fa-pen"></i></button>
                                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
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
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">Secondary Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-light">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- ========== End MODAL AGREGAR USUARIO ========== -->
