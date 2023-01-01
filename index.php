<?php
include_once "db.php";
include_once "session.php";

if (isset($_POST["logout"])) {
    unset($user);
    $_SESSION = [];
    session_abort();
    setcookie(session_name(), "", 1, "/");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php";?>
    <title>Home Page</title>
</head>
<body>

    <?php if (isset($user)): ?>
    <h1><a href="profile.php">Profile</a></h1>
    <h1><a href="createProject.php">Create Project</a></h1>
    <h1><a href="manageProjects.php">Manage Projects</a></h1>
    <br>
    <form action="" method="post">
        <center><input class="btn red" type="submit" value="Logout" name="logout"></center>
    </form>
    <?php else: ?>
    <h1><a href="login.php">Login</a></h1>
    <h1><a href="register.php">Register</a></h1>
    <?php endif;?>

<?php
if (!isset($user)) {
    include "viewProjects.php";
}
?>
</body>
</html>
