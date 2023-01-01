<?php 
include_once "db.php";
include_once "session.php"; 

if(!isset($user)){
    header("Location: login.php");
}
//require;
extract($_POST);
$errors = array();
if (isset($submit)) {
    if (!isset($projectname) || strlen(trim($projectname)) == 0) {
        $errors[] = "projectname_error";
    }
    if (!isset($projectdescription) || strlen(trim($projectdescription)) == 0) {
        $errors[] = "projectdescription_error";
    }
    if (!isset($semester) || strlen(trim($semester)) == 0) {
        $errors[] = "semester_error";
    }
    if (!isset($requirement) || strlen(trim($requirement)) == 0) {
        $errors[] = "requirement_error";
    }
    if (!isset($software) || strlen(trim($software)) == 0) {
        $errors[] = "software_error";
    }
    if (!isset($hardware) || strlen(trim($hardware)) == 0) {
        $errors[] = "hardware_error";
    }
    if (!isset($members) || strlen(trim($members)) == 0) {
        $errors[] = "members_error";
    }

    if (sizeof($errors) == 0) {
        $currYear = (int) date("Y/m/d");
        $year = $currYear . "-" . ($currYear + 1);
        $stmt = $db->prepare("INSERT INTO projects (name,description,year,semester,requirements,state,required_software,required_hardware,members) values (?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$projectname, $projectdescription, $year, $semester, $requirement, "waiting", $software, $hardware, $members]);
        header("Location: index.php");
           
    }
    
}
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
            display: block;
        }
    </style>
</head>
<body>
    <h1>Welcome to Project Page</h1>
    <h3>Please Write Your Project Details</h3>
<div class="row">
        <div class="col s12 m6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <form action="" method="post">
                        <p>Project Name: <?=in_array("projectname_error", $errors) ? "Please enter your project name!!" : ""?></p>
                        <input type="text" name="projectname" placeholder="Enter your project name" value="<?=$projectname ?? ""?>">
                        <p>Project Description: <?=in_array("projectdescription_error", $errors) ? "Please enter your project description !!" : ""?></p>
                        <input type="text" name="projectdescription" placeholder="Enter your project description" value="<?=$projectdescription ?? ""?>">
                        <p>Semester: <?=in_array("semester_error", $errors) ? "Please enter your semester !!" : ""?> </p>
                        <input type="text" name="semester" placeholder="Enter your semester" value="<?=$semester ?? ""?>">
                        <p>Project Requirements: <?=in_array("requirement_error", $errors) ? "Please enter your project requirements !!" : ""?> </p>
                        <input type="text" name="requirement" placeholder="Enter your project requirements" value="<?=$requirement ?? ""?>">
                        <p>Required Software: <?=in_array("software_error", $errors) ? "Please enter your required software !!" : ""?> </p>
                        <input type="text" name="software" placeholder="Enter your project software" value="<?=$software ?? ""?>">
                        <p>Required Hardware: <?=in_array("hardware_error", $errors) ? "Please enter your required hardware !!" : ""?> </p>
                        <input type="text" name="hardware" placeholder="Enter your project hardware" value="<?=$hardware ?? ""?>">
                        <p>Project Members: <?=in_array("members_error", $errors) ? "Please enter your project members !!" : ""?> </p>
                        <input type="text" name="members" placeholder="Enter your project members" value="<?=$members ?? ""?>">
                        <br>
                        <br>
                        <center>    
                            <!-- SUBMIT BUTTON -->
                        <input class="inp btn" type="submit" name="submit">
                    </center>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>