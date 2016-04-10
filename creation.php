<?php
require('dbConnexion.php');
require('test_input.php');
 
if(isset($_POST['listName']) && isset($_POST['password'])&& isset($_POST['password2']))
{
	if($_POST['password'] == $_POST['password2'])
	{
		$listName = $_POST['listName'];
		$password = md5($_POST['password']);
		
		$listName = test_input($listName);
		
		$sql = 'SELECT listName FROM LogList WHERE listName=:listName';
		$response = $dbh->prepare($sql);
		$response->bindParam(':listName', $listName, PDO::PARAM_STR,80);
		$response->execute();
		
		if($response->rowCount() === 0)
		{
			$sql = 'INSERT INTO LogList(listName, password, hashSession) VALUES(:listName, :password, :hash)';
		
			$response = $dbh->prepare($sql);
			$response->bindParam(':listName', $listName, PDO::PARAM_STR, 80);
			$response->bindParam(':password', $password, PDO::PARAM_STR, 255);
			$hash = md5('STKL20/20'.$listname);
			$response->bindParam(':hash', $hash, PDO::PARAM_STR, 255);
			$response->execute();
			echo 'success';
		}
		else
		{
			echo 'Cette liste existe déjà';
		}
	}
	else
	{
		echo 'Les mots de passe ne correspondent pas.';
	}
}
else
{
	echo 'Un des champs n\'est pas correct';
}

?>
