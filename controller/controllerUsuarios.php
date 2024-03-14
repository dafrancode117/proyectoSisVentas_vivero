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
               
               $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor); // solicitamos una respuesta del model
               
               // Validacion de acceso al sistema
               if($respuesta["usuario"] == $_POST["ingresoUsuario"] && $respuesta["password"] == $_POST["ingresoPassword"]){
                  //echo "<br><div class='alert alert-success mx-4 text-center'>Bienvenido al Sistema</div>";
                  $_SESSION["iniciarSesion"] = "ok";
                  echo "<script> window.location = 'inicio'; </script>";
                  
               }else{
                  echo "<br><div class='alert alert-danger mx-4 text-center'>Error al ingresar, sus datos son incorrectos, vuelva a intentarlo</div>";
               }
               
            }
         }
      }
   }
?>