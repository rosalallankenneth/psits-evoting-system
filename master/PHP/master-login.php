<?php
    session_start();

    require_once 'dbh.inc.php';

    if(isset($_POST['login'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        
        if(empty($username) || empty($password)) {
            $_SESSION['master_login_error'] = 'There are required fields that are empty.';
            header("Location: ../index.php?error=emptyfield");
            exit();
        } else if(strlen($password) < 6) {
            $_SESSION['master_login_error'] = 'Password is too short. Password length must be at least 6 characters.';
            header("Location: ../index.php?error=invalidpassword");
            exit();
        }

        $sql = "SELECT username, password FROM committee WHERE username='$username'";
        $result = mysqli_query($con, $sql) or die ("Cannot execute query. Error: ".mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        $checkPwrd = password_verify($password, $row['password']);
        
        if(mysqli_num_rows($result) == 0) {
            $_SESSION['master_login_error'] = 'The username is not recognized as a master user.';
            header("Location: ../index.php?error=IDunrecognized");
            exit();
        } else if($checkPwrd == false) {
            $_SESSION['master_login_error'] = 'Wrong username and password combination';
            header("Location: ../index.php?error=wrongcombination");
            exit();
        } else {
            unset($_SESSION['master_login_error']);
            
            date_default_timezone_set("Asia/Manila");
            $today = date("Y-m-d");

            $sql = "UPDATE committee SET last_access='$today' WHERE username='$username'";
            mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));
            
            $_SESSION['master-username'] = $username;
            $_SESSION['loggedin'] = 'You are signed in!';
            header("Location: ../dashboard.php");
        }
    }

?>