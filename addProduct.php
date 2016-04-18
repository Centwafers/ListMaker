<?php
//Pas fini!!!
require('dbConnexion.php');

if(isset($_GET['idLogList']) && isset($_GET['idProduct'])) {

  $sql = 'SELECT idProduct FROM MarketList WHERE idProduct = :idProduct';
  $response = $dbh->prepare($sql);
  $response->bindValue(':idProduct', $_GET['idProduct'], PDO::PARAM_INT);
  $response->execute();
  
  
	$sql = 'SELECT idProduct, quantity FROM ConsumerList WHERE idLogList = :idLogList';
	$response = $dbh->prepare($sql);
	$response->bindValue(':idLogList', $_GET['idLogList'], PDO::PARAM_INT);
	$response->execute();
	
	foreach($response as $elem)
	{
		echo json_encode($elem);
	}
}

?>
