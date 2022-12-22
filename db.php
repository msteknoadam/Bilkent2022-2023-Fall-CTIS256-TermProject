<?php

$dsn = "mysql:host=localhost;port=3306;dbname=ctis256;charset=utf8mb4";
$user = "std";
$pass = "";

try {
  $db = new PDO($dsn, $user, $pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
  gotoErrorPage();
}

function gotoErrorPage()
{
  header("Location: error.php");
  exit;
}