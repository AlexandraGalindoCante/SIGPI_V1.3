<form id="guardarCliente">


    <div class="modal " id="registroCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Nuevo cliente</h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>

            <div class="form-group">
              <label >Nombre del cliente: </label>
              <input type="text" class="form-control" name="nombre" id="nombre0" pattern="[a-zA-ZáćéįóúÿýżźñÉÓÚÑ- ]{1-20}" required>
            </div>

            <div class="form-group">
              <label >Telefono: </label>
              <input type="text" class="form-control"   name="fijo" id="fijo0" pattern="[0-9]{7,25}" required>
            </div>

            <div class="form-group">
              <label >Telefono celular: </label>
              <input type="text" class="form-control"  name="celular" id="celular0" pattern="[0-9]{10,25}" required>
            </div>

            <div class="form-group">
              <label >Correo electronico: </label>
              <input type="text" class="form-control"name="email" id="email0" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
            </div>

            <div class="form-group">
              <label >NIT: </label>
              <input type="text" class="form-control" name="nit" id="nit0" pattern="[a-zA-Z0-9]{1,45}" required>
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