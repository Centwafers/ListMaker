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
?>
