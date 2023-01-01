<?php
include_once "db.php";
include_once "session.php";

if (!isset($user)) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects</title>
    <?php include "header.php";?>
    <style>
    </style>
</head>
<body>
    <h1>Welcome to Project Management Page</h1>

    <?php
include_once "viewProjects.php";
?>
</body>
</html>