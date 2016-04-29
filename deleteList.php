<?php

  require('dbConnexion.php');
  
  echo time();
  
  echo strtotime('1998-07-12 22:30:00').'</br>';
  echo abs(time()-strtotime('1998-07-12 22:30:00')).'</br>';
  $sql = 'SELECT * FROM LogList';
  $response = $dbh->query($sql);
  $response = $reponse->fetch();
  echo $response['lastUse'].'</br>';
  echo strtotime($response['lastUse']).'</br>';

?>
