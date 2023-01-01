<?php

include_once "db.php";
include_once "session.php";

if (!isset($user)) {
    header("Location: login.php");
    return;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // show page with editing input fields etc.
    extract($_GET);

    if (!isset($project_id)) {
        return;
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    if (isset($project_id)) {
        if (isset($acceptBtn)) {
            $newState = "accepted";
        } else if (isset($rejectBtn)) {
            $newState = "rejected";
        }

        if (isset($newState)) {
            $stmt = $db->prepare("update projects set state=? where id=?");
            $stmt->execute([$newState, $project_id]);
        }
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
}
