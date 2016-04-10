<?php
  require('dbConnexion.php');
  require('test_input.php');
  $msg = "fail";
  
  if(isset($_POST['listName']) && isset($_POST['password']))
  {	
   	$listName = test_input($_POST['listName']);
   	$password = test_input($_POST['password']);
   	
   	$response=$dbh->prepare('SELECT listName, password FROM LogList WHERE listName = :listName AND password = :password');
   	$response->bindValue(':listName', $listName, PDO::PARAM_STR);
   	$response->bindValue(':password', $password, PDO::PARAM_STR);
    $response->execute();
    
    if($response->rowCount() == 1)
		{
		$val = $response->fetch();
		  $msg= $val['hashSession'];
		}
  
    /*
    $data=$response->fetch();
   	if ($data['password'] == $password)
   	{
   			$msg="success";
   	}
   	*/
  }
  echo $msg;
?>
