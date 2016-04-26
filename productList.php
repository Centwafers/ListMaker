<?php

require('dbConnexion.php');
header("content-type:application/json");
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
		
		foreach($userList as $oneProduct)
		{
			
			$sql = "SELECT *,
				(SELECT `quantity` FROM `ConsumerList` WHERE `idLogList`=:idLogList AND `idProduct`=:idProduct) AS quantity
				FROM `MarketList` 
				WHERE `idProduct`=:idProduct";
			$userListDetails = $dbh->prepare($sql);
			$userListDetails->bindValue(':idProduct', $oneProduct['idProduct'], PDO::PARAM_INT);
			$userListDetails->bindValue(':idLogList', $user['id'], PDO::PARAM_INT);
			$userListDetails->execute();
			echo json_encode($userListDetails->fetchAll());
		/*	//$userListDetails=$userListDetails->fetchAll();
			//
			//echo json_encode($userListDetails->fetchAll(PDO::FETCH_NUM));

			//echo json_encode($userListDetails);
			
			$json = '{';
			$result = array();
			foreach($userListDetails as $oneDetails)
			{
				
				$json .= '"'.$oneDetails['idProduct'].'"'.':{'.
					'"idProduct":"'.$oneDetails['idProduct'].'",'.
					'"nameProduct":"'.$oneDetails['nameProduct'].'",'.
					'"type":"'.$oneDetails['type'].'",'.
					'"price":"'.$oneDetails['price'].'",'.
					'"unity":"'.$oneDetails['unity'].'",'.
					'"quantity":"'.$oneDetails['quantity'].'"'.
					'},';
					
			/*	$json .= '"'.$oneDetails['idProduct'].'"'.':';
				$array = array(
					'idProduct'	=>$oneDetails['idProduct'],
					'nameProduct'	=>$oneDetails['nameProduct'],
					'type'		=>$oneDetails['type'],
					'price'		=>$oneDetails['price'],
					'unity'		=>$oneDetails['unity'],
					'quantity'	=>$oneDetails['quantity']
				);
				 array_push($result,$array);*/
			//	$json .= ', ';
				
			}
			
	
		//	$json .= substr($json, 0, -1);
		//	echo '}';
//			echo $json;*/
		}
	}
}
?>
