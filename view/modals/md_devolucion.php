 
<form id="guardarDevolucion">
 <div class="modal " id="devolucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Devolucion</h4>
          </div>


          <div class="modal-body">

            
          <div id="datos_ajax_register"></div>
              <input type="hidden" id="ord" name="idOrden">
              <input type="hidden" id="mat" name="idMaterial">  
              <input type="hidden" id="con" name="cantidadConsumida">
              <input type="hidden" id="disp" name="cantidadDisponible">
              <input type="hidden" id="emp" name="idEmpleado">
              <div class="form-group">
              <label >Cantidad a devolver: </label>
              <input type="number" class="form-control" name="cantidadDevuelta" value="0" min="0" step="0.01" required>
            </div>
                   
          
          </div>
          
          <div class="modal-footer">
               <button class="btn btn-tema" type="submit"> Enviar</button>
               <button class="btn btn-tema" data-dismiss="modal">Cancelar</button>
          </div>

        

        </div> 
      </div> 
    </div>
</form>