<?php

require('dbConnexion.php');

if(isset($_GET['idLogList']) && isset($_GET['idProduct']) && isset($_GET['quantity']) && isset($_GET['addedBy'])) {

  $sql = 'SELECT idProduct FROM MarketList WHERE idProduct = :idProduct';
  $response = $dbh->prepare($sql);
  $response->bindValue(':idProduct', $_GET['idProduct'], PDO::PARAM_INT);
  $response->execute();
  
  if($response->rowCount() === 1){
    $sql = "INSERT INTO ConsumerList VALUES(':idLogList', ':idProduct', '$_GET['quantity']', '$_GET['addedBy']')"
    $response = $dbh->prepare($sql);
    $response->bindValue(':idLogList', $_GET['idLogList'], PDO::PARAM_INT);
    $response->bindValue(':idProduct', $_GET['idProduct'], PDO::PARAM_INT);
    $response->bindValue(':quantity', $_GET['quantity'], PDO::PARAM_INT);
    $response->bindValue(':addedBy', $_GET['addedBy'], PDO::PARAM_INT);
    $response->execute();
    
    return true;
  }
  else{
    return false;
  }
}
?>
