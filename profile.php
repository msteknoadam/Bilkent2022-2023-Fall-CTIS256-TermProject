<?php

include_once "db.php";
include_once "session.php";

if (!isset($user)) {
    header("Location login.php");
    return;
}

if (isset($_POST["update"])) {
    extract($_POST);

    if ($user["userclass"] == "firm") {

    } else {
        $stmt = $db->prepare("update users set email=?,username=?,password=?,name=? where id=?");
        $result = $stmt->execute([$email, $username, $password, $name, $user["id"]]);
    }

    $user_stmt = $db->prepare("select * from users where id=?");
    $user_stmt->execute([$user["id"]]);
    $user = $user_stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php include_once "header.php"?>
</head>
<body>
    <h1>Profile Details</h1>

    <form action="" method="post">
        <table>
            <thead>
                <th>ID</th>
                <th>E-Mail</th>
                <th>Username</th>
                <th>Password</th>
                <th>Userclass</th>
                <?php if ($user["userclass"] == "firm"): ?>
                <th>Firm Name</th>
                <th>City</th>
                <th>District</th>
                <th>Address</th>
                <?php else: ?>
                <th>Name</th>
                <?php endif;?>
            </thead>
            <tbody>
                <tr>
                    <td><?=$user["id"]?></td>
                    <td><input type="email" name="email" value="<?=$user["email"]?>"></td>
                    <td><input type="text" name="username" value="<?=$user["username"]?>"></td>
                    <td><input type="text" name="password" value="<?=$user["password"]?>"></td>
                    <td><?=$user["userclass"]?></td>
                    <?php if ($user["userclass"] == "firm"): ?>
                    <td><input type="text" name="firmname" value="<?=$user["firmname"]?>"></td>
                    <td><input type="text" name="city" value="<?=$user["city"]?>"></td>
                    <td><input type="text" name="district" value="<?=$user["district"]?>"></td>
                    <td><input type="text" name="address" value="<?=$user["address"]?>"></td>
                    <?php else: ?>
                    <td><input type="text" name="name" value="<?=$user["name"]?>"></td>
                    <?php endif;?>
                </tr>
            </tbody>
        </table>
        <br>
        <center><input class="btn" type="submit" name="update" value="Update Profile Data"></center>
    </form>
</body>
</html>
