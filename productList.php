<?php

require('dbConnexion.php');

if(isset($_GET['hashSession']))
{
	$sql = 'SELECT id, hashSession FROM LogList WHERE hashSession = :hashSession';
	$user = $dbh->prepare($sql);
	$user->bindValue(':hashSession', $_GET['hashSession'], PDO::PARAM_STR);
	$user->execute();
	$user = $user->fetch();
	
	$sql = "SELECT idProduct, quantity FROM ConsumerList WHERE idLogList = :idLoglist";
	$userList = $dbh->prepare($sql);
	$userList->bindValue(':idLoglist', $user['id'], PDO::PARAM_INT);
	$userList->execute();
	
	foreach($userList as $oneProduct)
	{
		
		$sql = "SELECT * FROM MarketList WHERE idProduct = :idProduct";
		$userListDetails = $dbh->prepare($sql);
		$userListDetails->bindValue(':idProduct', $oneProduct['idProduct'], PDO::PARAM_INT);
		$userListDetails->execute();
		foreach($userListDetails as $oneDetails)
		{
			echo json_encode($oneDetails);
		}
	}
}
?>
