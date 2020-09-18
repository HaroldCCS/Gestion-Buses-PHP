<?php
  $validador = false;
  $pdo = new db(); 
  $pruebas = $pdo->mysql->query('select * from contrato c, empleado e where e.id_empleado=c.conductor and c.estado = 1'); 
  foreach ($pruebas as $prueba) 
  { 
    $validador= true;
  }
  ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Registrar Bus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="../../../../mvc/controller/bus/guardar.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Placa</label>
            <input autocomplete="off" type="text" name="placa" class="form-control" maxlength="6" required="true" placeholder="Enter placa">
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="elegir" value="2" name="estado">
            <label class="form-check-label" for="inlineCheckbox1">Seleccionar conductor</label>
          </div>
          <br>
          <br>


          <div id="buses"></div>
          <script>
            function multiplicar() {
              console.log(document.getElementById("elegir").checked);
              if (document.getElementById("elegir").checked == true) {
                contador = true;
                document.getElementById("buses").innerHTML= "<div class='form-group'><label for='exampleInputEmail1'>Conductor</label> <select name='conductor' value='' class='form-control'> <?php $pdo = new db(); $contratos = $pdo->mysql->query('select * from contrato c, empleado e where e.id_empleado=c.conductor and c.estado = 1'); foreach ($contratos as $contrato) { echo '<option value=' . $contrato['id_contrato'] . '>' . $contrato['cedula'] . '</option>'; $validar= true;}?></select></div>";
              }else{
                document.getElementById("buses").innerHTML= "";
              }
            }
            multiplicar();
            var elegir = document.getElementById('elegir');
            elegir.addEventListener('click', function() {
                multiplicar();
            });
          </script>


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