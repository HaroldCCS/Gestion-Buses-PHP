<?php
if ($_SESSION['cargo'] != "administrador") {
  die();
}
require_once('formularios/contratoregistrar.php');
?>
<div class="table-responsive">
  <table id="data_table_php" class="table table-striped table-bordered mydatatable" style="width: 100%">
    <thead>
      <tr>
        <th>id</th>
        <th>fecha de inicio</th>
        <th>fecha de fin</th>
        <th>Cedula</th>
        <th>Nombre</th>
        <th>valor</th>
        <th>estado</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <?php
    $pdo = new db();
    $contratos = $pdo->mysql->query("select *, c.estado as estadocontrato from contrato c, empleado e where e.id_empleado = c.conductor");
    foreach ($contratos as $contrato) {
      echo "<tr>
                <td>{$contrato['id_contrato']}</td>
                <td>{$contrato['fecha_inicio']}</td>
                <td>{$contrato['fecha_fin']}</td>
                <td>{$contrato['cedula']}</td>      
                <td>{$contrato['nombre']} {$contrato['apellido']}</td>
                <td>{$contrato['valor']}</td>
                <td ";
      if ($contrato['estadocontrato'] == '1') {
        echo " class='alert-warning'>Sin bus";
      } elseif ($contrato['estadocontrato'] == '2') {

        $buses = $pdo->mysql->query("select * from detalle_bus_conductor d, bus b where d.bus = b.id_bus and d.conductor = '{$contrato['id_contrato']}'");
        foreach ($buses as $bus) {
          echo " class='alert-primary'>Con bus " . $bus['placa'];
        }
      } else {
        echo " class='alert-danger'>expirado";
      }
      echo "</td>
                <td><a title='Renovar' data-toggle='popover' data-trigger='hover' href='?menu=recontrato&id={$contrato['id_contrato']}'><i class='fas fa-edit'></i></a></td>
                <td><a data-toggle='popover' data-trigger='hover' ";
      if ($contrato['estadocontrato'] == '1') {
        echo "title='Asignar Bus' href='?menu=ascontrato&id={$contrato['id_contrato']}'><i class='fas fa-plus'>";
      } elseif ($contrato['estadocontrato'] == '2') {
        echo "title='Quitar Bus' href='?menu=qucontrato&id={$contrato['id_contrato']}'><i class='fas fa-times-circle btn-outline-danger'>";
      }else {
        echo "><i>";
      }
      echo "</i></a></td></tr>";
    }
    ?>
  </table>
</div>