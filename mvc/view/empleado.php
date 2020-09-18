<?php
if ($_SESSION['cargo'] != "administrador") {
  die();
}

require_once('formularios/empleadoregistrar.php');
$mostrar = " ";
$ver = "";
if (isset($_POST['mostrar'])) {
  if ($_POST['mostrar'] == "todos") {
  } else {
    $ver = $_POST['mostrar'];
    $mostrar = " and estado = '$ver'";
  }
}

?>
<div class="table-responsive">
  <table id="data_table_php" class="table table-striped table-bordered mydatatable" style="width: 100%">
    <thead>
      <tr>
        <th>id</th>
        <th>Cedula</th>
        <th>Nombre</th>
        <th>apellido</th>
        <th>correo</th>
        <th>telefono</th>
        <th>Cargo</th>
        <th>Usuario</th>
        <th>Cargo</th>
        <th>estado</th>
        <th></th>
        <th></th>
      </tr>
    </thead>

    <?php
    $pdo = new db();
    $empleados = $pdo->mysql->query("select *, p.nombre as cargop from usuario u, perfil p, empleado e where p.perfil=u.perfil and e.id_empleado=u.empleado $mostrar");
    foreach ($empleados as $empleado) {
      echo "<tr";

      if ($empleado['estado'] == 0) {

        echo " class='table-danger'";
      }

      echo ">
              <td>{$empleado['id_empleado']}</td>
              <td>{$empleado['cedula']}</td>
              <td>{$empleado['nombre']}</td>
              <td>{$empleado['apellido']}</td>
              <td>{$empleado['correo']}</td>
              <td>{$empleado['telefono']}</td>
              <td>{$empleado['cargo']}</td>
              <td>{$empleado['usuario']}</td>
              <td>{$empleado['cargop']}</td>
              <td>{$empleado['estado']}</td>
              <td><a title='Modificar' data-toggle='popover' data-trigger='hover' href='?menu=upempleado&id={$empleado['id_empleado']}'><i class='fas fa-user-edit'></i></a></td>
              <td><a  title='Inhabilitar' data-toggle='popover' data-trigger='hover' href='../../../../mvc/controller/empleado/estado.php?id={$empleado['id_empleado']}'>";
      if ($empleado['estado'] == 1) {
        echo "<i class='fas fa-user-times btn-outline-danger'>";
      } else {
        echo "<i class='fas fa-check btn-outline-success'>";
      }

      echo " </i></a></td></tr>";
    }
    ?>

  </table>

</div>