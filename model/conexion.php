<?php
   class Conexion{
      static public function conectar(){
         $servidor = "localhost";
         $database = "bd_sis_ventas_vivero";
         $usuario = "root";
         $password = "";
          
         $link = new PDO("mysql:host=$servidor;dbname=$database", $usuario, $password);
         $link -> exec("set names utf8"); // podemos utilizar para los utf8
         return $link;
      }
   }
?>