<?php
  require('dbConnexion.php');
  if(isset($_GET['listName']) && isset($_GET['password'])&& isset($_GET['password2']))
  {
    if($_GET['password'] == $_GET['password2'])
    {
      $listName = $_GET['listName'];
      $password = md5($_GET['password']);
      $listName = htmlentities($listName);
      $sql = 'SELECT listName FROM LogList WHERE listName=:listName';
      $response = $dbh->prepare($sql);
      $response->bindParam(':listName', $listName, PDO::PARAM_STR,80);
      $response->execute();
      if(count($response) === 0)
      {
        $sql = 'INSERT INTO LogList(listName, password) VALUES(:listName, :password))';
        $response = $dbh->prepare($sql);
        $response->bindParam(':listName', $listName, PDO::PARAM_STR, 80); 
        $response->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $response->execute();
        echo 'success';
      }
      else
      {
      echo 'Cette liste existe déjà';
      var_dump($response);
      }
    }
    else
    {
      echo 'Les mots de passe ne correspondent pas.';
    }
  }
  else
  {
    echo 'Un des champs n\'est pas correct';
  }
?>
