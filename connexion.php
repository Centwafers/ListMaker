<?php
	require 'dbConnexion.php';
	$stmt = $dbh->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
		$stmt->bindParam('username',"test",PDO::PARAM_STR,20);
		$stmt->bindParam('password',"test",PDO::PARAM_STR,20);
		$stmt->execute();
		
		if($stmt->rowCount() == 1)
		{
			echo 'success';
		}
		else
		{
			echo 'fail';
		}
?>
