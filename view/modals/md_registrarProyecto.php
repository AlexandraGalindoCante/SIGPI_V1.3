<form id="guardarProyecto">


    <div class="modal" id="registroProyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Nuevo proyecto</h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>

           <div class="form-group">
              <label >Nombre del proyecto: </label>
              <input type="text" class="form-control" name="nombre" pattern="[a-zA-ZáćéįóúÿýżźñÉÓÚÑ-]{1-20}" required>
            </div>

            <div class="form-group">
                <label >Fecha de inicio: </label>
                <div class='input-group date' id='datetimepicker1'>
                  <input type='date' class="form-control" name="inicio" >
                </div>
            </div>

            <div class="form-group">
                <label >Fecha de entrega: </label>
                <div class='input-group date' id='datetimepicker1'>
                  <input type='date' class="form-control" name="fin" >
                </div>
            </div>

            <div class="form-group">
              <label>Cliente:</label>
              <select class="form-control" required name="cliente">
                <?php
                  $mysql=conectar();
                  $registro=$mysql->query("select idCliente, nombre from cliente where visibilidad ='1'") or die($mysql->error);
                  while($reg=$registro->fetch_array()){
                    echo "<option value=\"".$reg['idCliente']."\">".$reg['nombre']."</option>";
                  }
                  $mysql->close();
                ?>



                
              </select>
            </div> 

            <div class="form-group">
              <label>Estado del proyecto</label>    
              <select class="form-control" required name="estado">
                <?php
                  $mysql=conectar();
                  $registro=$mysql->query("select idEstadoProyecto, nombre from estadoProyecto") or die($mysql->error);
                  while($reg=$registro->fetch_array()){
                    echo "<option value=\"".$reg['idEstadoProyecto']."\">".$reg['nombre']."</option>";
                  }
                  $mysql->close();
                ?>
              </select>
            </div>

            <div class="form-group">
              <label >Avance </label>
              <input type="number" class="form-control" value="0" min="0" max="100" name="avance" >
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