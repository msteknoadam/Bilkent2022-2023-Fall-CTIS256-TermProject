<?php include "db.php"; //require;
extract($_POST);
var_dump($_POST);
$errors = array();
if (isset($submit)) {
    if (!isset($email) || strlen(trim($email)) == 0) {
        $errors[] = "email_error";
    }
    if (!isset($username) || strlen(trim($username)) == 0) {
        $errors[] = "username_error";
    }
    if (!isset($password) || strlen(trim($password)) == 0) {
        $errors[] = "password_error";
    }
    if (!isset($userclass) || !in_array($userclass, array("firm", "instructor", "student"))) {
        $errors[] = "userclass_error";
    }

    if ($userclass == "firm") {
        if (!isset($firmname) || strlen(trim($firmname)) == 0) {
            $errors[] = "firmname_error";
        }
        if (!isset($city) || strlen(trim($city)) == 0) {
            $errors[] = "city_error";
        }
        if (!isset($district) || strlen(trim($district)) == 0) {
            $errors[] = "district_error";
        }
        if (!isset($address) || strlen(trim($address)) == 0) {
            $errors[] = "address_error";
        }
    } else {
        if (!isset($name) || strlen(trim($name)) == 0) {
            $errors[] = "name_error";
        }
    }

    if (sizeof($errors) == 0) {
        $email_stmt = $db->prepare("select * from users where email = ?");
        $email_stmt->execute([$email]);
        $email_user = $email_stmt->fetch();
        if ($email_user != false) {
            $errors[] = "email_taken";
        }

        $username_stmt = $db->prepare("select * from users where username = ?");
        $username_stmt->execute([$username]);
        $username_user = $username_stmt->fetch();
        if ($username_user != false) {
            $errors[] = "username_taken";
        }

        if ($email_taken == false && $username_taken == false) {
            $stmt = $db->prepare("INSERT INTO users (email,username,password,userclass,firmname,city,district,address,name) values (?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$email, $username, $password, $userclass, $firmname, $city, $district, $address, $name]);
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
                    <?=in_array("email_taken", $errors) ? "<h2 style='color:red'>This e-mail is already taken.</h2>" : ""?>
                    <?=in_array("username_taken", $errors) ? "<h2 style='color:red'>This username is already taken.</h2>" : ""?>
                    <form action="" method="post">
                        <p>Email: <?=in_array("email_error", $errors) ? "Please enter your email !!" : ""?></p>
                        <input type="email" name="email" placeholder="Enter your email">
                        <p>Username: <?=in_array("username_error", $errors) ? "Please enter your username !!" : ""?></p>
                        <input type="text" name="username" placeholder="Enter your username">
                        <p>Password: <?=in_array("password_error", $errors) ? "Please enter your password !!" : ""?> </p>
                        <input type="password" name="password">
                        <p>Account Type: <?=in_array("userclass_error", $errors) ? "Please select your account type !!" : ""?></p>
                        <select name="userclass" id="typeSelector">
                            <option value="firm" id="firmOption">Firm User</option>
                            <option value="instructor">Instructor User/Project Advisor User</option>
                            <option value="student">Student User</option>
                        </select>
                        <div id="firmInputs">
                            <p>Firm Name: <?=in_array("firmname_error", $errors) ? "Please enter your firm's name !!" : ""?> </p>
                            <input type="text" name="firmname">
                            <p>City: <?=in_array("city_error", $errors) ? "Please enter your firm's city !!" : ""?> </p>
                            <input type="text" name="city">
                            <p>District: <?=in_array("district_error", $errors) ? "Please enter your firm's district !!" : ""?> </p>
                            <input type="text" name="district">
                            <p>Address: <?=in_array("address_error", $errors) ? "Please enter your firm's address !!" : ""?> </p>
                            <input type="text" name="address">
                        </div>
                        <div id="nameInput">
                            <p>Name: <?=in_array("name_error", $errors) ? "Please enter your name !!" : ""?> </p>
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