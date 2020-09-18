<?php

if ($_POST)
{

	require("../../model/mysql.php"); 
	$pdo = new db();
	$bus = $pdo->mysql->query("select * from bus order by id_bus asc");
	foreach($bus as $buss)
	{
	  $ip= $buss['id_bus'];
	}
    $id = $ip+1;

	$pdo = new db();
	$bus = $pdo->mysql->query("select * from detalle_bus_conductor order by id_detalle_bus_conductor asc");
	foreach($bus as $buss)
	{
	  $ipd= $buss['id_detalle_bus_conductor'];
	}
	$idd = $ipd+1;
	

	$pdo = new db();
	$placa = $_POST["placa"];
	$conductor = $_POST["conductor"];
	$estado = $_POST["estado"];


	if ($estado == false) {
		$estado = '1';
	}
	echo $conductor;
	$pdo3 = new db();
	try
	{
		$pdo->mysql->beginTransaction();

		$pst = $pdo->mysql->prepare("insert into bus() values(:id,:placa,:estado)");
		$pst->bindParam(":id", $id, PDO::PARAM_INT);
		$pst->bindParam(":placa", $placa, PDO::PARAM_STR);
		$pst->bindParam(":estado", $estado, PDO::PARAM_INT);

		$pst->execute();
		$pdo->mysql->commit();

		if ($estado == '2') {
			$pdo->mysql->beginTransaction();
			$pst2 = $pdo->mysql->prepare("insert into detalle_bus_conductor() values(:idd,:id,:conductor)");
			$pst2->bindParam(":idd", $idd, PDO::PARAM_INT);
			$pst2->bindParam(":conductor", $conductor, PDO::PARAM_INT);
			$pst2->bindParam(":id", $id, PDO::PARAM_INT);

			$pst2->execute();
			$pdo->mysql->commit();	

			$pdo3->mysql->beginTransaction();
			$pst3 = $pdo->mysql->prepare("update contrato set estado=:estado where id_contrato=:conductor");
			$pst3->bindParam(":conductor", $conductor, PDO::PARAM_INT);
			$pst3->bindParam(":estado", $estado, PDO::PARAM_STR);

			$pst3->execute();
			$pdo3->mysql->commit();
		}


		header("Location:../../view/layout/layouts/layout.php?menu=bus");	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "El bus no pudo ser guardado.";
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}

}