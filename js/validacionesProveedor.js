





var expr1 = /^[a-zA-Z]*$/;
 
$(document).ready(function () {
    $("#boton").click(function (){ //función para el boton de enviar
        //recolectamos en variables, lo que tenga cada input.
        //Para mejor manipulación en los if's
        var nombre = $("#nombre").val();
        var asesor = $("#asesor").val();
        var telefono=$("#telefono").val();|
        var correoElectronico = $("#orreoElectronico").val();
        var direccion = $("#direccion").val();
        
 
        //Secuencia de if's para verificar contenido de los inputs
 
        //Verifica que no este vacío y que sean letras
        if(nombre == "" || !expr1.test(nombre)){
                $("#mensaje0").fadeIn("slow");
                return false;
            }



        if(asesor == "" || !expr1.test(asesor)){
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
    
 
    $("#nombre").keyup(function(){
        if( $(this).val() != "" && expr.test($(this).val())){
            $("#mensaje1").fadeOut();
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