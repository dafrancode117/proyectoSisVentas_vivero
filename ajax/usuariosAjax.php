<?php
require_once "../controller/controllerUsuarios.php";
require_once "../model/modelUsuarios.php";

   class AjaxUsuarios{
      // EDITAR USUARIO
      public $idUsuario;
      public function ajaxEditarUsuario(){
         $item = "id";
         $valor = $this -> idUsuario;
         $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

         echo json_encode($respuesta); // lo convertimos a un valor de json
      }
   }

   // EDITAR USUARIO
   if(isset($_POST["idUsuario"])){   
      $editar = new AjaxUsuarios();
      $editar -> idUsuario = $_POST["idUsuario"];
      $editar -> ajaxEditarUsuario();
   }

?>
