<?php

    require_once 'dbh.inc.php';
    session_start();

    if(isset($_POST['submit'])) {

        $id = mysqli_real_escape_string($con, $_POST['id']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $pwd = mysqli_real_escape_string($con, $_POST['password']);
        $position = strtoupper(mysqli_real_escape_string($con, $_POST['position']));

        $sqlID = "SELECT username FROM committee WHERE username='$username'";
        $resultID = mysqli_query($con, $sqlID) or die("Database error: ".mysqli_error($con));
        $countID = mysqli_num_rows($resultID);

        if(empty($username) || empty($pwd) || empty($position)) {
            $_SESSION['mastererror_add'] = "Unable to add. There are required fields that are empty.";
            header("Location: ../viewmasters.php?mastererror=emptyfields");
            exit();
        } else if(strlen($pwd) < 6) {
            $_SESSION['mastererror_add'] = "Invalid password. It must consist of at least 6 characters.";
            header("Location: ../viewmasters.php?mastererror=invalidpassword");
            exit();
        } else if(strlen($username) > 16) {
            $_SESSION['mastererror_add'] = "Unable to add. Username is too long. It must not exceed to 16 characters.";
            header("Location: ../viewmasters.php?mastererror=invalidusername");
            exit();
        } else if($countID > 0) {
            $_SESSION['mastererror_add'] = "Unable to add. Username is already taken.";
            header("Location: ../viewmasters.php?mastererror=existingUsername");
            exit();
        }
        
        $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = "INSERT INTO committee (id, username, password, position_id) VALUES ('$id', '$username', '$pwdHashed', '$position')";

        mysqli_query($con, $sql) or die("Unable to add master. Error: ".mysqli_error($con));

        $_SESSION['addmaster'] = "A master user information was added successfully.";

        header("Location: ../viewmasters.php?addmaster=success");

    }


