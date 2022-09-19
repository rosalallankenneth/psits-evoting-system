<?php

    require_once 'dbh.inc.php';
    session_start();

    if(isset($_POST['submit'])) {

        $idnum = mysqli_real_escape_string($con, $_POST['idnum']);
        $lname = strtoupper(mysqli_real_escape_string($con, $_POST['lname']));
        $fname = strtoupper(mysqli_real_escape_string($con, $_POST['fname']));
        $mname = strtoupper(mysqli_real_escape_string($con, $_POST['mname']));
        $course_id = mysqli_real_escape_string($con, $_POST['course']);
        $year = mysqli_real_escape_string($con, $_POST['year']);
        $email = mysqli_real_escape_string($con, $_POST['email']);

        $sqlID = "SELECT idnum FROM member WHERE idnum='$idnum'";
        $resultID = mysqli_query($con, $sqlID) or die("Database error: ".mysqli_error($con));
        $countID = mysqli_num_rows($resultID);
        
        $sqlE = "SELECT email FROM member WHERE email='$email'";
        $resultE = mysqli_query($con, $sqlE) or die("Database error: ".mysqli_error($con));
        $countE = mysqli_num_rows($resultE);

        if(empty($idnum) || empty($lname) || empty($fname) || empty($course_id) || empty($year) || empty($email)) {
            $_SESSION['error_add'] = "Unable to add. There are required fields that are empty.";
            header("Location: ../viewmembers.php?error=emptyfields");
            exit();
        } else if(!(strlen($idnum) == 7)) {
            $_SESSION['error_add'] = "Invalid ID number format. It must have exactly 7 digits only.";
            header("Location: ../viewmembers.php?error=invalidid");
            exit();
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_add'] = 'The email you entered is invalid.';
            header("Location: ../viewmembers.php?error=invalidEmail");
            exit();
        } else if($countID > 0) {
            $_SESSION['error_add'] = "Unable to add. ID number already exists.";
            header("Location: ../viewmembers.php?error=existingID");
            exit();
        } else if($countE > 0) {
            $_SESSION['error_add'] = "Unable to add. Email is already taken.";
            header("Location: ../viewmembers.php?error=existingEmail");
            exit();
        }

        $sql = "INSERT INTO member (idnum, lastname, firstname, midname, course_id, year, email) VALUES ('$idnum', '$lname', '$fname', '$mname', '$course_id', '$year', '$email')";

        mysqli_query($con, $sql) or die("Unable to add member. Error: ".mysqli_error());

        $_SESSION['addmember'] = "A member information was added successfully.";

        header("Location: ../viewmembers.php?addmember=success");

    }


