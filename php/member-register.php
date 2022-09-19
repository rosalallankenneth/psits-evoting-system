<?php
    session_start();

    require_once '../includes/dbh.inc.php';

    if(isset($_POST['submit'])) {

        $idnum = mysqli_real_escape_string($con, $_POST['idnumber']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        if(empty($idnum) || empty($password)) {
            $_SESSION['reg_error'] = 'There are required fields that are empty.';
            header("Location: ../index.php?error=emptyfield");
            exit();
        } else if(!(strlen($idnum) == 7)) {
            $_SESSION['reg_error'] = 'Invalid ID number';
            header("Location: ../index.php?error=IDinvalid");
            exit();
        } else if(strlen($password) < 6) {
            $_SESSION['reg_error'] = 'Password is too short. Password length must be at least 6 characters';
            header("Location: ../index.php?error=invalidpassword");
            exit();
        }

        $sql = "SELECT idnum, password FROM member WHERE idnum='$idnum'";
        $result = mysqli_query($con, $sql) or die ("Cannot execute query. Error: ".mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        
        if(mysqli_num_rows($result) == 0) {
            $_SESSION['reg_error'] = 'The ID number is not recognized as a PSITS member';
            header("Location: ../index.php?error=IDunrecognized");
            exit();
        } else if(!empty($row['password'])) {
            $_SESSION['reg_error'] = 'The ID number is already registered';
            header("Location: ../index.php?error=IDalreadyregistered");
            exit();
        } else {
            unset($_SESSION['reg_error']);
            unset($_SESSION['login_error']);
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE member SET password='$hashedPass' WHERE idnum='$idnum'";
            mysqli_query($con, $sql) or die ("Unable to execute query. Error: ".mysqli_error($con));

            $_SESSION['registered'] = 'Your ID number was registered successfully.';
            header("Location: ../login.php?register=success");
        }
    }
?>