<?php

    session_start();
    require_once 'dbh.inc.php';

    if(isset($_POST['btn-next'])) {

        date_default_timezone_set("Asia/Manila");
        $date = date("Y-m-d");

        $mon1 = mysqli_real_escape_string($con, $_POST['mm1']);
        $day1 = mysqli_real_escape_string($con, $_POST['dd1']);
        $year1 = mysqli_real_escape_string($con, $_POST['yy1']);
        $mon2 = mysqli_real_escape_string($con, $_POST['mm2']);
        $day2 = mysqli_real_escape_string($con, $_POST['dd2']);
        $year2 = mysqli_real_escape_string($con, $_POST['yy2']);

        $title = mysqli_real_escape_string($con, $_POST['poll-title']);
        $desc = mysqli_real_escape_string($con, $_POST['poll-desc']);
        $openDate = $year1."-".$mon1."-".$day1;
        $closeDate = $year2."-".$mon2."-".$day2;

        if(empty($title) || empty($desc)) {
            $_SESSION['edit_poll_error'] = 'There are required fields that are empty.';
            header("Location: ../editpoll.php?error=emptyfields");
            exit();
        } else if(strlen($title) > 60) {
            $_SESSION['edit_poll_error'] = 'The poll title that you have provided is too long.';
            header("Location: ../editpoll.php?error=titletoolong");
            exit();
        } else if(strlen($desc) > 120) {
            $_SESSION['edit_poll_error'] = 'The poll description that you have provided is too long.';
            header("Location: ../editpoll.php?error=desctoolong");
            exit();
        } else if($openDate > $closeDate) {
            $_SESSION['edit_poll_error'] = 'The closing date cannot precede the opening date.';
            header("Location: ../editpoll.php?error=invaliddates");
            exit();
        }

        $sqle = "SELECT id FROM committee WHERE username='".$_SESSION['master-username']."'";
        $resulte = mysqli_query($con, $sqle) or die("Database error: ".mysqli_error($con));
        $rowe = mysqli_fetch_assoc($resulte);
        $editor_id = $rowe['id'];

        $pollid = $_SESSION['editid'];
        $sql = "UPDATE poll SET title='$title', description='$desc', date_open='$openDate', date_close='$closeDate', last_editor_id='$editor_id' WHERE id='$pollid'";
        $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));

        $_SESSION['editpoll'] = "A poll was updated successfully.";
        header("Location: ../dashboard.php?editpoll=success");
        
    }

?>