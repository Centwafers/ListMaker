<?php
  require('dbConnexion.php');
  
  //test insert into
 // $sql = 'INSERT INTO LogList(listName, password) VALUES(:listName, :password)';
   $sql = "INSERT INTO LogList(listName, password) VALUES(:listName, :password)";
	//$dbh->query($sql);
	$response = $dbh->prepare($sql);
	$response->bindParam(':listName', 'unnveoviTest', PDO::PARAM_STR);
	$response->bindParam(':password', 'unTefnzpest', PDO::PARAM_STR);
	$response->execute();
	
	//$sql= "SELECT 'listName' FROM LogList WHERE listName = 'unTest'";
	//$response = $dbh->query($sql);
	//$result = $response->fetch();
	//echo $result['listName'];
	//var_dump($result);
	
?>
