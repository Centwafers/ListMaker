<?php
  require('bdConnexion.php');
  
  //test insert into
  $sql = 'INSERT INTO LogList(listName, password) VALUES(:listName, :password))';
		
	$response = $dbh->prepare($sql);
	$response->bindParam(':listName', unTest, PDO::PARAM_STR, 80);
	$response->bindParam(':password', unTest, PDO::PARAM_STR, 255);
	$response->execute();
	
?>
