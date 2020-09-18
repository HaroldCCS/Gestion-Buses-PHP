<?php

if ($_GET)
{

	$id = $_GET["id"];
	$bus = $_GET["bus"];
	$http = "layout.php?menu=ruta";
	if (isset($_GET["http"])) {
		$http = "layout.php?menu=asruta&id=".$_GET["http"];
		echo $http;
	}

	$pdo = new db();


	try
	{
		$pdo->mysql->beginTransaction();
		$pst2 = $pdo->mysql->prepare("insert into detalle_ruta() values(:id,:bus)");
		$pst2->bindParam(":id", $id, PDO::PARAM_INT);
		$pst2->bindParam(":bus", $bus, PDO::PARAM_INT);

		$pst2->execute();
		$pdo->mysql->commit();

		header("Location:".$http);	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "La asignacion no pudo ser guardada.";
		
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}
echo "<br>".$id."<br>".$bus."<br>".$http."<br>";
}