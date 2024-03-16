<!-- Iniciamos Sesiones -->
<?php
session_start();
?>

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
  <!-- DataTables -->
  <link rel="stylesheet" href="view/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="view/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="view/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
  <!-- DataTables  & Plugins -->
  <script src="view/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="view/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="view/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="view/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="view/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="view/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="view/plugins/jszip/jszip.min.js"></script>
  <script src="view/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="view/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="view/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="view/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="view/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- CDN del sweetalert de Jquery para las alerta -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- ========== End PLUGINS JAVASCRIPT ========== -->

</head>

<body class="hold-transition sidebar-collapse sidebar-mini img-fluid img-responsive" style="background-image: url('view/img/plantilla/bgLogin.jpg');">
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
        $_GET["ruta"] == "reportes" ||
        $_GET["ruta"] == "salir"
      ) {
        include "view/module/" . $_GET['ruta'] . ".php";
      } else {
        include "view/module/404.php";
      }
    } else {
      include "view/module/404.php";
    }

    // PIE DE PAGINA
    include "view/module/piePagina.php";

    echo "</div>";
  } else {
    // Si no cumple las validaciones, se procedera a enviar al login
    include "view/module/login.php";
  }
  ?>
  <!-- Archivo JS para la subida de fotos al formulario de registro -->
  <script src="view/js/usuarios.js"></script>
</body>

</html>