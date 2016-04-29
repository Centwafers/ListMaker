<?php

  require('dbConnexion.php');
  
  $now = time();
  
  $sql = 'SELECT * FROM LogList';
  foreach($dbh->query($sql) as $row){
    $result = (time()-strtotime($row['lastUse']))/60/60/24;
    if($result>14)
    {
      echo $row['id'];
      echo strtotime($row['lastUse']).'</br></br>';
    }
  }

  

?>
