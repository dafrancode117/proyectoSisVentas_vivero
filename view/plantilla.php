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

<body class="hold-transition sidebar-collapse sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php
      // CABEZERA
      include "model/cabezera.php";
      // MENU LATERAL
      include "model/menuLateral.php";
      // CONTENIDO
      include "model/contenido.php";
      // PIE DE PAGINA
      include "model/piePagina.php";
    ?>
  </div>
  <!-- ./wrapper -->
</body>

</html>