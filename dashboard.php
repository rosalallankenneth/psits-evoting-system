<?php
    session_start();

    if(!(isset($_SESSION['userid']))) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PSITS E-Voting | Dashboard</title>

    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/mobile.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/styles-members/css-dashboard.css" />
    <link rel="stylesheet" href="css/styles-members/mobile/mob-dashboard.css" />

    <script src="js/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function(){
            $('li:nth-child(1) div').addClass('menu-selected');
        });
    </script>
    
</head>

<body>
    <?php require_once 'includes/dashboard.inc.php' ?>

        <div class="content">

            <h1>E-VOTING<small>SYSTEM</small></h1>
            <hr />
            <div id='welcome'>Welcome,<span>
                <?php
                    require_once 'includes/dbh.inc.php';
                    $idnum = $_SESSION['userid'];

                    $sql = "SELECT firstname FROM member WHERE idnum='$idnum'";
                    $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));
                    $row = mysqli_fetch_assoc($result);

                    echo $row['firstname'];
                ?></span>!
            </div>
            <?php

                $sql = "SELECT * FROM poll ORDER BY id DESC";
                $result = mysqli_query($con, $sql) or die("Couldn't retrieve polls. Database error: ".mysqli_error($con));

                if(mysqli_num_rows($result) == 0) {
                    echo "<p id='no-polls'>There are currently no polls available.</p>";
                    exit();
                }

                while($row = mysqli_fetch_assoc($result)):
                ?>
                <div class="pollbox">

                        <input name='pollid' class="poll-id" value="<?php echo $row['id']; ?>"/>
                        <div class="pollbox-header">
                            <h4 class='poll-title'><?php echo $row['title']; ?></h4>
                            <p class='poll-desc'><?php echo $row['description']; ?></p>
                        </div>
                        <div class="pollbox-body">
                            <p class='numvoted'><b><?php
                                $ii = $row['id'];
                                $sqlrev = "SELECT vote_id FROM vote_details WHERE poll_id='$ii'";
                                $resultrev = mysqli_query($con, $sqlrev) or die("Database error: ".mysqli_error($con));
                                $countrev = mysqli_num_rows($resultrev);
                                
                                echo $countrev;
                            ?></b> people have voted</p>
                            <div class="bottom">
                                <div class="poll-dates">
                                    <p><?php 
                                        $today = date("Y-m-d");
                                        $dateopen = date("F j, Y", strtotime($row['date_open']));
                                        $dateclose = date("F j, Y", strtotime($row['date_close']));

                                        if($row['date_close'] < $today) {
                                            echo "The poll was closed on <b>$dateclose</b>";
                                        } else {
                                            echo "Open on <b>$dateopen</b> until <b>$dateclose</b>";
                                        }
                                    ?></b></p>
                                </div>
                                <div class="poll-btns">
                                <?php
                                    $sqlr = "SELECT vote_id FROM vote_details WHERE poll_id='$ii' AND member_id='$idnum'";
                                    $resultr = mysqli_query($con, $sqlr) or die("Database error: ".mysqli_error($con));
                                    $countr = mysqli_num_rows($resultr);
                                    
                                    if($countr > 0 || $row['date_close'] < $today) {
                                        echo "<a href='vote.php?pollid=$ii' name='btn-vote' class='btn btn-info'>View votes and results</a>";
                                    } else {
                                        echo "<a href='vote.php?pollid=$ii' name='btn-vote' class='btn btn-success'>VOTE</a>";
                                    }
                                ?>
                                </div>
                            </div>
                        </div>

                </div>

            <?php endwhile; ?>
        </div>
    </div>
    <script src="js/main.js"></script>
    <script src="js/js-toggle.js"></script>
</body>

</html>