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
		
		foreach($userList as $oneProduct)
		{
			
			$sql = "SELECT *,
				(SELECT `quantity` FROM `ConsumerList` WHERE `idLogList`=:idLogList AND `idProduct`=:idProduct) 
				FROM `MarketList` 
				WHERE `idProduct`=:idProduct";
			$userListDetails = $dbh->prepare($sql);
			$userListDetails->bindValue(':idProduct', $oneProduct['idProduct'], PDO::PARAM_INT);
			$userListDetails->bindValue(':idLogList', $user['id'], PDO::PARAM_INT);
			$userListDetails->execute();
			
			//$userListDetails=$userListDetails->fetchAll();
			//header("content-type:application/json");
			//echo json_encode($userListDetails->fetchAll(PDO::FETCH_NUM));

			//echo json_encode($userListDetails);
			
			echo '{';
			$result = array();
			foreach($userListDetails as $oneDetails)
			{
				
				echo '"'.$oneDetails['idProduct'].'"'.':{'.
					'"idProduct":"'.$oneDetails['idProduct'].'",'.
					'"nameProduct":"'.$oneDetails['nameProduct'].'",'.
					'"type":"'.$oneDetails['type'].'",'.
					'"price":"'.$oneDetails['price'].'",'.
					'"unity":"'.$oneDetails['unity'].'",'.
					'"quantity":"'.$oneDetails['quantity'].'"'.
					'},';
				//if(strlen($json)>1)$json = substr($json, 0, -1);
				//rtrim($json, ",");
			//	rtrim($json, "}");
			//	$json .= '"'.$oneDetails['idProduct'].'"'.':';
			/*	$array = array(
					'idProduct'	=>$oneDetails['idProduct'],
					'nameProduct'	=>$oneDetails['nameProduct'],
					'type'		=>$oneDetails['type'],
					'price'		=>$oneDetails['price'],
					'unity'		=>$oneDetails['unity'],
					'quantity'	=>$oneDetails['quantity']
				);
				 array_push($result,$array);*/
			//	$json .= json_encode($array, JSON_PRETTY_PRINT);
			//	rtrim($json, ",");
			//	rtrim($json, "}");
			//	$json .= ', ';
				
			}
			//echo json_encode($result);
	//	rtrim($json, "}");
		//	$json = substr($json, 0, -1);
		//	rtrim($json, ",");
			echo '}';
//			echo $json;
		}
	}
}
?>
