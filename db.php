<?php

$dsn = "mysql:host=localhost;port=3306;dbname=ctis256;charset=utf8mb4";
$mysql_user = "std";
$mysql_pass = "";

try {
    $db = new PDO($dsn, $mysql_user, $mysql_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    gotoErrorPage();
}

function gotoErrorPage()
{
    header("Location: error.php");
    exit;
}
