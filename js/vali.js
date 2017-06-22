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
       


        if(correo == "" || !expr.test(correo)){
            if(correo == ""){
                $("#mensaje0").fadeIn("slow");
                return false;
            }else{
                $("#mensaje3").fadeIn("slow"); 
                return false;      
            }
                         // con false sale de la secuencia
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
        if( $(this).val() != "" ){
            $("#mensaje0").fadeOut();
            return false;
        }
    });

    $("#correo").keyup(function(){
        if(expr.test($(this).val())){
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