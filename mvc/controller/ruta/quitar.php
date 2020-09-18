<?php

if ($_GET)
{

	$id = $_GET["id"];
	$http = "layout.php?menu=ruta";
	if (isset($_GET["http"])) {
		$http = "layout.php?menu=asruta&id=".$_GET["http"];
		echo $http;
	}

	$pdo = new db();

	try
	{
		$pdo->mysql->beginTransaction();

		$pst = $pdo->mysql->prepare("DELETE from detalle_ruta where bus = :id");
		$pst->bindParam(":id", $id, PDO::PARAM_INT);

		$pst->execute();
		$pdo->mysql->commit();


		header("Location: ".$http);	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "EL conductor no pudo ser quitado.";

		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	} 
		echo "<br>".$id."<br>";
}