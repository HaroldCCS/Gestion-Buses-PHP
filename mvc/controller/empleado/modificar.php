<br>
<form method="post" action="../../../controller/empleado/actualizar.php">
  <?php
  $pdo = new db();
  try {
    $id = $_GET["id"];
    $datosempleado = $pdo->mysql->prepare("select * from empleado where id_empleado = :id");
    $datosempleado->bindParam(":id", $id, PDO::PARAM_INT);
    $datosempleado->execute();
    $empleado = $datosempleado->fetch();
  } catch (PDOException $e) {
    print_r($e->getMessage());
  }
  ?>

  <div class="form-group">
    <label for="exampleInputEmail1">id_empleado</label>
    <input autocomplete="off" type="text" name="id" class="form-control" maxlength="10" required="true" placeholder="Enter id_empleado" value="<?php echo $empleado['id_empleado'];; ?>" readonly='readonly' onkeyup="numeros()">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">cedula</label>
    <input autocomplete="off" type="text" name="cedula" class="form-control" maxlength="10" required="true" placeholder="Enter cedula" value="<?php echo $empleado['cedula'];; ?>" onkeyup="numeros()">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">nombre</label>
    <input autocomplete="off" type="text" name="nombre" class="form-control" maxlength="30" required="true" placeholder="Enter nombre" value="<?php echo $empleado['nombre']; ?>">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">apellido</label>
    <input autocomplete="off" type="text" name="apellido" class="form-control" maxlength="30" required="true" placeholder="Enter apellido" value="<?php echo $empleado['apellido']; ?>">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">correo</label>
    <input autocomplete="off" type="email" name="correo" class="form-control" maxlength="50" required="true" placeholder="Enter correo" value="<?php echo $empleado['correo']; ?>">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">telefono</label>
    <input autocomplete="off" type="text" name="telefono" class="form-control" maxlength="10" required="true" pattern="[0-9]{1,10}" placeholder="Enter telefono" value="<?php echo $empleado['telefono']; ?>">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">cargo</label>
    <input autocomplete="off" type="text" name="cargo" class="form-control" maxlength="20" required="true" placeholder="Enter cargo" value="<?php echo $empleado['cargo']; ?>">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">estado</label>
    <select name="estado" value="" class="form-control">
      <option value="1">activo</option>
      <option value="0">inactivo</option>
    </select>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Enviar</button>

</form>