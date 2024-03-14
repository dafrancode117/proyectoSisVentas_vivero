<?php
   // Destruimos la sesion para que se elimine los datos de inicio de sesion
   session_destroy();
   echo "<script> window.location = 'ingreso' </script>";
?>