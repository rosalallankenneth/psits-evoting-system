<?php
    require_once 'dbh.inc.php';
    session_start();

    $catnames = "";
    $count = 0;

    if(isset($_POST['submit'])) {
        for($x = 0; $x < count($_POST['name']); $x++) {
            if(!empty(trim($_POST['name'][$x]))) {
                $catnames .= trim($_POST['name'][$x]."-");
                $count++;
            }
        }
        if($count == 0) {
            header("Location: ../createpoll-content.php?create_cat_error=noinput");
            $_SESSION['create_cat_error'] = "Unable to save category names. The form should have at least one input.";
            exit();
        }

        $_SESSION['catnames'] = $catnames;

        header("Location: ../createpoll-content.php?create=items&num=".$count);
    } else {
        header("Location: ../createpoll-content.php");
    }