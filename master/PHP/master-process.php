<?php
    require_once 'dbh.inc.php';
    session_start();

    $pollid = trim(mysqli_real_escape_string($con, $_POST['pollid']));

    if(isset($_POST['btn-delete'])) {

        $sql = "DELETE FROM poll WHERE id='$pollid'";
        $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));

        if($result) {
            header("Location: ../dashboard.php?deletepoll=success");
            $_SESSION['deletepoll'] = "The poll was deleted successfully.";
        } else {
            header("Location: ../dashboard.php?pollerror=delete");
            $_SESSION['pollerror'] = "Unable to delete poll.";
        }
    }

    if(isset($_POST['btn-edit'])) {
        $_SESSION['editid'] = $pollid;
        
        $sql = "SELECT * FROM poll WHERE id='$pollid'";
        $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));
        $row = mysqli_fetch_assoc($result);

        $_SESSION['edittitle'] = $row['title'];
        $_SESSION['editdesc'] = $row['description'];
        $_SESSION['editopen'] = $row['date_open'];
        $_SESSION['editclose'] = $row['date_close'];

        header("Location: ../editpoll.php?editpoll=$pollid");
    }

    if(isset($_POST['btn-view'])) {
        $_SESSION['viewpoll'] = $pollid;
        
        $sql = "SELECT * FROM poll WHERE id='$pollid'";
        $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));
        $row = mysqli_fetch_assoc($result);

        header("Location: ../viewvotes.php?viewpoll=$pollid");
    }