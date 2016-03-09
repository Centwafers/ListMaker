<?php
  require('dbConnexion.php');
  
  //test insert into
  $sql = 'INSERT INTO LogList(listName, password) VALUES(:listName, :password)';
		
	$response = $dbh->prepare($sql);
	$response->bindParam(':listName', 'unTest', PDO::PARAM_STR);
	$response->bindParam(':password', 'unTest', PDO::PARAM_STR);
	$response->execute();
	
?>
