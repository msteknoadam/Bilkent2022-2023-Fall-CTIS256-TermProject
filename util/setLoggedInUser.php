<?php

include_once "db.php";

if (session_status() != 2) {
    session_start();
}

if (isset($_SESSION["user"]) && isset($_SESSION["user"]["id"])) {
    $user_stmt = $db->prepare("select * from users where id = ?");
    $user_stmt->execute([$_SESSION["user"]["id"]]);
    $user = $user_stmt->fetch();

    if ($user == false) {
        unset($user);
    }

}
