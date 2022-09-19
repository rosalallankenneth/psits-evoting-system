<?php
    require_once 'dbh.inc.php';

    $idnum = $_GET['idnum'];
    
    $sql = "DELETE FROM member WHERE idnum='$idnum'";
    mysqli_query($con, $sql) or die("Unable to execute query. Error: ".mysqli_error($con));

    session_start();
    $_SESSION['deleted'] = $idnum;
    header("Location: ../viewmembers.php?delete=success");