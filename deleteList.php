<?php

  require('dbConnexion.php');
  
  echo time();
  
  echo strtotime('1998-07-12 22:30:00').'</br>';
  echo abs(time()-strtotime('1998-07-12 22:30:00')).'</br>';
  $sql = 'SELECT * FROM LogList';
  $dbh->prepare($sql);
  $response=$dbh->execute();
  $reponse = $response->fetch();
  echo $reponse['lastUse'].'</br>';
  echo strtotime($reponse['lastUse']).'</br>';

?>
