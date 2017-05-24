<form id="actualizarCliente">
    <div class="modal " id="modificarCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Modificar cliente</h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax"></div>
          

            <div class="form-group">
              <label >Nombre completo:</label>
              <input type="text" class="form-control" id="nombre" title="Ingrese solo letras" name="nombre" pattern="[a-zA-ZáćéįóúÿýżźñÉÓÚÑ- ]{1,45}" required >
              <input type="hidden" class="form-control" id="id" name="idCliente">
            </div>

            <div class="form-group">
              <label >Telefono: </label>
              <input type="tel" class="form-control" id="fijo" name="telefono" pattern="[0-9]{7,25}" required>
            </div>

            <div class="form-group">
              <label >Telefono celular: </label>
              <input type="text" class="form-control" id="celular" name="celular" pattern="[0-9]{10,15}" required>
            </div>

            <div class="form-group">
              <label >Correo electronico: </label>
              <input type="email" class="form-control" value="" id="correo" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
            </div>

            <div class="form-group">
              <label >Nit </label>
              <input type="text" class="form-control" value="" id="nit" name="nit" pattern="[a-zA-Z0-9]{1,45}" required>
            </div> 

   
          
          </div>
          
          <div class="modal-footer">
               <button class="btn btn-success" type="submit">Enviar </button>
               <button class="btn btn-tema" data-dismiss="modal">Cerrar</button>
          </div>

        

        </div> 
      </div> 
    </div>
</form>