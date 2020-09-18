<br>
<?php
$pdo = new db();
try {
  $id = $_GET["id"];
  $datosruta = $pdo->mysql->prepare("select * from ruta b where b.id_ruta=:id");
  $datosruta->bindParam(":id", $id, PDO::PARAM_INT);
  $datosruta->execute();
  $ruta = $datosruta->fetch();
} catch (PDOException $e) {
  print_r($e->getMessage());
}
?>
<h3>Ruta</h3>
<div class="form-group ">
  <label for="id">id_ruta</label>
  <input id="nana" autocomplete="off" type="text" name="id" class="form-control" maxlength="10" required="true" placeholder="Enter id_ruta" value="<?php echo $ruta['id_ruta']; ?>" readonly='readonly' onkeyup="numeros()">
</div>

<div class="form-row">
  <div class="form-group col-md-3">
    <label for="inicio">inicio</label>
    <input type="text" class="form-control" placeholder="inicio" value="<?php echo $ruta['inicio']; ?>" readonly='readonly'>
  </div>
  <div class="form-group col-md-6">
    <label for="intermedio">intermedio</label>
    <input type="text" class="form-control" placeholder="intermedio" value="<?php echo $ruta['intermedio']; ?>" readonly='readonly'>
  </div>
  <div class="form-group col-md-3">
    <label for="fin">fin</label>
    <input type="text" class="form-control" placeholder="fin" value="<?php echo $ruta['fin']; ?>" readonly='readonly'>
  </div>
</div>
<hr>
<h3>Buses en ruta</h3>
<div class="form-row align-items-center">

  <?php
  $pdo = new db();
  $buses = $pdo->mysql->query("SELECT *, d.bus as superbus from detalle_bus_conductor dbc, bus b, detalle_ruta d where
  dbc.bus = b.id_bus and
  dbc.id_detalle_bus_conductor = d.bus and 
  ruta = {$ruta['id_ruta']}
  ");
  foreach ($buses as $buse) {
    echo "
          <div class='col-sm-3 my-1'>
            <div class='input-group'>              
              <div class='input-group-prepend'>
                <div class='input-group-text'>Bus</div>
              </div>

              <input type='text' class='form-control' placeholder='fin' value='" . $buse['placa'] . "' readonly='readonly'>
            </div>
          </div>

          <div class='col-auto my-1 mr-5'>
              <a data-toggle='popover' data-trigger='hover'title='Quitar Bus' href='?menu=quruta&id=". $buse['superbus'] ."&http=".$ruta['id_ruta']."'>
                <i class='fas fa-times-circle btn-outline-danger'></i>
              </a>
          </div>                
          ";
  }
  ?>
</div>

<HR>
<h3>Asignar buses</h3>
<div class="form-row align-items-center">
  <div class="col-lg-4 my-1">
    <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">Bus</div>
      </div>
      <select name='contrato' value='' class='form-control' id="elegir">
        <?php
        $validador = false;
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
          $validador = true;
        }
        ?>
      </select>
    </div>
  </div>

  <div class="col-auto my-1">
    <?php
              if (!$validador){
          echo " <div class='alert alert-danger' role='alert'>
                  no hay buses disponibles
                </div>
         ";
        }else{
          echo "<a id='a' data-toggle='popover' data-trigger='hover' title='Agregar Bus' href='?menu=asgruta&id='>
                  <i class='fas fa-plus'></i>
                </a>";
        }
    ?>
  </div>
</div>
<div class="modal-footer">
  <a  class="btn btn-primary" href="layout.php?menu=ruta">Finalizar</a>
</div>
<script>
  var cadena = document.getElementById("a").href;
  var id = document.getElementById("nana").value;
  function cancion() {
    var cadena1 = cadena;
    var escoger = "&bus="+(document.getElementById("elegir").value);
    var buscandourl = cadena1.indexOf("?");
    var cadena2 = cadena1.slice(buscandourl);
    document.getElementById("a").href = cadena2+id+escoger+"&http="+id;
    var cadena3 = document.getElementById("a").href;
    var cadena4 = cadena3.slice(72);

  }

  cancion();  

  var elegir = document.getElementById('elegir');

  elegir.addEventListener('click', function() {
    cancion();
  });
</script>
