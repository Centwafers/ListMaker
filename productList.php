<?php

require('dbConnexion.php');

if(isset($_GET['idLoglist']))
//if(isset($_GET['hashDeSession']))
{
	
	$sql = 'SELECT idProduct, quantity FROM ConsumerList WHERE idLoglist = :idLoglist';
	$response = $dbh->prepare($sql);
	$response->bindValue(':idLoglist', $_GET['idLoglist'], PDO::PARAM_INT);
	$response->execute();
	
	foreach($response as $elem)
	{
		echo json_encode($elem);
	}
}
?>
