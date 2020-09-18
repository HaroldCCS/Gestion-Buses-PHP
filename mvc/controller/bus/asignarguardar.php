<?php

if ($_POST)
{

	require("../../model/mysql.php"); 
	$pdo = new db();
	$bus = $pdo->mysql->query("select * from detalle_bus_conductor order by id_detalle_bus_conductor asc");
	foreach($bus as $buss)
	{
	  $ipd= $buss['id_detalle_bus_conductor'];
	}
	$idd = $ipd+1;


	$pdo = new db();
	$id = $_POST["id"];
	$conductor = $_POST["contrato"];

	if ($conductor == '') {
		header("Location:../../view/layout/layouts/layout.php?menu=bus&sinbuses");	
	}
	try
	{
		$pdo->mysql->beginTransaction();

		$pst = $pdo->mysql->prepare("insert into detalle_bus_conductor() values(:idd,:id,:conductor)");
		$pst->bindParam(":idd", $idd, PDO::PARAM_INT);
		$pst->bindParam(":id", $id, PDO::PARAM_INT);
		$pst->bindParam(":conductor", $conductor, PDO::PARAM_INT);

		$pst->execute();
		$pdo->mysql->commit();

		$pdo->mysql->beginTransaction();
		
		$pst2 = $pdo->mysql->prepare("update bus set estado='2' where id_bus=:id");
		$pst2->bindParam(":id", $id, PDO::PARAM_INT);

		$pst2->execute();
		$pdo->mysql->commit();

		$pdo->mysql->beginTransaction();
		$pst3 = $pdo->mysql->prepare("update contrato set estado='2' where id_contrato=:conductor");
		$pst3->bindParam(":conductor", $conductor, PDO::PARAM_INT);

		$pst3->execute();
		$pdo->mysql->commit();

		header("Location:../../view/layout/layouts/layout.php?menu=bus");	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "La asignacion no pudo ser guardada.";
		echo "<br>".$idd.$id.$conductor."<br>";
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}

}