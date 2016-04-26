<?php

require('dbConnexion.php');

if(isset($_GET['hashSession']) && isset($_GET['idProduct']) && isset($_GET['quantity']) && isset($_GET['addedBy'])) {

  $sql = 'SELECT id, hashSession FROM LogList WHERE hashSession = :hashSession';
  $response1 = $dbh->prepare($sql);
  $response1->bindValue(':hashSession', $_GET['hashSession']);
  $response1->execute();
  
  $sql = 'SELECT idProduct FROM MarketList WHERE idProduct = :idProduct';
  $response = $dbh->prepare($sql);
  $response->bindValue(':idProduct', $_GET['idProduct'], PDO::PARAM_INT);
  $response->execute();
  
  if($response1->rowCount()===1 && $response->rowCount()===1)
  {
    $response1 = $response1->fetch();
    echo $response1['id'].' '.$_GET['idProduct'].' '.$_GET['quantity'].' '.$_GET['addedBy'];
    $sql = "INSERT INTO ConsumerList ('idLogList', 'idProduct', 'quantity', 'addedBy') VALUES(':idLogList', ':idProduct', ':quantity', ':addedBy')";
    $response = $dbh->prepare($sql);
    $response->bindParam(':idLogList', $response1['id']);
    $response->bindParam(':idProduct', $_GET['idProduct']);
    $response->bindParam(':quantity', $_GET['quantity']);
    $response->bindParam(':addedBy', $_GET['addedBy']);
    $response->execute();
  }
  else
  {
    echo 'produit ou compte inexistant';
  }
}
else
{
  echo 'getPasOk';
}
?>
