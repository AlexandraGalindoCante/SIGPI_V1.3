
<?php 


function validaTextoRequerido($valor){
   if(trim($valor)==""){
      return false;
   }
   else{
      return true;
   }
}

function validarEntero($valor,$opciones=null){

   if(filter_var($valor,FILTER_VALIDATE_INT,$opciones) === false){
      return false;
   }
   else{

      return true;
   }

}
function validarEmail($valor){
   if(filter_var($valor,FILTER_VALIDATE_EMAIL) === false){
      return false;
   }
   else{
      return true;
   }
}




?>