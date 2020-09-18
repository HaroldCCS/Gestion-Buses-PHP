<br>
<form method="post" action="../../../controller/contrato/renovarguardar.php">
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

  <div class="form-group">
    <label for="exampleInputEmail1">estado</label>
    <input autocomplete="off" type="text" name="estado" class="form-control" maxlength="30" required="true" placeholder="Enter estado" value="<?php echo $contrato['estado']?>" readonly='readonly'>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">fecha de inicio</label>
    <input autocomplete="off" type="date" name="fecha_inicio" class="form-control" maxlength="30" required="true" placeholder="Enter fecha_inicio" value="<?php echo $contrato['fecha_inicio']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">fecha de fin</label>
    <input autocomplete="off" type="date" name="fecha_fin" class="form-control" maxlength="30" required="true" placeholder="Enter fecha_fin" value="<?php echo $contrato['fecha_fin']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Valor del contrato</label>
    <input autocomplete="off" type="number" name="valor" class="form-control" maxlength="30" required="true" placeholder="Enter valor" value="<?php echo $contrato['valor']; ?>">
  </div>


  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Enviar</button>

</form>