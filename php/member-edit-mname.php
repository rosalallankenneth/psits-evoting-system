<?php

    session_start();
    require_once '../includes/dbh.inc.php';

    $idnum = $_SESSION['userid'];
    $mname = strtoupper(mysqli_real_escape_string($con, $_GET['mname']));

    $sql = "UPDATE member SET midname='$mname' WHERE idnum='$idnum'";
    mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));

    $_SESSION['mnameEdit'] = "User's middle name was updated successfully.";
    header("Location: ../user-account.php?changeMname=success");

?>