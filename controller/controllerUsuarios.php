<?php
   class ControladorUsuarios{
      //INGRESO DE USUARIO
      public function ctrIngresoUsuario(){
         if(isset($_POST["ingresoUsuario"])){
            $regex1 = "/^[a-zA-Z0-9]+$/"; // Expresion regular
            
            if(preg_match($regex1, $_POST["ingresoUsuario"] && preg_match($regex1, $_POST["ingresoPassword"]))){ // validamos la regex
               $tabla = "usuarios";
               $item = "usuario";
               $valor = $_POST["ingresoUsuario"];
               
               $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor); // solicitamos una respuesta del model
               var_dump($respuesta);
            }
         }
      }
   }
?>