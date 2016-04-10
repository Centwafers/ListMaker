<?php
  require('dbConnexion.php');
  require('test_input.php');
  $msg = "fail";
  
  if(isset($_GET['listName']) && isset($_GET['password']))
  {	
   	$listName = test_input($_GET['listName']);
   	$password = test_input($_GET['password']);
   	
   	$response=$dbh->prepare('SELECT * FROM LogList WHERE listName = :listName AND password = :password');
   	$response->bindValue(':listName', $listName, PDO::PARAM_STR);
   	$response->bindValue(':password', $password, PDO::PARAM_STR);
    $response->execute();
    
    if($response->rowCount() == 1)
		{
			var_dump($response);
		$val = $response->fetch();
		var_dump($val);
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
