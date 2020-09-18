<?php

if ($_GET)
{

	$id = $_GET["id"];

	$pdo = new db();
	$bus = $pdo->mysql->query("select * from detalle_bus_conductor where conductor = '$id'");
	foreach($bus as $buss)
	{
	  	$ipd= $buss['id_detalle_bus_conductor'];
		$busa = $buss['bus'];
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
		$pst2->bindParam(":id", $id, PDO::PARAM_INT);

		$pst2->execute();
		$pdo->mysql->commit();

		$pdo->mysql->beginTransaction();
		$pst3 = $pdo->mysql->prepare("update bus set estado='1' where id_bus=:bus");
		$pst3->bindParam(":bus", $busa, PDO::PARAM_INT);

		$pst3->execute();
		$pdo->mysql->commit();

		header("Location: layout.php?menu=contrato");	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "La asignacion no pudo ser guardada.";

		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}
		echo "<br>".$idd.$busa.$id."<br>";
}