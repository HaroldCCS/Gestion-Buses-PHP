<?php
if (!(($_SESSION['cargo'] == "administrador")||($_SESSION['cargo'] == "rutas"))) {
  die();
}
require_once('formularios/busregistrar.php');
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
<br>
<div class="table-responsive">
  <table id="data_table_php" class="table table-striped table-bordered mydatatable" style="width: 100%">
    <thead>
      <tr>
        <th>id</th>
        <th>placa</th>
        <th>estado</th>
        <th>conductor cedula nombre</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <?php
    $pdo = new db();
    $empleados = $pdo->mysql->query("select * from bus");
    foreach ($empleados as $empleado) {
      echo "<tr>
              <td>{$empleado['id_bus']}</td>
              <td>{$empleado['placa']}</td>
              <td ";

      if ($empleado['estado'] == '1') {
        echo " class='alert-warning'>Sin conductor";
      } elseif ($empleado['estado'] == '2') {
        echo " class='alert-primary'>Con conductor";
      } else {
        echo " class='alert-danger'>En reparacion";
      }

      echo "  </td>
              <td>";

      $buses = $pdo->mysql->query("select * from detalle_bus_conductor dbc, contrato c, empleado e, bus b where 
                dbc.conductor=c.id_contrato and dbc.bus=b.id_bus and c.conductor=e.id_empleado and b.id_bus = '{$empleado['id_bus']}'");
      foreach ($buses as $bus) {
        echo " {$bus['cedula']} {$bus['nombre']} {$bus['apellido']}";
      }
      echo "</td><td><a title='Modificar' data-toggle='popover' data-trigger='hover' 
      href='?menu=upbus&id={$empleado['id_bus']}'><i class='fas fa-edit'></i></a></td>
      <td><a data-toggle='popover' data-trigger='hover' ";
      if ($empleado['estado'] == '1') {
        echo "title='Asignar Bus' href='?menu=asbus&id={$empleado['id_bus']}'><i class='fas fa-plus'>";
      } elseif ($empleado['estado'] == '2') {
        echo "title='Quitar conductor' href='?menu=qubus&id={$empleado['id_bus']}'><i class='fas fa-times-circle btn-outline-danger'>";
      }else {
        echo "><i>";
      }
      echo "</i></a></td></tr>";
    }
    ?>
  </table>
</div>