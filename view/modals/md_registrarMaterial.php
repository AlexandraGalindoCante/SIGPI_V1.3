
<?php 

require_once 'validaciones.php';
$referencia=isset($POST['referencia']) ? $_POST['referencia'] : null;
$especificaciones=isset($POST['especificaciones']) ? $_POST['especificaciones'] : null;
$unidad=isset($POST['unidad']) ? $_POST['unidad'] : null;
$cantidad=isset($POST['cantidad']) ? $_POST['cantidad'] : null;
$errores=array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!validaTextoRequerido($referencia)) {
      $errores[] = 'Debe llenar el campo de especificaciones.';
    }
     if (!validaTextoRequerido($especificaciones)) {
      $errores[] = 'Debe llenar el campo de especificaciones.';
    }

    $opciones_unidad = array(
   'options' => array(
      
      'min_range' => 1,
      'max_range' => 1000000000000000
   ));
   if (!validarEntero($unidad, $opciones_unidad)) {
      $errores[] = 'El campo edad es incorrecto.';
    }
     //Verifica si ha encontrado errores y de no haber redirige a la página con el mensaje de que pasó la validación.
   if(!$errores){
      
      exit;
   }
}



?> 
<form id="guardarMaterial">
    <?php if ($errores): ?>
     <ul style="color: #f00;">
        <?php foreach ($errores as $error): ?>
           <li> <?php echo $error ?> </li>
        <?php endforeach; ?>
     </ul>
  <?php endif; ?>



<form id="guardarMaterial" >



    <div class="modal " id="registroMaterial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Agregar material</h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>

         
            <div class="form-group">
              <label for="referencia">Referencia:(<span id="referencia" class="requisitos ">A-z, mínimo 4 caracteres</span>): </label>
              <input type="text" class="form-control" tabindex="1" name="referencia" pattern="[a-zA-ZáćéįóúÿýżźñÉÓÚÑ- ]{1-20}" required>
            </div>


            <div class="form-group">
              <label >Especificaciones: </label>
              <input type="text" class="form-control" name="especificaciones" pattern="[a-zA-ZáćéįóúÿýżźñÉÓÚÑ- ]{1-20}" required>
            </div>

            <div class="form-group">
              <label >Unidad de medida: </label>
              <input type="text" class="form-control" name="unidad" pattern="[a-zA-ZáćéįóúÿýżźñÉÓÚÑ- ]{1-20}" required>
            </div>

            


            <div class="form-group">
              <label >Cantidad disponible: </label>
              <input type="number" class="form-control" name="cantidad" value="0" min="0" step="0.01" required>
            </div>

          
          </div>
          
          <div class="modal-footer">
               <button class="btn btn-tema" type="submit">Enviar </button>
               <button class="btn btn-tema" data-dismiss="modal">Cerrar</button>
          </div>

  

        </div> 
      </div> 
    </div>
    
</form>