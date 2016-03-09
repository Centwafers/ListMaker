<?php
  require('dbConnexion.php');
 $msg = "fail";
 if(isset($_GET['listName']) && isset($_GET['password']))
 {	
 		$msg = 'isset ok';
 		$listName = $_GET['listName'];
 		$password = $_GET['password'];
 		$listName = htmlentities($listname);
 		$response=$dbh->prepare('SELECT listName, password FROM LogList WHERE listName = :listName AND password = :password');
 		$response->bindValue(':listName', $listName, PDO::PARAM_STR);
 		$response->bindValue(':password', $password, PDO::PARAM_STR);
         	
         	$response->execute();
         
         	$data=$response->fetch();
         	
         	var_dump($data);
         	
 		if ($data['password'] == $password){
 			$msg="success";
 		}
 }
 echo $msg;
 
 
 ?>
