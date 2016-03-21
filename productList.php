<?php

require('dbConnexion.php');

if(isset($_GET['idLogList']))
{
	$sql = 'SELECT idProduct, quantity FROM ProductList WHERE idLogList = :idLogList';
	$response = $dbh->prepare($sql);
	$response->bindValue(':idLogList', $_GET['idLogList'], PDO::PARAM_INT);
	$response->execute();
	
	var_dump($response);
}

?>
