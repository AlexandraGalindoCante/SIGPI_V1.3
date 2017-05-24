 
<form id="guardarTramite">
 <div class="modal " id="registroTramite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Asignar materiales</h4>
          </div>


          <div class="modal-body">

            
          <div id="datos_ajax_register"></div>
              <input type="hidden" id="ord" name="idOrden">
              <input type="hidden" id="mat" name="idMaterial">  
              <input type="hidden" id="req" name="cantidadRequerida">
              <input type="hidden" id="disp" name="cantidadDisponible">
              <input type="hidden" id="emp" name="idEmpleado">
         <p class="lead text-muted text-center" style="display: block;margin:10px">Esta acción asignara la cantidad de materiales requerida por la orden. ¿Deseas continuar?</p>

          
          
          </div>
          
          <div class="modal-footer">
               <button class="btn btn-tema" type="submit">Si </button>
               <button class="btn btn-tema" data-dismiss="modal">No</button>
          </div>

        

        </div> 
      </div> 
    </div>
</form>