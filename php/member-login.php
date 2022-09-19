<?php
    session_start();

    require_once '../includes/dbh.inc.php';

    if(isset($_POST['submit'])) {
        $idnum = mysqli_real_escape_string($con, $_POST['idnumber']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        
        if(empty($idnum) || empty($password)) {
            $_SESSION['login_error'] = 'There are required fields that are empty.';
            header("Location: ../login.php?error=emptyfield");
            exit();
        } else if(!(strlen($idnum) == 7)) {
            $_SESSION['login_error'] = 'Invalid ID number. A valid ID number has exactly 7 digits.';
            header("Location: ../login.php?error=IDinvalid");
            exit();
        } else if(strlen($password) < 6) {
            $_SESSION['login_error'] = 'Password is too short. Password length must be at least 6 characters.';
            header("Location: ../login.php?error=invalidpassword");
            exit();
        }

        $sql = "SELECT idnum, password FROM member WHERE idnum='$idnum'";
        $result = mysqli_query($con, $sql) or die ("Cannot execute query. Error: ".mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        $checkPwrd = password_verify($password, $row['password']);
        
        if(mysqli_num_rows($result) == 0) {
            $_SESSION['login_error'] = 'The ID number is not recognized as a PSITS member';
            header("Location: ../login.php?error=IDunrecognized");
            exit();
        } else if(empty($row['password'])) {
            $_SESSION['login_error'] = 'The ID number is not yet registered. Please proceed to the register page.';
            header("Location: ../login.php?error=IDnotregistered");
            exit();
        } else if($checkPwrd == false) {
            $_SESSION['login_error'] = 'Wrong username and password combination';
            header("Location: ../login.php?error=wrongcombination");
            exit();
        } else {
            unset($_SESSION['login_error']);
            
            date_default_timezone_set("Asia/Manila");
            $today = date("Y-m-d");

            $sql = "UPDATE member SET last_access='$today' WHERE idnum='$idnum'";

            mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));
            
            $_SESSION['userid'] = $idnum;
            $_SESSION['loggedin'] = 'You are signed in!';
            header("Location: ../dashboard.php");
        }
    }

?>