 
<form id="guardarDirectorio" >
 <div class="modal " id="registroDirectorio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Agregar proveedor</h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>
            <input type="hidden" name="idMaterial" id="idMaterial"> 
            <input type="hidden" name="funcion" value="registrar"> 
            <div class="form-group">
              <label> Proveedor:</label>
              <select class="form-control" required name="idProveedor">
                <?php
                  $mysql=conectar();
                  $registro=$mysql->query("select idProveedor, nombre from proveedor where visibilidad = '1'") or die($mysql->error);
                  while($reg=$registro->fetch_array()){
                    echo "<option value=\"".$reg['idProveedor']."\">".$reg['nombre']."</option>";
                  
                  }
                  $mysql->close();

                ?>
  
              </select>
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