<?php
  require('dbConnexion.php');
  
  //test insert into
 // $sql = 'INSERT INTO LogList(listName, password) VALUES(:listName, :password)';
   $sql = "INSERT INTO LogList(listName, password) VALUES(:listName, :password)";
	//$dbh->query($sql);
	$response = $dbh->prepare($sql);
	$var1 = 'unnveoviTest';
	$var2 ='unTefnzpest';
	$response->bindParam(':listName', $var1, PDO::PARAM_STR);
	$response->bindParam(':password',$var2 , PDO::PARAM_STR);
	$response->execute();
	
	//$sql= "SELECT 'listName' FROM LogList WHERE listName = 'unTest'";
	//$response = $dbh->query($sql);
	//$result = $response->fetch();
	//echo $result['listName'];
	//var_dump($result);
	
?>
