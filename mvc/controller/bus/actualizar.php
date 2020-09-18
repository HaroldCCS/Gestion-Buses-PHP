 
<?php

if ($_POST)
{

	require("../../model/mysql.php"); 


	$pdo = new db();
	$id = $_POST["id"];
	$placa = $_POST["placa"];


	try
	{
		$pdo->mysql->beginTransaction();

		$pst = $pdo->mysql->prepare("update bus set placa=:placa where id_bus=:id");
		$pst->bindParam(":id", $id, PDO::PARAM_INT);
		$pst->bindParam(":placa", $placa, PDO::PARAM_STR);

		$pst->execute();
		$pdo->mysql->commit();

		header("Location:../../view/layout/layouts/layout.php?menu=bus");	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "La asignacion no pudo ser guardada.";
		echo "<br>".$id.$placa."<br>";
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}

}