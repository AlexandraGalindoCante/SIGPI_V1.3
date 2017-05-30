<form id="cambiarCont">
 <div class="modal " id="cambiarContrasena" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Cambio de contraseña </h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>

            <div class="form-group">
              <label >Ingrese su contraseña actual: </label>
              <input class="form-control" placeholder="Contraseña actual" name="passVieja" type="password">
              <br>
              <label >Ingrese una nueva contraseña: </label>
              <input class="form-control" placeholder="Contraseña nueva" name="passNueva" type="password">
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