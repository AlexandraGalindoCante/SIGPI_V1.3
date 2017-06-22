var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
var expr1 = /^[a-zA-Z]*$/;
 
$(document).ready(function () {
    $("#boton").click(function (){ //función para el boton de enviar
        //recolectamos en variables, lo que tenga cada input.
        //Para mejor manipulación en los if's
        var correo = $("#correo").val();
        var password = $("#pass").val();
        
 
        //Secuencia de if's para verificar contenido de los inputs
 
        //Verifica que no este vacío y que sean letras
        if(correo == ""){
                $("#mensaje0").fadeIn("slow");
                return false;
            }



        if(correo == "" || !expr.test(correo)){
            $("#mensaje3").fadeIn("slow"); 
            return false;                  // con false sale de la secuencia
        }

        if(password == ""){
                $("#mensaje2").fadeIn("slow");
                return false;
            }

 
    });
 
    /*
     *Con estas funciones de keyup, el mensaje de error se muestra y
     * se ocultará automáticamente, si el usuario escribe datos admitidos.
     * Sin necesidad de oprimir de nuevo el boton de registrar.
     *
     * La función keyup lee lo último que se ha escrito y comparamos
     * con nuestras condiciones, si cumple se quita el error.
     * 
     */
    
 
    $("#correo").keyup(function(){
        if( $(this).val() != "" && expr.test($(this).val())){
            $("#mensaje3").fadeOut();
            return false;
        }
    });

    $("#pass").keyup(function(){
        if( $(this).val() != "" ){
            $("#mensaje2").fadeOut();
            return false;
        }
    });
 
 
 
});




 

    $("#btnRecuperar").click(function (){ //función para el boton de enviar
        //recolectamos en variables, lo que tenga cada input.
        //Para mejor manipulación en los if's
        var correo = $("#correo").val();
        
 
        //Secuencia de if's para verificar contenido de los inputs
 
        //Verifica que no este vacío y que sean letras
        if(correo == ""){
                $("#mensaje0").fadeIn("slow");
                return false;
            }



        if(correo == "" || !expr.test(correo)){
            $("#mensaje3").fadeIn("slow"); 
            return false;                  // con false sale de la secuencia
        }
 
    });
 
    /*
     *Con estas funciones de keyup, el mensaje de error se muestra y
     * se ocultará automáticamente, si el usuario escribe datos admitidos.
     * Sin necesidad de oprimir de nuevo el boton de registrar.
     *
     * La función keyup lee lo último que se ha escrito y comparamos
     * con nuestras condiciones, si cumple se quita el error.
     * 
     */

     $( "#recPass" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "controladores/controladorUsuario.php",
                    data: parametros,
                     beforeSend: function(objeto){
                       
                      },
                    success: function(datos){
                    
                    $('#recuperarContrasena').modal('hide');
                    $('.modal-backdrop').remove();
                    load(1);
                  }
            });
          event.preventDefault();
        });



