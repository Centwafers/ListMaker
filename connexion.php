<?php
  require('dbConnexion.php');
  $msg = "fail";
  
  if(isset($_POST['listName']) && isset($_POST['password']))
  {	
   	$listName = $_POST['listName'];
   	$password = $_POST['password'];
   	$listName = htmlentities($listName);
   	$response=$dbh->prepare('SELECT listName, password FROM LogList WHERE listName = :listName AND password = :password');
   	$response->bindValue(':listName', $listName, PDO::PARAM_STR);
   	$response->bindValue(':password', $password, PDO::PARAM_STR);
    
    	$response->execute();
  
    	$data=$response->fetch();
  
   	if ($data['password'] == $password)
   	{
   			$msg="success";
   	}
  }
  echo $msg;
?>
