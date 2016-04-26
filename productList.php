<?php

require('dbConnexion.php');

//if(isset($_GET['idLoglist']))
if(isset($_GET['hashSession']))
{
	$sql = 'SELECT hashSession FROM LogList WHERE hashSession = :hashSession'
	$response = $dbh->prepare($sql);
	$response->bindValue(':hashSession', $_GET['hashSession'], PDO::PARAM_STR)
	$response->execute();
	echo rowCount($response);
	
	$sql = 'SELECT idProduct, quantity FROM ConsumerList WHERE hashSession = :hashSession';
	$response = $dbh->prepare($sql);
	$response->bindValue(':idLoglist', $_GET['idLoglist'], PDO::PARAM_INT);
	$response->execute();
	
	foreach($response as $elem)
	{
		echo json_encode($elem);
	}
}
?>
