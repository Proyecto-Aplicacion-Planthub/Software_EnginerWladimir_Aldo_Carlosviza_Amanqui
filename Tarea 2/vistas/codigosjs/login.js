$("#formulariologin").on('submit', function (e) {

  e.preventDefault();


   login = $("#login").val();
   clave = $("#clave").val();

   

   $.post("../ajax/usuarios.php?op=verificar",
       {"login":login,"clave":clave},
       function(data)
       {

           data = JSON.parse(data);
           
           console.log(data)

         
           
           
       if (data!=null)
       {
          // Redireccionar si las credenciales son válidas
          $(location).attr("href","categorias.php"); 
      } else {
          // Mostrar mensaje de error si las credenciales son inválidas
          alert("Usuario y/o contraseña incorrectos");
      }
  }).fail(function() {
      // Manejar errores de la solicitud AJAX
      alert("Error al procesar la solicitud");
  });
});




