<?php
    require_once 'dbh.inc.php';
    session_start();

    if(isset($_POST['submit'])) {
        $usernameOrig = $_GET['usernameOrig'];
        $sqlUs = "SELECT id FROM committee WHERE username='$username'";
        $resultUs = mysqli_query($con, $sqlUs);
        $rowUs =  mysqli_fetch_assoc($resultUs);

        $username = mysqli_real_escape_string($con, $_POST['username']);
        $pwd = mysqli_real_escape_string($con, $_POST['password']);
        $position_id = mysqli_real_escape_string($con, $_POST['position']);

        $sqlU = "SELECT username FROM committee WHERE username='$username' AND username != '$usernameOrig'";
        $resultU = mysqli_query($con, $sqlU) or die("Database error: ".mysqli_error($con));
        $countU = mysqli_num_rows($resultU);
        
        if(empty($username) || empty($position_id)) {
            $_SESSION['masterediterror'] = "Some required fields are empty.";
            header("Location: ../viewmasters.php?masterediterror=emptyfields");
            exit();
        } else if(strlen($username) > 16) {
            $_SESSION['masterediterror'] = "Unable to update. Username is too long. It must not exceed to 16 characters.";
            header("Location: ../viewmasters.php?masterediterror=invalidusername");
            exit();
        } else if(strlen($pwd) < 6 && !empty($pwd)) {
            $_SESSION['masterediterror'] = "Unable to update. Password must consist of at least 6 characters.";
            header("Location: ../viewmasters.php?masterediterror=invalidusername");
            exit();
        } else if($countU > 0) {
            $_SESSION['masterediterror'] = "Unable to update. Username is already taken.";
            header("Location: ../viewmasters.php?masterediterror=existingUsername");
            exit();
        }

        if(!empty($pwd)) {
            $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = "UPDATE committee SET username='$username', password='$pwdHashed', position_id='$position_id' WHERE username='$usernameOrig'";
            mysqli_query($con, $sql) or die("Unable to update master user. Error: ".mysqli_error($con));
        } else {
            $sql = "UPDATE committee SET username='$username', position_id='$position_id' WHERE username='$usernameOrig'";
            $result = mysqli_query($con, $sql) or die("Unable to update master user. Error: ".mysqli_error($con));

            if($result) {
                echo "Yow";
            } else {
                echo "Error";
            }
        }

        $_SESSION['editmaster'] = "A master user information was updated successfully.";

        header("Location: ../viewmasters.php?editmaster=success");

    } 