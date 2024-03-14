<div class="login-box m-5" >
    <!-- /.login-logo -->
    <div class="card card-outline card-transparent bg-transparent">
        <div class="card-header text-center">
            <img class="img-responsive img-fluid rounded-pill" style="padding: 30px, 100px, 0px, 100px;" src="view/img/plantilla/logoCompleto.jpg" alt="Logo Vivero">
        </div>
        <div class="card-body">
            <p class="login-box-msg text-white">Ingreso al Sistema</p>

            <form action="#" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Usuario" name="ingresoUsuario" require>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Contraseña" name="ingresoPassword" require>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 mx-auto">
                        <button type="submit" class="btn btn-info rounded btn-block">Ingresar</button>
                    </div>
                </div>

            </form>
        </div>
        <?php
            // Creamos un objeto instanciado de la clase Usuarios
            $login = new ControladorUsuarios();
            $login -> ctrIngresoUsuario();
        ?>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->