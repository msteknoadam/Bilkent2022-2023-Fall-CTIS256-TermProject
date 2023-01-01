<?php
include_once "db.php";
include_once "session.php";

if (isset($_POST["logout"])) {
    unset($user);
    $_SESSION = [];
    session_abort();
    setcookie(session_name(), "", 1, "/");
}

if (!isset($user)) {
    $projects_stmt = $db->prepare("select * from projects order by year desc");
    $projects_stmt->execute();
    $projects = $projects_stmt->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1><a href="login.php">Login</a></h1>
    <h1><a href="register.php">Register</a></h1>

    <?php if (isset($user)): ?>
    <h1><a href="profile.php">Profile</a></h1>
    <form action="" method="post">
        <input type="submit" value="Logout" name="logout">
    </form>
    <?php endif;?>

    <?php
if (isset($user)) {
    var_dump($user);
}
?>

    <?php if (isset($projects)): ?>
        <?php if (sizeof($projects) > 0): ?>
        <table>
            <thead>
                <th>Project Name</th>
                <th>Project Description</th>
                <th>Project Year</th>
                <th>Project Semester</th>
                <th>Project Requirements</th>
                <th>Project State</th>
                <th>Required Softwares</th>
                <th>Required Hardware</th>
                <th>Group Members</th>
            </thead>
            <tbody>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?=$project["name"]?></td>
                    <td><?=$project["description"]?></td>
                    <td><?=$project["year"]?></td>
                    <td><?=$project["semester"]?></td>
                    <td><?=$project["requirements"]?></td>
                    <td><?=$project["state"]?></td>
                    <td><?=$project["required_software"]?></td>
                    <td><?=$project["required_hardware"]?></td>
                    <td><?=$project["members"]?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php else: ?>
        <h1>No Projects Added Yet!</h1>
        <?php endif;?>
    <?php endif;?>
</body>
</html>
