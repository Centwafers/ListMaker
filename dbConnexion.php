<?php
$host = 'localhost';
$user = 'u632642010_root';

$pass = '';
$db   = 'u632642010_stkl';

$dsn = "mysql:host=$host;dbname=$db";

try {
    $dbh = new PDO($dsn, $user, $pass); //db handle
}
catch (PDOException $e) {
    die("Erreur ! : " . $e->getMessage());
}
?>
