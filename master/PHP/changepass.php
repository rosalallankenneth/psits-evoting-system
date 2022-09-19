<?php
    require_once 'dbh.inc.php';

    $idnum = $_GET['idnum'];
    
    $sql = "UPDATE member SET password=NULL, last_access=NULL WHERE idnum='$idnum'";
    mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));

    session_start();
    $_SESSION['resetpass'] = $idnum;
    header("Location: ../viewmembers.php?resetpass=success");