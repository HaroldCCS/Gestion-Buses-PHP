 
<?php

if ($_POST)
{

	require("../../model/mysql.php"); 


	$pdo = new db();
	$id = $_POST["id"];
	$inicio = $_POST["inicio"];
	$intermedio = $_POST["intermedio"];
	$fin = $_POST["fin"];


	try
	{
		$pdo->mysql->beginTransaction();

		$pst = $pdo->mysql->prepare("update ruta set inicio=:inicio, intermedio=:intermedio, fin=:fin where id_ruta=:id");
		$pst->bindParam(":id", $id, PDO::PARAM_INT);
		$pst->bindParam(":inicio", $inicio, PDO::PARAM_STR);
		$pst->bindParam(":intermedio", $intermedio, PDO::PARAM_STR);
		$pst->bindParam(":fin", $fin, PDO::PARAM_STR);

		$pst->execute();
		$pdo->mysql->commit();

		header("Location:../../view/layout/layouts/layout.php?menu=ruta");	
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "La asignacion no pudo ser guardada.";
		echo "<br>".$id.$inicio."<br>";
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}

}