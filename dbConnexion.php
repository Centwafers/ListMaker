<?php

  $host='mysql.hostinger.fr';
  $user='u632642010_root';
  $pass='stkl_helb';
  $db='u632642010_stkl';
  	
  $dsn = "mysql:host=$host;dbname=$db";
  	
  
  try 
  {
    	$dbh = new PDO($dsn, $user, $pass); //db handle
  } 
  catch (PDOException $e) 
  {
    	die( "Erreur ! : " . $e->getMessage() );
  }
  
	$sql = 'INSERT INTO LogList(listName, password) VALUES(:listName, :password)';
	
	$blabla = 'hahahahah';
	$response = $dbh->prepare($sql);
	$response->bindParam(':listName', $blabla, PDO::PARAM_STR, 80);
	$response->bindParam(':password', $blabla, PDO::PARAM_STR, 255);
	$response->execute();


?>
