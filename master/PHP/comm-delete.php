<?php
    require_once 'dbh.inc.php';

    $username = $_GET['username'];
    
    $sql = "DELETE FROM committee WHERE username='$username'";
    mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));

    session_start();
    $_SESSION['deletedmaster'] = $username;
    header("Location: ../viewmasters.php?deletemaster=success");