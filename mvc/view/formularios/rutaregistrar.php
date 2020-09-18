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
        <h5 class="modal-title" id="exampleModalLabel">Registrar Ruta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="../../../../mvc/controller/ruta/guardar.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Inicio trayecto</label>
            <input autocomplete="off" type="text" name="inicio" class="form-control" maxlength="10" required="true" placeholder="Enter inicio">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Intermedio trayecto</label>
            <input autocomplete="off" type="text" name="intermedio" class="form-control" maxlength="30" required="true" placeholder="Enter intermedio">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Fin trayecto</label>
            <input autocomplete="off" type="text" name="fin" class="form-control" maxlength="30" required="true" placeholder="Enter Fin">
          </div>

          <!--<div class="form-group">
            <label for="exampleInputEmail1"># buses</label>
            <input autocomplete="off" type="number" name="cantidad" id="cantidad" class="form-control" maxlength="10" required="true" placeholder="Enter # buses" value="0" readonly='readonly'>
          </div>
            <a class="btn btn-warning" onclick="multiplicar()">+ bus</a>
          <div id="buses"></div>
          <script>
            contador = 0;
            function multiplicar() {
              dato = parseInt(document.getElementById("cantidad").value);
              suma = dato + 1;
              document.getElementById("cantidad").value = suma;
              contador = contador + 1;
              document.getElementById("buses").innerHTML+= "<div class='form-group'><label for='exampleInputEmail1'>bus"+contador+"</label><select name='bus"+contador+"' value='' class='form-control'> <?php $pdo = new db(); $buses = $pdo->mysql->query('select * from detalle_bus_conductor');foreach ($buses as $buse) { echo '  <option value=' . $buse['id_detalle_bus_conductor'] . '>' . $buse['id_detalle_bus_conductor'] . '</option>';} ?></select></div>";
            }
          </script>
             <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">Bus</div>
      </div>
      <select name='contrato' value='' class='form-control' id="elegir">
        <?php
        $pdo = new db();
        $bas = $pdo->mysql->query('SELECT * from detalle_bus_conductor dbc,  bus b, contrato c, empleado e
        where         
        dbc.bus = b.id_bus and
        dbc.conductor = c.id_contrato and
        c.conductor = e.id_empleado and 
        NOT exists (select * from detalle_ruta r where id_detalle_bus_conductor= r.bus)
        ');
        foreach ($bas as $ba) {
          echo '  <option value=' . $ba['id_detalle_bus_conductor'] . '>Placa: '. $ba['placa'] .' Cedula: '. $ba['cedula'] .'</option>';
        }
        ?>
      </select>
    </div>-->


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="demo" class="collapse">
  <input class="form-control btn-link" id="myInput" type="text" placeholder="Search..">
</div>