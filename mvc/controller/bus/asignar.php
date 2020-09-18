<br>
<form method="post" action="../../../controller/bus/asignarguardar.php">
  <?php
  $pdo = new db();
  try {
    $id = $_GET["id"];
    $datosbus = $pdo->mysql->prepare("select * from bus b where b.id_bus=:id");
    $datosbus->bindParam(":id", $id, PDO::PARAM_INT);
    $datosbus->execute();
    $bus = $datosbus->fetch();
  } catch (PDOException $e) {
    print_r($e->getMessage());
  }
  ?>

  <div class="form-group">
    <label for="exampleInputEmail1">id_bus</label>
    <input autocomplete="off" type="text" name="id" class="form-control" maxlength="10" required="true" placeholder="Enter id_bus" value="<?php echo $bus['id_bus'];; ?>" readonly='readonly' onkeyup="numeros()">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">placa</label>
    <input autocomplete="off" type="text" name="placa" class="form-control" maxlength="10" required="true" placeholder="Enter placa" value="<?php echo $bus['placa'];; ?>" readonly='readonly' onkeyup="numeros()">
  </div>


  <div class='form-group'>
    <label for='exampleInputEmail1'>contrato</label>
    <select name='contrato' value='' class='form-control'>
      <?php $pdo = new db();
      $contratos = $pdo->mysql->query('select * from contrato c, empleado e where c.conductor=e.id_empleado and c.estado = 1');
      foreach ($contratos as $contrato) {
        echo '<option value=' . $contrato['id_contrato'] . '>' . $contrato['cedula'] . '</option>';
      } ?>
    </select>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Enviar</button>

</form>