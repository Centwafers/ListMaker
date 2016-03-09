<?php
 require('dbConnexion.php');
$msg = "fail";
if(isset($_GET['listName']) && isset($_GET['password']))
{	
		$listName = $_POST['listName'];
		$password = md5($_POST['password']);
		$listName = htmlentities($listname);
		$response=$dbh->prepare('SELECT listName,password FROM LogList WHERE listName = :listName AND password = :password');
		$response->bindParam(':listName', $listName, PDO::PARAM_STR, 80);
		$response->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $response->execute();
        $data=$response->fetch();
			if ($data['password'] == $password){
				$msg="success";
			}
}
echo $msg;


?>
