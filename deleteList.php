<?php

  require('dbConnexion.php');
  
  $now = time();
  
  $sql = 'SELECT * FROM LogList';
  foreach($dbh->query($sql) as $row){
    $result = (time()-strtotime($row['lastUse']))/60/60/24;
    if($result>14)
    {
      $sqlDel = 'DELETE FROM LogList WHERE id = :id';
      $response = $dbh->prepare($sqlDel);
      $response->bindValue(':id', $row['id'], PDO::PARAM_INT);
      $response->execute();
      
      $sqlDel = 'DELETE FROM ConsumerList WHERE id = :id';
      $response = $dbh->prepare($sqlDel);
      $response->bindValue(':id', $row['id'], PDO::PARAM_INT);
      $response->execute();
    }
  }

  

?>
