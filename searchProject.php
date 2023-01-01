<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["status" => 400, "error" => "This endpoint only works with POST method."]);
    return;
}

include_once "db.php";
include_once "session.php";
extract($_POST);

$params = array();

$sql = "select * from projects where";

if (isset($project_name) && strlen(trim($project_name)) != 0) {
    $sql = $sql . " lower(name) like ?";
    $params[] = strtolower("%" . $project_name . "%");
}

if (isset($project_year) && strlen(trim($project_year)) != 0) {
    $sql = $sql . (sizeof($params) > 0 ? " and" : "") . " year=?";
    $params[] = $project_year;
}

if (isset($project_semester) && strlen(trim($project_semester)) != 0) {
    $sql = $sql . (sizeof($params) > 0 ? " and" : "") . " lower(semester)=lower(?)";
    $params[] = $project_semester;
}

if (isset($group_member_name) && strlen(trim($group_member_name)) != 0) {
    $sql = $sql . (sizeof($params) > 0 ? " and" : "") . " lower(members) like ?";
    $params[] = strtolower("%" . $group_member_name . "%");
}

if (isset($user)) {
    $sql = $sql . (sizeof($params) > 0 ? " and" : "") . " owner_uid=?";
    $params[] = $user["id"];
}

if (sizeof($params) == 0) {
    $sql = $sql . " 1"; // if no filters provided, select all rows
}

$sql = $sql . " order by year desc, semester desc";

$stmt = $db->prepare($sql);
$stmt->execute($params);
$projects = $stmt->fetchAll();

echo json_encode(["status" => 200, "projects" => $projects]);
return;
