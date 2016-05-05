<?php
function testInput($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
function testMd5($data)
{
    define('R_MD5_MATCH', '/^[a-f0-9]{32}$/i');
    return preg_match(R_MD5_MATCH, $data);
}
?>
