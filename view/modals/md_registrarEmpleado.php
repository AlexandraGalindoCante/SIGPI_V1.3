 
<form id="guardarEmpleado" >
 <div class="modal " id="registroEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">


          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel" align="center">Nuevo empleado</h4>
          </div>

          <div class="modal-body">
          <div id="datos_ajax_register"></div>


          <?php

              $mysql=conectar();
              $i=0;
              $contar=$mysql->query("select count(*) as cuenta from Empleado where visibilidad = '1'") or die($mysql->error);
              $conteoDoc = $contar->fetch_array(MYSQLI_NUM);
              $registro=$mysql->query("select documento from Empleado") or die($mysql->error);
              while($vector=$registro->fetch_array()){
                 
                  $documento[$i]=$vector['documento'];
                $i++;
              }
              
              $mysql->close();
           

          ?>




  

            <div class="form-group">
              <label >Nombre completo: </label>
              <input type="text" class="form-control" title="Ingrese solo letras" name="nombre" pattern="[a-zA-ZáćéįóúÿýżźñÉÓÚÑ- ]{1-20}"required >
            </div>

            <div class="form-group">
              <label >Documento: </label>
              <div class="input-group">
                <input type="text" class="form-control" id="docu"  name="documento" pattern="[0-9]{1,45}" required >
                <span class="input-group-btn">
                  <button type="button" class="btn btn-secondary" onclick="validar()"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
              </div>
              
              
            </div>




            <div class="form-group">
              <label >Telefono: </label>
              <input type="tel" class="form-control" name="telefono" pattern="[0-9]{7,25}" required>
            </div>

            <div class="form-group">
              <label >Telefono celular: </label>
              <input type="text" class="form-control" name="celular" pattern="[0-9]{10,15}" required>
            </div>

            <div class="form-group">
              <label >Correo electronico: </label>
              <input type="email" class="form-control" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
            </div>

            <div class="form-group">
              <label >Direccion: </label>
              <input type="text" class="form-control" name="direccion" pattern="[a-zA-Z0-9 #.,-°]{1,45}" required>
            </div> 

            <div class="form-group">
              <label>Rol:</label>
              <select class="form-control" required name="idRol">
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
               <button class="btn btn-tema" type="submit">Enviar </button>
               <button class="btn btn-tema" data-dismiss="modal">Cerrar</button>
          </div>

        

        </div> 
      </div> 
    </div>
</form>

   
            <script type='text/javascript'>
         <?php
  
        $js_array = json_encode($documento);
        echo "var vector= ". $js_array . ";\n";
        ?>

        function validar(){
          var doc = document.getElementById('docu').value;
          var control = 0;
          for (var i = 0; i < vector.length; i++) {
            if (vector[i]== doc) {
              control = 1;
            } 
            
          }
          if (control == 1) {
            alert("Documento invalido, ya fue registrado");
          }else{
            alert("Documento valido");
          }
            
        }


        </script>          
