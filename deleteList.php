<?php

  require('dbConnexion.php');
  
  $now = time();
  
  $sql = 'SELECT * FROM LogList';
  foreach($dbh->query($sql) as $row){
    $result = (time()-strtotime($row['lastUse']))/60/60/24;
    if($result>14)
    {
      $sqlDel = 'DELETE FROM LogList WHERE id = :id';
      $response = $dbh->prepare();
      $response->bindValue(':id', $row['id']);
      $response->execute();
      
      $sqlDel = 'DELETE FROM ConsumerList WHERE id = :id';
      $response = $dbh->prepare();
      $response->bindValue(':id', $row['id']);
      $response->execute();
    }
  }

  

?>
