<?php
require('dbConnexion.php');
 
if(isset($_POST['listName']) && isset($_POST['password'])&& isset($_POST['password2']))
{
	if($_POST['password'] == $_POST['password2'])
	{
		$listName = $_POST['listName'];
		$password = md5($_POST['password']);
		
		$listName = htmlentities($listName);
		
		$sql = 'SELECT listName FROM LogList WHERE listName=:listName';
		$response = $dbh->prepare($sql);
		$response->bindParam(':listName', $listName, PDO::PARAM_STR,80);
		$response->execute();
		
		if(count($response) === 0)
		{
			$sql = 'INSERT INTO LogList(listName, password) VALUES(:listName, :password)';
		
			$response = $dbh->prepare($sql);
			$response->bindParam(':listName', $listName, PDO::PARAM_STR, 80);
			$response->bindParam(':password', $password, PDO::PARAM_STR, 255);
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
