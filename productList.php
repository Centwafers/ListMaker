<?php

require('dbConnexion.php');

if(isset($_GET['idLogList']))
//if(isset($_GET['hashDeSession']))
{
	$sql = 'SELECT idProduct, quantity FROM ProductList WHERE idLoglist = :idLoglist';
	$response = $dbh->prepare($sql);
	$response->bindValue(':idLoglist', $_GET['idLogList'], PDO::PARAM_INT);
	$response->execute();
	
	foreach($response as $elem)
	{
		echo json_encode($elem);
	}
}
else
{
	echo 'testElse';
}
echo 'test';

?>
