<?php

if ($_GET)
{

	$id = $_GET["id"];

	$pdo = new db();
	$bus = $pdo->mysql->query("select * from detalle_bus_conductor where bus = '$id'");
	foreach($bus as $buss)
	{
	  	$ipd= $buss['id_detalle_bus_conductor'];
		$conductor = $buss['bus'];
	}
	$idd = $ipd;


	$pdo = new db();

	try
	{
		$pdo->mysql->beginTransaction();

		$pst = $pdo->mysql->prepare("DELETE from detalle_bus_conductor where id_detalle_bus_conductor = :idd");
		$pst->bindParam(":idd", $idd, PDO::PARAM_INT);

		$pst->execute();
		$pdo->mysql->commit();

		$pdo->mysql->beginTransaction();
		
		$pst2 = $pdo->mysql->prepare("update contrato set estado='1' where id_contrato=:id");
		$pst2->bindParam(":id", $conductor, PDO::PARAM_INT);

		$pst2->execute();
		$pdo->mysql->commit();

		$pdo->mysql->beginTransaction();
		$pst3 = $pdo->mysql->prepare("update bus set estado='1' where id_bus=:bus");
		$pst3->bindParam(":bus", $id, PDO::PARAM_INT);

		$pst3->execute();
		$pdo->mysql->commit();

		header("Location: layout.php?menu=bus");	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "EL conductor no pudo ser quitado.";

		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}
		echo "<br>".$idd.$conductor.$id."<br>";
}