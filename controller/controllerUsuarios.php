<?php
class ControladorUsuarios
{
   //INGRESO DE USUARIO
   static public function ctrIngresoUsuario()
   {
      if (isset($_POST["ingresoUsuario"])) {
         $regex1 = "/^[a-zA-Z0-9]+$/"; // Expresion regular

         if (preg_match($regex1, $_POST["ingresoUsuario"] && preg_match($regex1, $_POST["ingresoPassword"]))) { // validamos la regex

            // Habilitamos el ingreso con la contraseña encriptada
            //$encriptar = password_hash($_POST["ingresoPassword"], PASSWORD_DEFAULT);
            $encriptar = crypt($_POST["ingresoPassword"], '$2a$07$usesomesillystringforsalt$');

            $tabla = "usuarios";
            $item = "usuario";
            $valor = $_POST["ingresoUsuario"];

            $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor); // solicitamos una respuesta del model

            // Validacion de acceso al sistema
            if ($respuesta["usuario"] == $_POST["ingresoUsuario"] && $respuesta["password"] == $encriptar) {

               if ($respuesta["estado"] == 1) {

                  //echo "<br><div class='alert alert-success mx-4 text-center'>Bienvenido al Sistema</div>";
                  $_SESSION["iniciarSesion"] = "ok";
                  // VARIABLES DE SESION PARA EL USUARIO LOGEADO
                  $_SESSION["id"] = $respuesta["id"];
                  $_SESSION["nombreCompleto"] = $respuesta["nombreCompleto"];
                  $_SESSION["usuario"] = $respuesta["usuario"];
                  $_SESSION["foto"] = $respuesta["foto"];
                  $_SESSION["perfil"] = $respuesta["perfil"];

                  // Registro de Fecha y Hora del ultimo Login del usuario
                  date_default_timezone_set('America/La_Paz');

                  $fecha = date('Y-m-d');
                  $hora = date('H:i:s');
                  $fechaActual = $fecha . ' ' . $hora;

                  $item1 = "ultimoLogin";
                  $valor1 = $fechaActual;
                  $item2 = "id";
                  $valor2 = $respuesta["id"];

                  $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
                  if ($ultimoLogin == "ok") {
                     // Recin lo redireccionamos a la pagina de inicio
                     echo "<script> window.location = 'inicio'; </script>";
                  }
               } else {

                  echo "<br><div class='alert alert-danger mx-4 text-center'>El usuario aún no esta activado</div>";
               }
            } else {
               echo "<br><div class='alert alert-danger mx-4 text-center'>Error al ingresar, sus datos son incorrectos, vuelva a intentarlo</div>";
            }
         }
      }
   }

   // REGISTRO DE USUARIO
   static public function ctrCrearUsuario()
   {
      if (isset($_POST["nuevoUsuario"])) {
         $regexCarEsp = "/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/"; // expresion regular que nos permite introducir caracteres especiales como acentos y la letra ñ
         $regexCarAlf = "/^[a-zA-Z0-9]+$/"; // expresion regular que nos permite introducir caracteres alfanumericos
         if (preg_match($regexCarEsp, $_POST["nuevoNombre"]) && preg_match($regexCarAlf, $_POST["nuevoUsuario"])) {

            // VALIDAR IMAGEN DEL FORMULARIO
            $ruta = "";

            if (isset($_FILES["nuevaFoto"]["tmp_name"])) {
               list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]); // guardamos los valores de la foto en un nuevo array
               $nuevoAncho = 500; // Definimos que todas las imagenes tengan 500px de ancho
               $nuevoAlto = 500; // Definimos que todas las imagenes tengan 500px de alto

               // Creamos el directorio donde se va a guarda la foto del usuario
               $directorio = "view/img/usuarios/" . $_POST["nuevoUsuario"]; // guardamos la carpeta con el nombre del usuario
               mkdir($directorio, 0755); // la creamos y le damos los respectivos permisos

               //OJO -> ES POSIBLE QUE SE TENGA QUE HABILITAR PARA ESTE PARTE EN EL ARCHIVO PHP.INI EL SIGUIENTE COMANDO: extension=gd Y DESCOMENTARLO SI ESTA COMENTADO PARA QUE NOS PUEDA CARGAR LAS IMAGENES EN LAS CARPETAS CREADAS
               // De acuerdo al tipo de imagen aplicamos las funciones por defecto de php
               if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {
                  // Guardamos la imagen en el directorio
                  $aleatorio = mt_rand(100, 999); // genera un numero aleatorio entre el 100 y el 999
                  $ruta = "view/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpg";
                  $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]); // creamos la imagen jpg
                  $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto); // mantiene las mismas propiedades del color de la imagen
                  imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto); // Ajusta la imagen al tamaño de 500 x 500
                  imagejpeg($destino, $ruta); // guarda la foto en la ruta que le asignamos
               }

               if ($_FILES["nuevaFoto"]["type"] == "image/png") {
                  // Guardamos la imagen en el directorio
                  $aleatorio = mt_rand(100, 999); // genera un numero aleatorio entre el 100 y el 999
                  $ruta = "view/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".png";
                  $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]); // creamos la imagen jpg
                  $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto); // mantiene las mismas propiedades del color de la imagen
                  imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto); // Ajusta la imagen al tamaño de 500 x 500
                  imagepng($destino, $ruta); // guarda la foto en la ruta que le asignamos
               }
            }

            // ENCRIPTAMOS LA CONTRASEÑA DEL USUARIO
            $tabla = "usuarios";
            //$encriptar = password_hash($_POST["nuevoPassword"], PASSWORD_DEFAULT);
            $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$usesomesillystringforsalt$');
            $datos = array(
               "nombre" => $_POST["nuevoNombre"],
               "usuario" => $_POST["nuevoUsuario"],
               "password" => $encriptar,
               "perfil" => $_POST["nuevoPerfil"],
               "foto" => $ruta
            );

            // Solicitamos una respuesta
            $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
            if ($respuesta == "ok") {
               echo "<script>
                  Swal.fire({
                     icon: 'success',
                     title: 'El usuario se ha registrado correctamente',
                     text: 'Todo en orden'
                   });
                  </script>"; // Utilizando el sweet alert de Jquery
            } else {
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

   // LECTURA DE USUARIOS
   static public function ctrMostrarUsuarios($item, $valor)
   {
      $tabla = "usuarios";

      $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
      return $respuesta;
   }

   // EDICION DE USUARIO
   static public function ctrEditarUsuario()
   {
      if (isset($_POST["editarUsuario"])) {
         $regexCarEsp = "/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/"; // expresion regular que nos permite introducir caracteres especiales como acentos y la letra ñ
         $regexCarAlf = "/^[a-zA-Z0-9]+$/"; // expresion regular que nos permite introducir caracteres alfanumericos
         if (preg_match($regexCarEsp, $_POST["editarNombre"])) {
            // VALIDAR IMAGEN DEL FORMULARIO
            $ruta = $_POST["fotoActual"];

            if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {
               list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]); // guardamos los valores de la foto en un nuevo array
               $nuevoAncho = 500; // Definimos que todas las imagenes tengan 500px de ancho
               $nuevoAlto = 500; // Definimos que todas las imagenes tengan 500px de alto

               // Creamos el directorio donde se va a guarda la foto del usuario
               $directorio = "view/img/usuarios/" . $_POST["editarUsuario"]; // guardamos la carpeta con el nombre del usuario

               if (!empty($_POST["fotoActual"])) {
                  unlink($_POST["fotoActual"]); // si existe la foto la eliminamos
               } else {
                  mkdir($directorio, 0755); // la creamos y le damos los respectivos permisos
               }


               //OJO -> ES POSIBLE QUE SE TENGA QUE HABILITAR PARA ESTE PARTE EN EL ARCHIVO PHP.INI EL SIGUIENTE COMANDO: extension=gd Y DESCOMENTARLO SI ESTA COMENTADO PARA QUE NOS PUEDA CARGAR LAS IMAGENES EN LAS CARPETAS CREADAS
               // De acuerdo al tipo de imagen aplicamos las funciones por defecto de php
               if ($_FILES["editarFoto"]["type"] == "image/jpeg") {
                  // Guardamos la imagen en el directorio
                  $aleatorio = mt_rand(100, 999); // genera un numero aleatorio entre el 100 y el 999
                  $ruta = "view/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".jpg";
                  $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]); // creamos la imagen jpg
                  $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto); // mantiene las mismas propiedades del color de la imagen
                  imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto); // Ajusta la imagen al tamaño de 500 x 500
                  imagejpeg($destino, $ruta); // guarda la foto en la ruta que le asignamos
               }

               if ($_FILES["editarFoto"]["type"] == "image/png") {
                  // Guardamos la imagen en el directorio
                  $aleatorio = mt_rand(100, 999); // genera un numero aleatorio entre el 100 y el 999
                  $ruta = "view/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".png";
                  $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]); // creamos la imagen jpg
                  $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto); // mantiene las mismas propiedades del color de la imagen
                  imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto); // Ajusta la imagen al tamaño de 500 x 500
                  imagepng($destino, $ruta); // guarda la foto en la ruta que le asignamos
               }
            }
            // CAMBIOS DE LA CONTRASEÑA DEL USUARIO
            $tabla = "usuarios";

            if ($_POST["editarPassword"] != "") {

               $regexCarAlf = "/^[a-zA-Z0-9]+$/"; // expresion regular que nos permite introducir caracteres alfanumericos
               // Almacenamos el password nuevo
               if (preg_match($regexCarAlf, $_POST["editarPassword"])) {
                  $encriptar = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');
               } else {
                  echo "<script>
               Swal.fire({
                  icon: 'error',
                  title: 'La contraseña no puede ir vacía o llevar caracteres especiales',
                  text: 'Intentelo de nuevo por favor'
                });
               </script>"; // Utilizando el sweet alert de Jquery
               }
            } else {
               //$encriptar = $passwordActual;
            }
            $datos = array(
               "nombre" => $_POST["editarNombre"],
               "usuario" => $_POST["editarUsuario"],
               "password" => $encriptar,
               "perfil" => $_POST["editarPerfil"],
               "foto" => $ruta
            );

            $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
            if ($respuesta == "ok") {
               echo "<script>
                     Swal.fire({
                        icon: 'success',
                        title: 'El usuario se ha sido editado correctamente',
                        text: 'Todo en orden'
                      });
                     </script>"; // Utilizando el sweet alert de Jquery
            }
         } else {
            echo "<script>
               Swal.fire({
                  icon: 'error',
                  title: 'El nombre no puede ir vacío o llevar caracteres especiales',
                  text: 'Intentelo de nuevo por favor'
                });
               </script>"; // Utilizando el sweet alert de Jquery
         }
      }
   }

   // ELIMINAR USUARIO
   static function ctrBorrarUsuario()
   {
      if (isset($_GET["idUsuario"])) {
         $tabla = "usuarios";
         $datos = $_GET["idUsuario"];

         if ($_GET["fotoUsuario"] != "") {
            unlink($_GET["fotoUsuario"]);
            rmdir("view/img/usuarios".$_GET["usuario"]);
         }

         $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);
         if ($respuesta == "ok") {
            echo '<script>
         Swal.fire({
            title: "Eliminado",
            text: "El Usuario ha sido eliminado",
            icon: "success",
         });
               </script>'; // Utilizando el sweet alert de Jquery
         }
      }
   }
}
