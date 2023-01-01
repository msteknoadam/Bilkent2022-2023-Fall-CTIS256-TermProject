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
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    $project_stmt = $db->prepare("select * from projects where id=?");
    $project_stmt->execute([$project_id]);
    $project = $project_stmt->fetch();

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    if (isset($update)) {
        $project_id = $_GET["project_id"];
    }

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

        if (isset($update)) {
            $stmt = $db->prepare("update projects set name=?,description=?,year=?,semester=?,requirements=?,required_software=?,required_hardware=?,members=? where id=?");
            $result = $stmt->execute([$name, $description, $year, $semester, $requirements, $required_software, $required_hardware, $members, $project_id]);
        }
    }

    header("Location: manageProjects.php");
}
?>

<?php if (isset($project)): ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <?php include_once "header.php"?>
</head>
<body>
    <h1>Edit Project</h1>

    <form action="" method="post">
        <table>
            <thead>
                <th>ID</th>
                <th>Project Name</th>
                <th>Project Description</th>
                <th>Project Year</th>
                <th>Project Semester</th>
                <th>Project Requirements</th>
                <th>Project State</th>
                <th>Required Software</th>
                <th>Required Hardware</th>
                <th>Group Members</th>
            </thead>
            <tbody>
                <tr>
                    <td><?=$project["id"]?></td>
                    <td><input type="text" name="name" value="<?=$project["name"]?>"></td>
                    <td><textarea type="text" name="description"><?=$project["description"]?></textarea></td>
                    <td><input type="text" name="year" value="<?=$project["year"]?>"></td>
                    <td><input type="text" name="semester" value="<?=$project["semester"]?>"></td>
                    <td><textarea type="text" name="requirements"><?=$project["requirements"]?></textarea></td>
                    <td><?=$project["state"]?></td>
                    <td><textarea type="text" name="required_software"><?=$project["required_software"]?></textarea></td>
                    <td><textarea type="text" name="required_hardware"><?=$project["required_hardware"]?></textarea></td>
                    <td><textarea type="text" name="members"><?=$project["members"]?></textarea></td>
                </tr>
            </tbody>
        </table>
        <br>
        <center><input class="btn" type="submit" name="update" value="Update Project Details"></center>
    </form>
</body>
</html>
<?php endif;?>