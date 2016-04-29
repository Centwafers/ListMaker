<?php

  require('dbConnexion.php');
  
  echo time();
  
  echo strtotime('1998-07-12 22:30:00').'</br>';
  echo abs(time()-strtotime('1998-07-12 22:30:00')).'</br>';
  $sql = 'SELECT * FROM LogList';
  foreach($dbh->query($sql) as $row){
    echo $row['lastUse'].'</br>';
    echo strtotime($response['lastUse']).'</br></br>';
  }

  

?>
