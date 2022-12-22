<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "header.php"; ?>

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
                    <form action="" method="post">
                        <p>Email: </p>
                        <input type="email" name="email" placeholder="Enter your email">
                        <p>Password: </p>
                        <input type="password" name="password">
                        <input class="inp" type="submit" name="submit">
                    </form>
                </div>
            </div>
        </div>

    </div>

</body>

</html>