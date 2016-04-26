<?php

require('dbConnexion.php');

if(isset($_GET['idLogList']))
//if(isset($_GET['hashDeSession']))
{
	$sql = 'SELECT idProduct, quantity FROM ProductList WHERE idLogList = :idLogList';
	$response = $dbh->prepare($sql);
	$response->bindValue(':idLogList', $_GET['idLogList'], PDO::PARAM_INT);
	$response->execute();
	
	foreach($response as $elem)
	{
		echo json_encode($elem);
	}
}

?>
