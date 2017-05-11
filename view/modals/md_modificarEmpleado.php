<form id="actualizarEmpleado">
    <div class="modal " id="modificarEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Modificar empleado</h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax"></div>
          

            <div class="form-group">
              <label >Nombre completo: </label>
              <input type="text" class="form-control" title="Ingrese solo letras" id="nombreCompleto" name="nombre" pattern="[a-zA-Z áéíóúÁÉÍÓÚ]{1,45}" required >
            </div>

            <div class="form-group">
              <label >Documento: </label>
              <input type="text" class="form-control" name="documento" id="documento" pattern="[a-zA-Z0-9]{1,45}" required >
            </div>

            <div class="form-group">
              <label >Telefono: </label>
              <input type="tel" class="form-control" name="telefono" id="telefono" pattern="[0-9]{7,25}" required>
            </div>

            <div class="form-group">
              <label >Telefono celular: </label>
              <input type="text" class="form-control" name="celular" id="celular" pattern="[0-9]{10,15}" required>
            </div>

            <div class="form-group">
              <label >Correo electronico: </label>
              <input type="email" class="form-control" name="email" id="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
            </div>

            <div class="form-group">
              <label >Direccion: </label>
              <input type="text" class="form-control" name="direccion" id="direccion" pattern="[a-zA-Z0-9 #.,-°]{1,45}" required>
            </div> 

          

            <div class="form-group">
              <input type="hidden" checked class="form-control" id="idUsuario" name="idUsuario">
              <input type="hidden" checked class="form-control" id="idEmpleado" name="idEmpleado">
            </div> 

            <div class="form-group">
              <label>Rol:</label>
              <select class="form-control" required id="idRol" name="idRol">
                <?php
                  
                  $mysql=conectar();
                  $registro=$mysql->query("select idRol, nombre from rol") or die($mysql->error);
                  while($reg=$registro->fetch_array()){
                  
                    echo "<option value=\"".$reg['idRol']."\">".$reg['nombre']."</option>";
                  }
                  $mysql->close();

                ?>
  
              </select>
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

