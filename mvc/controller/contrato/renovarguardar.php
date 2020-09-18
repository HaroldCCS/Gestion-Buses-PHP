<?php

if ($_POST)
{

	require("../../model/mysql.php"); 

	$pdo = new db();
	$id = $_POST["id"];
	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_fin = $_POST["fecha_fin"];
	$valor = $_POST["valor"];

	$estado = $_POST["estado"];

	if ($estado != '1') {
		$estado = '2';
	}

	try
	{
		$pdo->mysql->beginTransaction();
		
		$pst = $pdo->mysql->prepare("update contrato set fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin, valor=:valor, estado=:estado where id_contrato=:id");
		$pst->bindParam(":id", $id, PDO::PARAM_INT);
		$pst->bindParam(":fecha_inicio", $fecha_inicio, PDO::PARAM_STR);
		$pst->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
		$pst->bindParam(":valor", $valor, PDO::PARAM_INT);
		$pst->bindParam(":estado", $estado, PDO::PARAM_STR);

		$pst->execute();
		$pdo->mysql->commit();


		header("Location:../../view/layout/layouts/layout.php?menu=contrato");	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "La renovacion no pudo ser guardada.";
		echo "<br>".$id."<br>".$fecha_inicio."<br>".$fecha_fin."<br>".$valor."<br>".$estado."<br>";
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}

}