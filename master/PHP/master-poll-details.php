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
            $_SESSION['create_poll_error'] = 'There are required fields that are empty.';
            header("Location: ../createpoll.php?error=emptyfields");
            exit();
        } else if(strlen($title) > 60) {
            $_SESSION['create_poll_error'] = 'The poll title that you have provided is too long.';
            header("Location: ../createpoll.php?error=titletoolong");
            exit();
        } else if(strlen($desc) > 120) {
            $_SESSION['create_poll_error'] = 'The poll description that you have provided is too long.';
            header("Location: ../createpoll.php?error=desctoolong");
            exit();
        } else if($date > $openDate && $date > $closeDate) {
            $_SESSION['create_poll_error'] = 'The dates that you provided have already expired.';
            header("Location: ../createpoll.php?error=datesexpired");
            exit();
        } else if($date > $openDate) {
            $_SESSION['create_poll_error'] = 'The opening date that you provided has already expired.';
            header("Location: ../createpoll.php?error=datesexpired");
            exit();
        } else if($date > $closeDate) {
            $_SESSION['create_poll_error'] = 'The closing date that you provided has already expired.';
            header("Location: ../createpoll.php?error=datesexpired");
            exit();
        } else if($openDate >= $closeDate) {
            $_SESSION['create_poll_error'] = 'The closing date cannot precede or be the same as the opening date.';
            header("Location: ../createpoll.php?error=invaliddates");
            exit();
        }

        $_SESSION['poll-title'] = $title;
        $_SESSION['poll-desc'] = $desc;
        $_SESSION['open-date'] = $openDate;
        $_SESSION['close-date'] = $closeDate;

        header("Location: ../createpoll-content.php");
        
    }

?>