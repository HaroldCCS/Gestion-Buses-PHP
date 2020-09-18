<?php

if ($_POST)
{

	require("../../model/mysql.php"); 
	$pdo = new db();
	$contrato = $pdo->mysql->query("select * from contrato order by id_contrato asc");
	foreach($contrato as $contratos)
	{
	  $ip= $contratos['id_contrato'];
	}
    $id = $ip+1;

	$pdo = new db();
	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_fin = $_POST["fecha_fin"];
	$conductor = $_POST["conductor"];
	$valor = $_POST["valor"];
	$estado = "1";


	try
	{
		$pdo->mysql->beginTransaction();

		$pst = $pdo->mysql->prepare("insert into contrato() values(:id,:fecha_inicio,:fecha_fin,:conductor,:valor,:estado)");
		$pst->bindParam(":id", $id, PDO::PARAM_INT);
		$pst->bindParam(":fecha_inicio", $fecha_inicio, PDO::PARAM_STR);
		$pst->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
		$pst->bindParam(":valor", $valor, PDO::PARAM_INT);
		$pst->bindParam(":conductor", $conductor, PDO::PARAM_INT);
		$pst->bindParam(":estado", $estado, PDO::PARAM_STR);

		$pst->execute();
		$pdo->mysql->commit();

		header("Location:../../view/layout/layouts/layout.php?menu=contrato");	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "El contrato no pudo ser guardado.";
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}

}