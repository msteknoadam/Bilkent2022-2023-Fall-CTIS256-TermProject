<?php

include_once "db.php";
include_once "session.php";

if (!isset($user)) {
    header("Location: login.php");
    return;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    extract($_GET);

    if (isset($project_id)) {
        $stmt = $db->prepare("delete from projects where id=? and owner_uid=?");
        $stmt->execute([$project_id, $user["id"]]);
    }
}

header("Location: manageProjects.php");
