<?php

require('dbConnexion.php');

if(isset($_GET['hashSession']))
{
	$sql = 'SELECT id, hashSession FROM LogList WHERE hashSession = :hashSession';
	$user = $dbh->prepare($sql);
	$user->bindValue(':hashSession', $_GET['hashSession'], PDO::PARAM_STR);
	$user->execute();
	if($user->rowCount()===1)
	{
		$user = $user->fetch();
		
		$sql = "SELECT idProduct, quantity FROM ConsumerList WHERE idLogList = :idLoglist";
		$userList = $dbh->prepare($sql);
		$userList->bindValue(':idLoglist', $user['id'], PDO::PARAM_INT);
		$userList->execute();
		$json ='';
		$json = '{';
	
		foreach($userList as $oneProduct)
		{
			
			$sql = "SELECT *,
				(SELECT `quantity` FROM `ConsumerList` WHERE `idLogList`=:idLogList AND `idProduct`=:idProduct) AS `quantity`
				FROM `MarketList` 
				WHERE `idProduct`=:idProduct";
			$userListDetails = $dbh->prepare($sql);
			$userListDetails->bindValue(':idProduct', $oneProduct['idProduct'], PDO::PARAM_INT);
			$userListDetails->bindValue(':idLogList', $user['id'], PDO::PARAM_INT);
			$userListDetails->execute();
			
			foreach($userListDetails as $oneDetails)
			{

				echo $oneDetails['idProduct'];
				$json .= '"'.$oneDetails['idProduct'].'"'.':';
				$array = array(
					'idProduct'	=>$oneDetails['idProduct'],
					'nameProduct'	=>$oneDetails['nameProduct'],
					'type'		=>$oneDetails['type'],
					'price'		=>$oneDetails['price'],
					'unity'		=>$oneDetails['unity'],
					'quantity'	=>$oneDetails['quantity']
				);
				$json .= json_encode($array);
				$json .= ', tralala';
				
			}
			//$json .= substr($json, 0, -1);
		}
		$json .= '}';
		echo $json;
	}
}
?>
