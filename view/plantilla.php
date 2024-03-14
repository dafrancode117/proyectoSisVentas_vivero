<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vivero Dannplant</title>

  <!-- ========== Start PLUGINS CSS ========== -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="view/dist/css/adminlte.css">
  <!-- Carga del Favicon -->
  <link rel="icon" type="image/jpg" href="view/img/plantilla/logo.jpg">
  <!-- ========== End PLUGINS CSS ========== -->

  <!-- ========== Start PLUGINS JAVASCRIPT ========== -->
  <!-- jQuery -->
  <script src="view/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="view/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="view/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="view/dist/js/demo.js"></script>
  <!-- ========== End PLUGINS JAVASCRIPT ========== -->

</head>

<body class="hold-transition sidebar-collapse sidebar-mini login-page img-fluid img-responsive" style="background-image: url('view/img/plantilla/bgLogin.jpg');">
  <?php
  //Condicion para validar si se inicio sesion al sistema
  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

    // Inicio del contenido
    echo '<div class="wrapper">';
    // CABEZERA
    include "view/module/cabezera.php";
    // MENU LATERAL
    include "view/module/menuLateral.php";

    // CONTENIDO
    if (isset($_GET["ruta"])) {

      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "categorias" ||
        $_GET["ruta"] == "productos" ||
        $_GET["ruta"] == "clientes" ||
        $_GET["ruta"] == "ventas" ||
        $_GET["ruta"] == "crearVenta" ||
        $_GET["ruta"] == "reportes"
      ) {
        include "view/module/" . $_GET['ruta'] . ".php";
      } else {
        include "view/module/404.php";
      }
    } else {
      include "view/module/404.php";
    }

    /*include "model/inicio.php";
      include "model/usuarios.php";
      include "model/categorias.php";
      include "model/productos.php";
      include "model/clientes.php";
      include "model/ventas.php";
      include "model/crearVenta.php";
      include "model/reportes.php";*/

    // PIE DE PAGINA
    include "view/module/piePagina.php";

    echo "</div>";
  }else{
    // Si no cumple las validaciones, se procedera a enviar al login
    include "view/module/login.php";
  }
  ?>

</body>

</html>