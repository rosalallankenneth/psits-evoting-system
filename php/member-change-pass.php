<?php
    session_start();
    require_once '../includes/dbh.inc.php';

        $idnum = $_SESSION['userid'];
        $oldpass = mysqli_real_escape_string($con, $_GET['old-pass']);
        $newpass = mysqli_real_escape_string($con, $_GET['new-pass']);
        $newEmail = mysqli_real_escape_string($con, $_GET['email']);

        $sql = "SELECT email, password FROM member WHERE idnum='$idnum'";
        $result = mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
        $pwd = $row['password'];
        $email = $row['email'];

        $pwdCheck = password_verify($oldpass, $pwd);

        if(empty($oldpass) || empty($newpass) || empty($newpass) ) {
            $_SESSION['change_error'] = "There are required fields that are empty.";
            header("Location: ../user-account.php?change_error=emptyfields");
            exit();
        } else if(strlen($newpass) < 6) {
            $_SESSION['change_error'] = "Unable to change password. New password must contain at least 6 characters.";
            header("Location: ../user-account.php?change_error=invalidpassword");
            exit();
        } else if($pwdCheck == false) {
            $_SESSION['change_error'] = "Old password entered is incorrect.";
            header("Location: ../user-account.php?change_error=passwordincorrect");
            exit();
        } else if(!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['change_error'] = "The new email entered is invalid.";
            header("Location: ../user-account.php?change_error=invalidemail");
            exit();
        } else {
            $hashedPass = password_hash($newpass, PASSWORD_DEFAULT);
            $sql = "UPDATE member SET password='$hashedPass', email='$newEmail' WHERE idnum='$idnum'";
            mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));

            $_SESSION['change_success'] = "Your password and email was updated successfully.";
            header("Location: ../user-account.php?change_pass_mail=success");
        }

?>