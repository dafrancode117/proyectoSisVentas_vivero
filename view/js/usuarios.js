// SUBIENDO LA FOTO DEL USUARIO
$(".nuevaFoto").change(function(){
   var imagen = this.files[0];
   console.log("imagen", imagen);

   // Validamos formato de la imagen (jpg o png)
   if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/jpg" && imagen["type"] != "image/png"){
      $(".nuevaFoto").val(""); // limpiamos el input
      
      Swal.fire({
         icon: 'error',
         title: 'Error al subir la imagen',
         text: 'La imagen debe estar en formato JPG o PNG'
      }); // Utilizando el sweet alert de Jquery
   } else if(imagen["size"] > 20000000 ){ // Validamos el peso de la imagen no supere los 20mb
      $(".nuevaFoto").val(""); // limpiamos el input

      Swal.fire({
         icon: 'error',
         title: 'Error al subir la imagen',
         text: 'La imagen no debe pesar mas de 2MB'
      }); // Utilizando el sweet alert de Jquery
   }else{
      var datosImagen = new FileReader; // Clase de javascript para lectura de archivos
      datosImagen.readAsDataURL(imagen); // Lee como dato URL la imagen

      $(datosImagen).on("load", function(event){
         var rutaImagen = event.target.result;
         $(".previsualizar").attr("src", rutaImagen); // creamos una ruta para la imagen
      })
   }
})

//EDITAR USUARIO
$(".btnEditarUsuario").click(function(){
   let idUsuario = $(this).attr("idUsuario");
   
   let datos = new FormData();
   datos.append("idUsuario", idUsuario);

   $.ajax({
      url:"ajax/usuariosAjax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta){
         $("#editarNombre").val(respuesta["nombre"]); // mostramos el valor de nombre
         $("#editarUsuario").val(respuesta["usuario"]); // mostramos el valor de usuario
         $("#editarPerfil").html(respuesta["perfil"]); // como es un option tenemos que imprimir en el html
         $("#editarPerfil").val(respuesta["perfil"]); // lo guardamos en el value, en caso de que el perfil no se modifique
         $("#passwordActual").val(respuesta["password"]); // mostramos el valor de password, pero se mostrara oculto
         $("#fotoActual").val(respuesta["foto"]); // mostramos el valor de foto, pero se mostrara oculto
         // validamos y mostramos el valor de foto:
         if(respuesta["foto"] != ""){
            $(".previsualizar").attr("src", respuesta["foto"]);
         }
      }
   });
})
