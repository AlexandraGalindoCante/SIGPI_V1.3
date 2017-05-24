


<form id="guardarMaterial">


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
              <label >Referencia: </label>
              <input type="text" class="form-control" name="referencia" pattern="[a-zA-ZáćéįóúÿýżźñÉÓÚÑ- ]{1-20}" required>
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