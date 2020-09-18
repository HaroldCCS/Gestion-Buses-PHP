<?php

if ($_POST)
{

	require("../../model/mysql.php"); 
	$pdo = new db();
	$ruta = $pdo->mysql->query("select * from ruta order by id_ruta asc");
	foreach($ruta as $rutas)
	{
	  $ip= $rutas['id_ruta'];
	}
    $id = $ip+1;


	$pdo = new db();
	$inicio = $_POST["inicio"];
	$intermedio = $_POST["intermedio"];
	$fin = $_POST["fin"];
	$cantidad = $_POST["cantidad"];
	$buss = $_POST["bus1"];

	echo $buss;
 


	try
	{
		$pdo->mysql->beginTransaction();

		$pst = $pdo->mysql->prepare("insert into ruta() values(:id,:inicio,:intermedio,:fin)");
		$pst->bindParam(":id", $id, PDO::PARAM_INT);
		$pst->bindParam(":inicio", $inicio, PDO::PARAM_STR);
		$pst->bindParam(":intermedio", $intermedio, PDO::PARAM_STR);
		$pst->bindParam(":fin", $fin, PDO::PARAM_STR);

		$pst->execute();
		$pdo->mysql->commit();

		$pdo->mysql->beginTransaction();
		$pst2 = $pdo->mysql->prepare("insert into detalle_ruta() values(:id,:buss)");
		$pst2->bindParam(":id", $id, PDO::PARAM_INT);
		$pst2->bindParam(":buss", $buss, PDO::PARAM_INT);

		$pst2->execute();
		$pdo->mysql->commit();

		/*for ($i=1; $i < $cantidad+1; $i++) { 
			echo $i."<br>";
			$bonche = "bus".$i;
			echo "este es el bomche : ".$bonche."<br>";
			$bus = $_POST[$bonche];
			echo $bus."<br><br><br>";
		}*/

		header("Location:../../view/layout/layouts/layout.php?menu=ruta");	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "El ruta no pudo ser guardado.";
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}

}