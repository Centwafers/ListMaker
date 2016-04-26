<?php

require('dbConnexion.php');

//if(isset($_GET['idLoglist']))
if(isset($_GET['hashSession']))
{
	$sql = 'SELECT id, hashSession FROM LogList WHERE hashSession = :hashSession';
	$response = $dbh->prepare($sql);
	$response->bindValue(':hashSession', $_GET['hashSession'], PDO::PARAM_STR);
	$response->execute();
//	var_dump($response->rowCount());
	$response = $response->fetch();
	
//	var_dump($response);
	
	
	$sql = "SELECT idProduct, quantity FROM ConsumerList WHERE idLogList = :idLoglist";
	$response2 = $dbh->prepare($sql);
	$response2->bindValue(':idLoglist', $response['id'], PDO::PARAM_INT);
	$response2->execute();
	
	foreach($response2 as $elem)
	{
		
		$sql = "SELECT * FROM MarketList WHERE idProduct = :idProduct";
		$response3 = $dbh->prepare($sql);
		$response3->bindValue(':idProduct', $elem['idProduct'], PDO::PARAM_INT);
		$response3->execute();
		foreach($response3 as $elem2)
		{
			echo json_encode($elem2);
		}
	}
}
?>
