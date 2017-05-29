 
<form id="recPass" action="controladores/controladorUsuario.php">
 <div class="modal " id="recuperarContrasena" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Recuperación de contraseña </h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>

            <div class="form-group">
              <label >Correo electronico: </label>
              <input type="text" class="form-control" title="Ingrese un correo electronico" name="email"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
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