<?php

require('dbConnexion.php');

if(isset($_GET['hashSession']) && isset($_GET['idProduct']) && isset($_GET['quantity']) && isset($_GET['addedBy'])) {

  $sql = 'SELECT id, hashSession FROM LogList WHERE hashSession = :hashSession';
  $user = $dbh->prepare($sql);
  $user->bindValue(':hashSession', $_GET['hashSession']);
  $user->execute();
  
  $sql = 'SELECT idProduct FROM MarketList WHERE idProduct = :idProduct';
  $product = $dbh->prepare($sql);
  $product->bindValue(':idProduct', $_GET['idProduct'], PDO::PARAM_INT);
  $product->execute();
  
  if($user->rowCount()===1 && $product->rowCount()===1)
  {
    $user = $user->fetch();
    $sql = "INSERT INTO `ConsumerList`(`idLoglist`, `idProduct`, `quantity`, `addedBy`) 
            VALUES (:idLogList,:idProduct,:quantity,:addedBy)";
    $product = $dbh->prepare($sql);
    $product->bindValue(':idLogList', $user['id']);
    $product->bindValue(':idProduct', $_GET['idProduct']);
    $product->bindValue(':quantity', $_GET['quantity']);
    $product->bindValue(':addedBy', $_GET['addedBy']);
    echo $user['id'].' '.$_GET['idProduct'].' '.$_GET['quantity'].' '.$_GET['addedBy'].'</br>';
    $product->execute();
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
