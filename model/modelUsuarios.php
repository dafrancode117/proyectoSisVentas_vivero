<?php
   require_once "conexion.php";

   class ModeloUsuarios{
      static public function mdlMostrarUsuarios($tabla, $item, $valor){
         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =  :$item");
         $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR); // enlazamos el parametro
         $stmt -> execute();
         return $stmt -> fetch() ; // retornamos una sola fila de nuestra tabla
      }
   }
?>