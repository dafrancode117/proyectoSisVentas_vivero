<?php
   // Llamamos al controlador de la plantilla
   require_once "controller/controllerPlantilla.php";

   // Llamamos a los controladores que son parte del crud
   require_once "controller/controllerCategorias.php";
   require_once "controller/controllerClientes.php";
   require_once "controller/controllerProductos.php";
   require_once "controller/controllerUsuarios.php";
   require_once "controller/controllerVentas.php";

   // Llamamos a los modelos que son parte del crud
   require_once "model/modelCategorias.php";
   require_once "model/modelClientes.php";
   require_once "model/modelProductos.php";
   require_once "model/modelUsuarios.php";
   require_once "model/modelVentas.php";
   
   $plantilla = new ControladorPlantilla(); // instanciamos el objeto de Controlador Plantilla
   $plantilla -> ctrPlantilla();