<form id="guardarProveedor">


    <div class="modal " id="registroProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Agregar proveedor</h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>

            <div class="form-group">
              <label >Nombre del proveedor: </label>
              <input type="text" class="form-control" name="nombre" pattern="[a-z A-Z0-9]{1,25}" required>
            </div>

            <div class="form-group">
              <label >Nombre del asesor: </label>
              <input type="text" class="form-control"   name="asesor" pattern="[a-z A-Z]{1,50}" required>
            </div>

            <div class="form-group">
              <label >Telefono: </label>
              <input type="text" class="form-control"  name="telefono" pattern="[0-9]{1,25}" required>
            </div>

            <div class="form-group">
              <label >Correo electronico: </label>
              <input type="text" class="form-control" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,50}" required>
            </div>

            <div class="form-group">
              <label >Direccion: </label>
              <input type="text" class="form-control" name="direccion" pattern="[a-zA-Z0-9 #.,-°]{1,45}" required>
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