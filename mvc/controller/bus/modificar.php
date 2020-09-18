<br>
<form method="post" action="../../../controller/bus/actualizar.php">
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
    <input autocomplete="off" type="text" name="placa" class="form-control" maxlength="6" required="true" placeholder="Enter placa" value="<?php echo $bus['placa'];; ?>">
  </div>


  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Enviar</button>

</form>