<?php
    session_start();
    require_once 'dbh.inc.php';

    if(isset($_POST['update-info'])) {

        $userid = $_SESSION['master-username'];
        $oldpass = trim(mysqli_real_escape_string($con, $_POST['oldpass']));
        $newpass = trim(mysqli_real_escape_string($con, $_POST['newpass']));
        $retype = trim(mysqli_real_escape_string($con, $_POST['retypepass']));
        $newuserid = trim(mysqli_real_escape_string($con, $_POST['username']));

        $sql = "SELECT password FROM committee WHERE username='$userid'";
        $result = mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        $pwd = $row['password'];

        $pwdCheck = password_verify($oldpass, $pwd);

        if(empty($oldpass) || empty($newpass) || empty($retype) || empty($newuserid) ) {
            $_SESSION['change_error'] = "There are required fields that are empty.";
            header("Location: ../dashboard.php?change_error=emptyfields");
            exit();
        } else if(!($newpass == $retype)) {
            $_SESSION['change_error'] = "Your new password does not match the retyped new password.";
            header("Location: ../dashboard.php?change_error=retypenotmatch");
            exit();
        } else if(strlen($newpass) < 6) {
            $_SESSION['change_error'] = "Unable to change password. New password must contain at least 6 characters.";
            header("Location: ../dashboard.php?change_error=invalidpassword");
            exit();
        } else if($pwdCheck == false) {
            $_SESSION['change_error'] = "Old password entered is incorrect.";
            header("Location: ../dashboard.php?change_error=passwordincorrect");
            exit();
        } 
        
        
        if(strlen($newuserid > 16)) {
            $_SESSION['change_error'] = "The new username exceeds the limit of 16 characters.";
            header("Location: ../dashboard.php?change_error=invalidusername");
            exit();
        }

        if(!$newuserid == $userid) {

            $sql = "SELECT username FROM committee WHERE username='$newuserid'";
            $result = mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));
            $count = mysqli_num_rows($result);
            
            if($count > 0) {
                $_SESSION['change_error'] = "The new username entered is already taken.";
                header("Location: ../dashboard.php?change_error=usernametaken");
                exit();
            }

        }

        $hashedPass = password_hash($newpass, PASSWORD_DEFAULT);
        $sql = "UPDATE committee SET password='$hashedPass', username='$newuserid' WHERE username='$userid'";
        mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));

        $_SESSION['master_change_userid_pass'] = "Your username and password was updated successfully.";
        $_SESSION['master-username'] = $newuserid;
        header("Location: ../dashboard.php?change_username_pass=success");

    }
