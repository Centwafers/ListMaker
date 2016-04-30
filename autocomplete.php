<?php
require('dbConnexion.php');
header("Access-Control-Allow-Origin: *");
if (!isset($_GET['keyword'])) {
	die();
}else{
$keyword = $_GET['keyword'];
	$stmt = $dbh->prepare("SELECT id,nameProduct FROM `MarketList` WHERE nameProduct LIKE ?");

    $keyword = $keyword . '%';
    $stmt->bindParam(1, $keyword, PDO::PARAM_STR, 100);
    $isQueryOk = $stmt->execute();
  
    $results = array();
    
    if ($isQueryOk) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
      trigger_error('Error executing statement.', E_USER_ERROR);
    }


    $data =$results;


echo json_encode($data);
}
?>
