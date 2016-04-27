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
    echo $response1['id'].' '.$_GET['idProduct'].' '.$_GET['quantity'].' '.$_GET['addedBy'].'</br>';
    //$sql = "INSERT INTO 'ConsumerList' VALUES(':idLogList', ':idProduct', ':quantity', ':addedBy')";
    $sql = "INSERT INTO `ConsumerList`(`idLoglist`, `idProduct`, `quantity`, `addedBy`) 
            VALUES (:idLogList,:idProduct,:quantity,:addedBy)";
    $response = $dbh->prepare($sql);
    $response->bindValue(':idLogList', $response1['id']);
    $response->bindValue(':idProduct', $_GET['idProduct']);
    $response->bindValue(':quantity', $_GET['quantity']);
    $response->bindValue(':addedBy', $_GET['addedBy']);
    echo $response1['id'].' '.$_GET['idProduct'].' '.$_GET['quantity'].' '.$_GET['addedBy'].'</br>';
    echo $response->execute();
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
