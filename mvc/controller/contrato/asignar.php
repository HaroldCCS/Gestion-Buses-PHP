<br>
<form method="post" action="../../../controller/contrato/asignarguardar.php">
  <?php
  $pdo = new db();
  try {
    $id = $_GET["id"];
    $datoscontrato = $pdo->mysql->prepare("select * from contrato c, empleado e where e.id_empleado = c.conductor and c.id_contrato=:id");
    $datoscontrato->bindParam(":id", $id, PDO::PARAM_INT);
    $datoscontrato->execute();
    $contrato = $datoscontrato->fetch();
  } catch (PDOException $e) {
    print_r($e->getMessage());
  }
  ?>

  <div class="form-group">
    <label for="exampleInputEmail1">id_contrato</label>
    <input autocomplete="off" type="text" name="id" class="form-control" maxlength="10" required="true" placeholder="Enter id_contrato" value="<?php echo $contrato['id_contrato'];; ?>" readonly='readonly' onkeyup="numeros()">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">cedula</label>
    <input autocomplete="off" type="text" name="cedula" class="form-control" maxlength="10" required="true" placeholder="Enter cedula" value="<?php echo $contrato['cedula'];; ?>" readonly='readonly' onkeyup="numeros()">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">nombre</label>
    <input autocomplete="off" type="text" name="nombre" class="form-control" maxlength="30" required="true" placeholder="Enter nombre" value="<?php echo $contrato['nombre'] . $contrato['apellido']; ?>" readonly='readonly'>
  </div>

  <div class='form-group'>
    <label for='exampleInputEmail1'>Bus</label>
    <select name='bus' value='' class='form-control'>
      <?php $pdo = new db();
      $buss = $pdo->mysql->query('select * from bus where estado = 1');
      foreach ($buss as $bus) {
        echo '<option value=' . $bus['id_bus'] . '>' . $bus['placa'] . '</option>';
      } ?>
    </select>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Enviar</button>

</form>