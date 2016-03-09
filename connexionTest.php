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
 		$response->bindParam(':listName', $listName, PDO::PARAM_STR, 80);
 		$response->bindParam(':password', $password, PDO::PARAM_STR, 255);
         	
         	$response->execute();
         	$data=$response->fetch();
         	
         	var_dump($data);
         	var_dump($response);
 		if ($data['password'] == $password){
 			$msg="success";
 		}
 }
 echo $msg;
 
 
 ?>
