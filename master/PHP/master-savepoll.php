<?php
    require_once 'dbh.inc.php';
    session_start();

    if(isset($_POST['submit'])) {

        $numOfcat = (int) $_GET['numofcat'];
        

        for($x = 0; $x < $numOfcat; $x++) {
            $ready = false;
            $numItems = 0;

            for($xx = 0; $xx < count($_POST["items".$x.""]); $xx++) {
                if(!empty(trim($_POST["items".$x.""][$xx]))) {
                    $ready = true;
                    $numItems++;
                }
            }

            if($ready == false) {
                header("Location: ../createpoll-content.php?createpoll_error=emptyfields&create=item&num=$numOfcat");
                $_SESSION['createpoll_error'] = "There are required fields that are empty.";
                exit();
            }
            if(empty($_POST["max"][$x])) {
                header("Location: ../createpoll-content.php?createpoll_error=emptyfields&create=item&num=$numOfcat");
                $_SESSION['createpoll_error'] = "There are required fields that are empty.";
                exit();
            }
            if(!is_numeric($_POST["max"][$x])) {
                header("Location: ../createpoll-content.php?createpoll_error=notnumeric&create=item&num=$numOfcat");
                $_SESSION['createpoll_error'] = "There are number of selection values that are not numeric.";
                exit();
            }
            if($numItems < $_POST["max"][$x]) {
                header("Location: ../createpoll-content.php?createpoll_error=invalidmax&create=item&num=$numOfcat");
                $_SESSION['createpoll_error'] = "One of the values of maximum selections is greater than number of valid items created.";
                exit();
            }
        }

        $pollname = $_SESSION['poll-title'];
        $polldesc = $_SESSION['poll-desc'];
        $dateopen = $_SESSION['open-date'];
        $dateclose = $_SESSION['close-date'];

        $userid = $_SESSION['master-username'];

        $initsql = "SELECT id FROM committee WHERE username='$userid'";
        $initresult = mysqli_query($con, $initsql) or die("Database error: ".mysqli_error($con));
        $initrow = mysqli_fetch_assoc($initresult);

        $creatorid = $initrow['id'];

        $sql = "INSERT INTO poll (title, description, date_open, date_close, creator_id, last_editor_id) VALUES ('$pollname','$polldesc','$dateopen','$dateclose','$creatorid','$creatorid')";
        $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));

        if($result) {
            
            $initsql = "SELECT id FROM poll ORDER BY id DESC LIMIT 1";
            $initresult = mysqli_query($con, $initsql) or die("Database error: ".mysqli_error($con));
            $initrow = mysqli_fetch_assoc($initresult);
            
            $pollid = $initrow['id'];
            $catnames = explode("-", $_SESSION['catnames']);

            for($x = 0; $x < $numOfcat; $x++) {

                $catMax = trim($_POST["max"][$x]);
                $sql = "INSERT INTO poll_category (poll_id, name, max_selection) VALUES ('$pollid','$catnames[$x]', '$catMax')";
                $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));

                if($result) {
                    
                    $initsql = "SELECT id FROM poll_category ORDER BY id DESC LIMIT 1";
                    $initresult = mysqli_query($con, $initsql) or die("Database error: ".mysqli_error($con));
                    $initrow = mysqli_fetch_assoc($initresult);
                    
                    $catid = $initrow['id'];
                    
                    for($xx = 0; $xx < count($_POST["items".$x.""]); $xx++) {
                        if(!empty(trim($_POST["items".$x.""][$xx]))) {
                            $itemName = $_POST["items".$x.""][$xx];
                            $itemDesc = $_POST["descs".$x.""][$xx];

                            $sql = "INSERT INTO poll_category_item (cat_id, name, description) VALUES ('$catid','$itemName','$itemDesc')";
                            $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));
                            
                            if($result) {
                                unset($_SESSION['poll-title']);
                                unset($_SESSION['poll-desc']);
                                unset($_SESSION['open-date']);
                                unset($_SESSION['close-date']);
                                unset($_SESSION['catnames']);
                                
                                $_SESSION['savepoll'] = "A new poll was created successfully. See dashboard to view new polls.";
                                header("Location: ../createpoll.php?savepoll=success");
                            } else {
                                $_SESSION['createpoll_error'] = "Unable to record poll items.";
                                header("Location: ../createpoll-content.php?createpoll_error=notsaved");
                                exit();
                            }
                        }
                    }

                } else {
                    $_SESSION['createpoll_error'] = "Unable to record poll categories.";
                    header("Location: ../createpoll-content.php?create=items&num=".$numOfcat."&createpoll_error=notsaved");
                    exit();
                }

            }

        } else {
            $_SESSION['createpoll_error'] = "Unable to record poll.";
            header("Location: ../createpoll-content.php?create=items&num=".$numOfcat."&createpoll_error=notsaved");
            exit();
        }
        
    }

