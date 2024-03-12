<?php
   // Llamamos al controlador de la plantilla
   require_once "controller/controllerPlantilla.php";

   $plantilla = new ControladorPlantilla(); // instanciamos el objeto de Controlador Plantilla
   $plantilla -> ctrPlantilla();