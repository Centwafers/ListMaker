<?php
 require('dbConnexion.php');
 
if(isset($_POST['listName']) && isset($_POST['password'])&& isset($_POST['password2']))
{
	if($_POST['password'] == $_POST['password2'])
	{
		$listName = $_POST['listName'];
		$password = md5($_POST['password']);
		
		$listName = htmlentities($listname);
		
		$sql = 'INSERT INTO LogList(listName, password) VALUES(:listName, :password))';
	
		$response = $dbh->prepare($sql);
		$response->bindParam(':listName', $listName, PDO::PARAM_STR, 80);
		$response->bindParam(':password', $password, PDO::PARAM_STR, 255);
		$response->execute();
	}
	else
	{
		echo 'Les mots de passe ne correspondent pas.';
		header('Location: connexion.html');
	}
}
else
{
	echo 'Un des champs n\'est pas correct';
	header('Location: connexion.html');
}

?>
