<br>
<button type="button" class="btn btn-outline-dark" data-toggle="collapse" data-target="#demo">Filtros</button>

<!-- Button trigger modal -->
<button title="Agregar" data-trigger="hover" type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModal" style="float:right">
  <i class="fas fa-user-plus"></i>
</button>
<br><br>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Contrato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="../../../../mvc/controller/contrato/guardar.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Fecha de Inicio</label>
            <input autocomplete="off" type="date" name="fecha_inicio" class="form-control" maxlength="10" required="true" placeholder="Enter fecha_inicio">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Fecha de Fin</label>
            <input autocomplete="off" type="date" name="fecha_fin" class="form-control" maxlength="30" required="true" placeholder="Enter fecha_fin">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Conductor</label>
            <select name="conductor" value="" class="form-control">
              <?php
              $validador = false;
              $pdo = new db();
              $empleados = $pdo->mysql->query("select * from empleado where not exists (select * from contrato where conductor = id_empleado) and cargo = 'Conductor';");
              foreach ($empleados as $empleado) {
                echo "<option value=" . $empleado['id_empleado'] . ">" . $empleado['cedula'] . "</option>";
                $validador = true;
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Valor del Contrato</label>
            <input autocomplete="off" type="number" name="valor" class="form-control" maxlength="50" required="true" placeholder="Enter valor">
          </div>


      </div>
      <div class="modal-footer">
        <?php
        if (!$validador){
          echo " <div class='alert alert-danger' role='alert'>
                  no hay empleados disponibles
                </div>
         ";
        }else{
          echo "
                  <button type='submit' class='btn btn-primary'>enviar</button>
                ";
        }
        ?>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="demo" class="collapse">
  <input class="form-control btn-link" id="myInput" type="text" placeholder="Search..">
</div>
