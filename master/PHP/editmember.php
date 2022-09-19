<?php
    require_once 'dbh.inc.php';
    session_start();

    if(isset($_POST['submit'])) {
        $idnumOrig = $_GET['idOrig'];
        $emailOrig = $_GET['emailOrig'];

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
            $_SESSION['editerror'] = "Some required fields are empty.";
            header("Location: ../viewmembers.php?editerror=emptyfields");
            exit();
        } else if(!(strlen($idnum) == 7)) {
            $_SESSION['editerror'] = "Unable to update. Invalid ID number format. It must have exactly 7 digits only.";
            header("Location: ../viewmembers.php?editerror=emptyfields");
            exit();
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['editerror'] = 'Unable to update. The email you entered is invalid.';
            header("Location: ../viewmembers.php?editerror=invalidEmail");
            exit();
        } else if($countID > 0 && !($idnumOrig == $idnum)) {
            $_SESSION['editerror'] = "Unable to update. ID number already exists.";
            header("Location: ../viewmembers.php?editerror=existingID");
            exit();
        } else if($countE > 0 && !($emailOrig == $email)) {
            $_SESSION['editerror'] = "Unable to update. Email is already taken.";
            header("Location: ../viewmembers.php?editerror=existingEmail");
            exit();
        }

        $sql = "UPDATE member SET idnum='$idnum', lastname='$lname', firstname='$fname', midname='$mname', course_id='$course_id', year='$year', email='$email' WHERE idnum='$idnumOrig'";

        mysqli_query($con, $sql) or die("Unable to add member. Error: ".mysqli_error($con));

        $_SESSION['editmember'] = "A member information was updated successfully.";

        header("Location: ../viewmembers.php?editmember=success");

    } 