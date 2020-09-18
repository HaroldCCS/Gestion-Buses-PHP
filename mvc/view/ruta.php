<?php
if (!(($_SESSION['cargo'] == "administrador")||($_SESSION['cargo'] == "rutas"))) {
  die();
}
require_once('formularios/rutaregistrar.php');
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
        <th>inicio</th>
        <th>intermedio</th>
        <th>fin</th>
        <th>buses</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <?php
    $pdo = new db();
    $rutas = $pdo->mysql->query("select * from ruta");
    foreach ($rutas as $ruta) {
      $contraste = "b." . $ruta['id_ruta'];
      echo "<tr>
                    <td>{$ruta['id_ruta']}</td>
                    <td>{$ruta['inicio']}</td>
                    <td>{$ruta['intermedio']}</td>
                    <td>{$ruta['fin']}</td>
                    <td>         
                    ";
      $buses = $pdo->mysql->query("SELECT *, dr.bus as busy from detalle_bus_conductor dbc, bus b, contrato c, empleado e, detalle_ruta dr where
        dbc.bus = b.id_bus and
        dbc.conductor = c.id_contrato and
        c.conductor = e.id_empleado and
        dbc.id_detalle_bus_conductor = dr.bus and
        dr.ruta = '{$ruta['id_ruta']}'
        ");

      foreach ($buses as $bus) {
        echo "
              <ol><b>Placa:</b> {$bus['placa']} <b>Cedula:</b> {$bus['cedula']}
                <a data-toggle='popover' data-trigger='hover'title='Quitar Bus' href='?menu=quruta&id={$bus['busy']}'>
                  <i class='fas fa-times-circle btn-outline-danger'></i>
                </a>
              </ol>
              ";
      }

      echo "</td>
                <td>
                  <a title='Modificar' data-toggle='popover' data-trigger='hover' href='?menu=upruta&id={$ruta['id_ruta']}'>
                  <i class='fas fa-edit'></i>
                  </a>
                </td>
                <td>
                  <a data-toggle='popover' data-trigger='hover'title='Asignar Bus' href='?menu=asruta&id={$ruta['id_ruta']}'>
                    <i class='fas fa-plus'></i>
                  </a>
                </td>
            </tr>";
    }
    ?>
  </table>
</div>

