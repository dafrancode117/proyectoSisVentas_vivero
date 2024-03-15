<?php
   class ControladorUsuarios{
      //INGRESO DE USUARIO
      static public function ctrIngresoUsuario(){
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

      // REGISTRO DE USUARIO
      static public function ctrCrearUsuario(){
         if(isset($_POST["nuevoUsuario"])){
            $regexCarEsp = "/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/";// expresion regular que nos permite introducir caracteres especiales como acentos y la letra ñ
            $regexCarAlf = "/^[a-zA-Z0-9]+$/"; // expresion regular que nos permite introducir caracteres alfanumericos
            if(preg_match($regexCarEsp, $_POST["nuevoNombre"]) && preg_match($regexCarAlf, $_POST["nuevoUsuario"])){
               $tabla = "usuarios";
               $datos = array("nombre" => $_POST["nuevoNombre"], "usuario" => $_POST["nuevoUsuario"], "password" => $_POST["nuevoPassword"], "perfil" => $_POST["nuevoPerfil"]);

               // Solicitamos una respuesta
               $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
               if($respuesta == "ok"){
                  echo "<script>
                  Swal.fire({
                     icon: 'success',
                     title: 'El usuario se ha registrado correctamente',
                     text: 'Todo en orden'
                   });
                  </script>"; // Utilizando el sweet alert de Jquery
               }

            }else{
               echo "<script>
               Swal.fire({
                  icon: 'error',
                  title: 'El usuario no puede ir vacío o llevar caracteres especiales',
                  text: 'Intentelo de nuevo por favor'
                });
               </script>"; // Utilizando el sweet alert de Jquery
            }
         }
      }

   }
?>