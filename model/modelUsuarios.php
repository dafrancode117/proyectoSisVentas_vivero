<?php
require_once "conexion.php";

class ModeloUsuarios
{
   // MODELO READ (CRUD)
   static public function mdlMostrarUsuarios($tabla, $item, $valor)
   {
      if($item != null){
         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =  :$item");
         $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR); // enlazamos el parametro
         $stmt->execute();
         return $stmt->fetch(); // retornamos una sola fila de nuestra tablas
      }else{
         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
         $stmt->execute();
         return $stmt->fetchAll(); // retornamos todas las filas de la tabla
      }
   
      //$stmt->closeCursor(); // cerramos conexion con la bd 
      $stmt = null; // vaciamos el objeto
   }

   // MODELO CREATE (CRUD)
   static public function mdlIngresarUsuario($tabla, $datos)
   {
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreCompleto, usuario, password, perfil, foto) VALUES (:nombreCompleto, :usuario, :password, :perfil, :foto)");
      // Enlazamos los parametros
      $stmt->bindParam(':nombreCompleto', $datos['nombre'], PDO::PARAM_STR);
      $stmt->bindParam(':usuario', $datos['usuario'], PDO::PARAM_STR);
      $stmt->bindParam(':password', $datos['password'], PDO::PARAM_STR);
      $stmt->bindParam(':perfil', $datos['perfil'], PDO::PARAM_STR);
      $stmt->bindParam(':foto', $datos['foto'], PDO::PARAM_STR);
      
      if($stmt->execute()){
         return "ok";
      }else{
         return "error";
      }
      $stmt->closeCursor(); // cerramos conexion con la bd 
      $stmt = null; // vaciamos el objeto
   } 

   // MODELO UPDATE (CRUD)
   static public function mdlEditarUsuario($tabla, $datos)
   {
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombreCompleto = :nombreCompleto, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");
      // Enlazamos los parametros
      $stmt->bindParam(':nombreCompleto', $datos['nombre'], PDO::PARAM_STR);
      $stmt->bindParam(':password', $datos['password'], PDO::PARAM_STR);
      $stmt->bindParam(':perfil', $datos['perfil'], PDO::PARAM_STR);
      $stmt->bindParam(':foto', $datos['foto'], PDO::PARAM_STR);
      $stmt->bindParam(':usuario', $datos['usuario'], PDO::PARAM_STR);
      
      if($stmt->execute()){
         return "ok";
      }else{
         return "error";
      }
      $stmt->closeCursor(); // cerramos conexion con la bd 
      $stmt = null; // vaciamos el objeto
   } 

   // ACTUALIZAR el estado del usuario
   static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
      // Enlazamos los parametros
      $stmt->bindParam(':'.$item1, $valor1, PDO::PARAM_STR);
      $stmt->bindParam(':'.$item2, $valor2, PDO::PARAM_STR);

      if($stmt->execute()){
         return "ok";
      }else{
         return "error";
      }
      $stmt->closeCursor(); // cerramos conexion con la bd 
      $stmt = null; // vaciamos el objeto
   }

   // MODELO DELETE (CRUD)
   static public function mdlBorrarUsuario($tabla, $datos){
      $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
      // Enlazamos los parametros
      $stmt->bindParam(':id', $datos, PDO::PARAM_INT);

      if($stmt->execute()){
         return "ok";
      }else{
         return "error";
      }
      $stmt->closeCursor(); // cerramos conexion con la bd 
      $stmt = null; // vaciamos el objeto
   }
}
