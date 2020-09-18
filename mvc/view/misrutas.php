<?php
if ($_SESSION['cargo'] != "conductor") {
  die();
}
$conductor = $_SESSION['empleado']
?>
<br>
<div class="table-responsive">
	<table id="data_table_php" class="table table-striped table-bordered mydatatable" style="width: 100%">
  <thead>
    <tr>
      <th>id</th>
      <th>inicio</th>
      <th>intermedio</th>
      <th>fin</th>
      <th>Placa-bus</th>
    </tr>
  </thead>

    <?php
    $pdo = new db();
    $rutas = $pdo->mysql->query("select * from detalle_bus_conductor dc, contrato c, detalle_ruta dr, ruta r, bus b where 

    dc.conductor = c.id_contrato and 
    dr.bus = dc.id_detalle_bus_conductor and
    r.id_ruta = dr.ruta and
    b.id_bus = dc.bus and
    c.conductor=$conductor");
    foreach ($rutas as $ruta) {
      echo "<tr>
                <td>{$ruta['id_ruta']}</td>
                <td>{$ruta['inicio']}</td>
                <td>{$ruta['intermedio']}</td>
                <td>{$ruta['fin']}</td>      
                <td>{$ruta['placa']}</td>      
              </tr>";
    }
    ?>

</table>