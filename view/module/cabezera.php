<header class="">
   <!-- ========== Start LOGOTIPO ========== -->
   <div class="preloader flex-column justify-content-center align-items-center">
      <!-- Logo Grande -->
      <span class="logo-lg">
         <img class="animation__shake rounded" src="view/img/plantilla/logoCompleto.jpg" alt="img-responsive" height="160">
      </span>
   </div>
   <!-- ========== End LOGOTIPO ========== -->

   <!-- ========== Start BARRA DE NAVEGACION ========== -->
   <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Botones de navegacion -->
      <ul class="navbar-nav">
         <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
         </li>
      </ul>

      <!-- Perfil de Usuario -->
      <ul class="nav navbar-nav ml-auto">
         <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <!-- Condicional para los usuarios que no tengan foto de perfil -->
               <?php 
                  if($_SESSION["foto"] != ""){
                     echo "<img src='" . $_SESSION['foto'] . "' class='user-image' alt='UsuarioImagen'>";

                  }else{
                     echo '<img src="view/img/usuarios/default/anonymus.png" class="user-image" alt="UsuarioImagen">';
                  }
               ?>
               
               <!-- Invocamos la variable de sesion del controlador usuario -->
               <span class="hidden-xa"><?php echo $_SESSION["nombreCompleto"]; ?></span>
            </a>
            <!-- Dropdown de los usuarios -->
            <ul class="dropdown-menu">
               <li class="user-body">
                  <div class="pull-right">
                     <a href="salir" class="btn btn-default btn-flat">Salir</a>
                  </div>
               </li>
            </ul>
         </li>
      </ul>
   </nav>
   <!-- ========== End BARRA DE NAVEGACION ========== -->
</header>
