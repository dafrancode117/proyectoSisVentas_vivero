<?php
require_once "conexion.php";

class ModeloUsuarios
{
   static public function mdlMostrarUsuarios($tabla, $item, $valor)
   {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =  :$item");
      $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR); // enlazamos el parametro
      $stmt->execute();
      return $stmt->fetch(); // retornamos una sola fila de nuestra tablaS
   
      $stmt->closeCursor(); // cerramos conexion con la bd 
      $stmt = null; // vaciamos el objeto
   }

   static public function mdlIngresarUsuario($tabla, $datos)
   {
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreCompleto, usuario, password, perfil) VALUES (:nombreCompleto, :usuario, :password, :perfil)");
      // Enlazamos los parametros
      $stmt->bindParam(':nombreCompleto', $datos['nombre'], PDO::PARAM_STR);
      $stmt->bindParam(':usuario', $datos['usuario'], PDO::PARAM_STR);
      $stmt->bindParam(':password', $datos['password'], PDO::PARAM_STR);
      $stmt->bindParam(':perfil', $datos['perfil'], PDO::PARAM_STR);
      
      if($stmt->execute()){
         return "ok";
      }else{
         return "error";
      }
      $stmt->closeCursor(); // cerramos conexion con la bd 
      $stmt = null; // vaciamos el objeto
   } 
}
