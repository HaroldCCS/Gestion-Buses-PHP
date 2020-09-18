<br>
<form method="post" action="../../../controller/ruta/actualizar.php">
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

  <div class="form-group">
    <label for="exampleInputEmail1">id_ruta</label>
    <input autocomplete="off" type="text" name="id" class="form-control" maxlength="10" required="true" placeholder="Enter id_ruta" value="<?php echo $ruta['id_ruta']; ?>" readonly='readonly' onkeyup="numeros()">
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inicio">inicio</label>
      <input type="text" name="inicio" class="form-control" placeholder="inicio" value="<?php echo $ruta['inicio']; ?>" >
    </div>
    <div class="form-group col-md-6">
      <label for="intermedio">intermedio</label>
      <input type="text" name="intermedio" class="form-control" placeholder="intermedio" value="<?php echo $ruta['intermedio']; ?>" >
    </div>
    <div class="form-group col-md-3">
      <label for="fin">fin</label>
      <input type="text" name="fin" class="form-control" placeholder="fin" value="<?php echo $ruta['fin']; ?>" >
    </div>
  </div>


  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Enviar</button>

</form>