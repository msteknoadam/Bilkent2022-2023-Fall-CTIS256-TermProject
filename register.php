<?php include "db.php"; //require;
extract($_POST);
$email_error = false;
$username_error = false;
$password_error = false;
$userclass_error = false;
$firmname_error = false;
$city_error = false;
$district_error = false;
$address_error = false;
$name_error = false;
$email_taken = false;
$username_taken = false;
if (isset($submit)) {
    if (!isset($email) || strlen(trim($email)) == 0) {
        $email_error = true;
    }
    if (!isset($username) || strlen(trim($username)) == 0) {
        $username_error = true;
    }
    if (!isset($password) || strlen(trim($password)) == 0) {
        $password_error = true;
    }
    if (!isset($userclass) || in_array($userclass, array("firm", "instructor", "student"))) {
        $userclass_error = true;
    }

    if ($userclass == "firm") {
        if (!isset($firmname) || strlen(trim($firmname)) == 0) {
            $firmname_error = true;
        }
        if (!isset($city) || strlen(trim($city)) == 0) {
            $city_error = true;
        }
        if (!isset($district) || strlen(trim($district)) == 0) {
            $district_error = true;
        }
        if (!isset($address) || strlen(trim($address)) == 0) {
            $address_error = true;
        }
    } else {
        if (!isset($name) || strlen(trim($name)) == 0) {
            $name_error = true;
        }
    }

    if ($email_error == false && $username_error == false && $password_error == false) {
        $email_stmt = $db->prepare("select * from users where email = ?");
        $email_stmt->execute([$email]);
        $email_user = $email_stmt->fetch();
        if ($email_user != false) {
            $email_taken = true;
        }

        $username_stmt = $db->prepare("select * from users where username = ?");
        $username_stmt->execute([$username]);
        $username_user = $username_stmt->fetch();
        if ($username_user != false) {
            $username_taken = true;
        }

        if ($email_taken == false && $username_taken == false) {
            $stmt = $db->prepare("INSERT INTO users (email,username,password,userclass) values (?,?,?,?)");
            $stmt->execute([$email, $username, $password, $userclass]);
            $userid = (int) $db->lastInsertId();
            session_start();
            $_SESSION["user"] = ["id" => $userid];
            header("Location: index.php");
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
    <title>Register</title>
    <?php include "header.php";?>
    <style>
        .inp {
            margin: auto;
            display: block;
        }
        #typeSelector {
            display: block;
        }
    </style>
</head>

<body>
    <h1>Welcome to Register Page</h1>
    <h3>Please fill the inputs</h3>

    <div class="row">
        <div class="col s12 m6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <?=$email_taken == true ? "<h2 style='color:red'>This e-mail is already taken.</h2>" : ""?>
                    <?=$username_taken == true ? "<h2 style='color:red'>This username is already taken.</h2>" : ""?>
                    <form action="" method="post">
                        <p>Email: <?=$email_error ? "Please enter your email !!" : ""?></p>
                        <input type="email" name="email" placeholder="Enter your email">
                        <p>Username: <?=$username_error ? "Please enter your username !!" : ""?></p>
                        <input type="text" name="username" placeholder="Enter your username">
                        <p>Password: <?=$password_error ? "Please enter your password !!" : ""?> </p>
                        <input type="password" name="password">
                        <p>Account Type: <?=$userclass_error ? "Please select your account type !!" : ""?></p>
                        <select name="userclass" id="typeSelector">
                            <option value="firm" id="firmOption">Firm User</option>
                            <option value="instructor">Instructor User/Project Advisor User</option>
                            <option value="student">Student User</option>
                        </select>
                        <div id="firmInputs">
                            <p>Firm Name: <?=$firmname_error ? "Please enter your firm's name !!" : ""?> </p>
                            <input type="text" name="firmname">
                            <p>City: <?=$city_error ? "Please enter your firm's city !!" : ""?> </p>
                            <input type="text" name="city">
                            <p>District: <?=$district_error ? "Please enter your firm's district !!" : ""?> </p>
                            <input type="text" name="district">
                            <p>Address: <?=$address_error ? "Please enter your firm's address !!" : ""?> </p>
                            <input type="text" name="address">
                        </div>
                        <div id="nameInput">
                            <p>Name: <?=$name_error ? "Please enter your name !!" : ""?> </p>
                            <input type="text" name="name">
                        </div>
                        <input class="inp" type="submit" name="submit">
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="assets/js/register.js"></script>
</body>

</html>