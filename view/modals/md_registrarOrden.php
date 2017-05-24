 
<form id="guardarOrden">
 <div class="modal " id="registroOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Agregar integrante</h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>
            <input type="hidden" name="idPlano" id="idPlano"> 
            <div class="form-group">
              <label>Material:</label>
              <select class="form-control" required name="idMaterial">
                <?php
                  $mysql=conectar();
                  $registro=$mysql->query("select idMaterial, referencia from Material where visibilidad ='1'") or die($mysql->error);
                  while($reg=$registro->fetch_array()){
                    echo "<option value=\"".$reg['idMaterial']."\">".$reg['referencia']."</option>";
                  }
                  $mysql->close();

                ?>
  
              </select>
            </div> 
            <div class="form-group">
              <label >Cantidad requerida: </label>
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