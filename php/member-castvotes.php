<?php
    require_once '../includes/dbh.inc.php';
    session_start();

    $votes = $_POST['votes'];
    $pollid = $_POST['id'];
    $votesubmit = "";
    
    $sqlc = "SELECT id FROM poll_category WHERE poll_id='$pollid'";
    $resultc = mysqli_query($con, $sqlc) or die("Database error: ".mysqli_error($con));

    if($resultc) {
        $start = 0;
        $end = 0;

        while($rowc = mysqli_fetch_assoc($resultc)) {
            $catid = $rowc['id'];
            $sqli = "SELECT id FROM poll_category_item WHERE cat_id='$catid'";
            $resulti = mysqli_query($con, $sqli) or die("Database error: ".mysqli_error($con));

            $end = $end + mysqli_num_rows($resulti);

            if($resulti) {

                for($x = $start; $x < $end; $x++) {
                    $rowi = mysqli_fetch_assoc($resulti);
                    $itemid = $rowi['id'];

                    if($votes[$x] == "CANCEL") {

                        $sql = "UPDATE poll_category_item SET votes = votes + 1 WHERE id='$itemid'";
                        $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));

                        if(!$result) {
                            echo "There was an error casting your vote. Please refresh.";
                            exit();
                        }

                        $votesubmit .= "$itemid-";

                    }
                    $start++;
                }

            } else {
                echo "There was an error casting your vote. Please refresh.";
                exit();
            }
        }

        echo "Success!";

        $member = $_SESSION['userid'];

        date_default_timezone_set("Asia/Manila");
        $today = date("Y-m-d");

        $votesubmit = substr($votesubmit, 0, strlen($votesubmit)-1);

        $sql = "INSERT INTO vote_details (poll_id, member_id, date_voted, code) VALUES ('$pollid', '$member', '$today','$votesubmit')";
        $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));

    } else {
        echo "There was an error casting your vote. Please refresh.";
        exit();
    }

?>