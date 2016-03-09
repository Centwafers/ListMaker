<?php
  require('dbConnexion.php');
  
  //test insert into
 // $sql = 'INSERT INTO LogList(listName, password) VALUES(:listName, :password)';
   $sql = "INSERT INTO LogList(listName, password) VALUES('unTest', 'unTest')";
	$dbh->query($sql);
	//$response = $dbh->prepare($sql);
	//$response->bindParam(':listName', 'unTest', PDO::PARAM_STR);
	//$response->bindParam(':password', 'unTest', PDO::PARAM_STR);
	//$response->execute();
	
	$sql= "SELECT 'listName' FROM LogList WHERE listName = 'unTest'";
	$response = $dbh->query($sql);
	echo $response;
	
?>
