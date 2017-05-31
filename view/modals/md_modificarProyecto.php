<form id="actualizarProyecto">


    <div class="modal" id="modificarProyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Modificar proyecto </h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>

           <div class="form-group">
              <label >Nombre del proyecto: </label>
              <input type="text" class="form-control" id="nombre" name="nombre" pattern="[a-zA-ZáćéįóúÿýżźñÉÓÚÑ-]{1-20}" required>
              <input type="hidden" class="form-control" id="id" name="idProyecto">
            </div>

            <div class="form-group">
                <label >Fecha de inicio: </label>
                <div class='input-group date' id='datetimepicker1'>
                  <input type='date' class="form-control" id="inicio" name="inicio" >
                </div>
            </div>

            <div class="form-group">
                <label >Fecha de entrega: </label>
                <div class='input-group date' id='datetimepicker1'>
                  <input type='date' class="form-control" name="fin" id="fin" >
                </div>
            </div>

            <div class="form-group">
              <label>Cliente:</label>
              <select class="form-control" required name="cliente" id="cliente">
                <?php
                  $mysql=conectar();
                  $registro=$mysql->query("select idCliente, nombre from Cliente where visibilidad = '1'") or die($mysql->error);
                  while($reg=$registro->fetch_array()){
                    echo "<option value=\"".$reg['idCliente']."\">".$reg['nombre']."</option>";
                  }
                  $mysql->close();
                ?>



                
              </select>
            </div> 

            <div class="form-group">
              <label>Estado del proyecto</label>    
              <select class="form-control" required name="estado" id="idEstado">
                <?php
                  $mysql=conectar();
                  $registro=$mysql->query("select idEstadoProyecto, nombre from EstadoProyecto") or die($mysql->error);
                  while($reg=$registro->fetch_array()){
                    echo "<option value=\"".$reg['idEstadoProyecto']."\">".$reg['nombre']."</option>";
                  }
                  $mysql->close();
                ?>
              </select>
            </div>

            <div class="form-group">
              <label >Avance </label>
              <input type="number" class="form-control" value="0" min="0" max="100" name="avance" id="avance">
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