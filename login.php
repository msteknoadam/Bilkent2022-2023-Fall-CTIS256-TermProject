<?php include "db.php"; //require;
extract($_POST);
$email_error = false;
$password_error = false;
$account_not_found_error = false;
if (isset($submit)) {
    if (!isset($email) || strlen(trim($email)) == 0) {
        $email_error = true;
    }
    if (!isset($password) || strlen(trim($password)) == 0) {
        $password_error = true;
    }

    if ($email_error == false && $password_error == false) {
        $stmt = $db->prepare("SELECT * FROM users WHERE email=? and password=?");
        $stmt->execute([$email, $password]);
        $user = $stmt->fetch();
        if ($user != false) {
            session_start();
            $_SESSION["user"] = ["id" => $user["id"]];
            header("Location: index.php");
        } else {
            $account_not_found_error = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include "header.php";?>
    <style>
        .inp {
            margin: auto;
            display: block;
        }
    </style>
</head>

<body>
    <h1>Welcome to Login Page</h1>
    <h3>Please fill the inputs</h3>

    <div class="row">
        <div class="col s12 m6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <?=($email_error == false && $password_error == false && $account_not_found_error == true) ? "<h2 style='color:red'>We couldn't find an account associated with your e-mail and password.</h2>" : ""?>
                    <form action="" method="post">
                        <p>Email: <?=$email_error ? "Please enter your email !!" : ""?></p>
                        <input type="email" name="email" placeholder="Enter your email">
                        <p>Password: <?=$password_error ? "Please enter your password !!" : ""?> </p>
                        <input type="password" name="password">
                        <input class="inp btn" type="submit" name="submit">
                    </form>
                </div>
            </div>
        </div>

    </div>

</body>

</html>