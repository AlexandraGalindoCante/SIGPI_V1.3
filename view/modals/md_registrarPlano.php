<form action="consulta/nuevoPlano.php" method="post" enctype="multipart/form-data">


    <div class="modal " id="registroPlano" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Agregar plano</h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>

          
            <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
            
            <div class="form-group">
              <label >Descripcion: </label>
              <input type="text" class="form-control" name="desc" id="desc" pattern="[a-zA-Z0-9 ]{1,45}" required>

            </div>

            <div class="form-group">
              <label>Seleccione el archivo:</label>
              <input type="file" name="plano">
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