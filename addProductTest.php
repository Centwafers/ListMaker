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
    $response1 = $reponse1->fetch();
    
    $sql = "INSERT INTO ConsumerList VALUES(':idLogList', ':idProduct', ':quantity', ':addedBy')";
    $response = $dbh->prepare($sql);
    $response->bindValue(':idLogList', $response1['id'], PDO::PARAM_INT);
    $response->bindValue(':idProduct', $_GET['idProduct'], PDO::PARAM_INT);
    $response->bindValue(':quantity', $_GET['quantity'], PDO::PARAM_INT);
    $response->bindValue(':addedBy', $_GET['addedBy'], PDO::PARAM_INT);
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
