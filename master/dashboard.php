<?php
    session_start();
    require_once 'PHP/dbh.inc.php';

    if(!(isset($_SESSION['master-username']))) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PSITS E-Voting | Dashboard</title>

    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/mobile.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-dashboard.css" />
    <link rel="stylesheet" href="../css/styles-masters/mobile/mob-dashboard.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-modal.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />

    <script src="../js/jquery-3.4.1.js"></script>
    <script src="../js/js-master-modal.js"></script>
    <script>
        $(document).ready(function(){
            $('li:nth-child(1) div').addClass('menu-selected');
        });
    </script>
    
</head>

<body>
    <?php require_once '../includes/master-dashboard.inc.php' ?>
    <script src="../js/main.js"></script>

        <?php
            if(isset($_SESSION['deletepoll']) && isset($_GET['deletepoll'])) {
                echo "<div class='alert-warning'>";
                echo $_SESSION['deletepoll'];
                echo "</div>";
                unset($_SESSION['deletepoll']);
            }
            if(isset($_SESSION['pollerror']) && isset($_GET['pollerror'])) {
                echo "<div class='alert-danger'>";
                echo $_SESSION['pollerror'];
                echo "</div>";
                unset($_SESSION['pollerror']);
            }
            if(isset($_SESSION['editpoll']) && isset($_GET['editpoll'])) {
                echo "<div class='alert-success'>";
                echo $_SESSION['editpoll'];
                echo "</div>";
                unset($_SESSION['editpoll']);
            }
        ?>

        <div class="content">

            <h1>E-VOTING<small>SYSTEM</small></h1>
            <hr />
            <div id='welcome'>Welcome,<span><b>
                <?php
                    require_once '../includes/dbh.inc.php';
                    
                    echo $_SESSION['master-username'];
                ?></b></span>!
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
                <form action="PHP/master-process.php" method='POST'>

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
                                <button name='btn-view' class="btn btn-success">VIEW VOTES</button>
                                <button name='btn-edit' class="btn btn-primary">EDIT</button>
                                <button name='btn-delete' class="btn btn-danger">DELETE</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <?php endwhile; ?>
            
            <div id='cover'><div>
        </div>
    </div>
    <?php require_once '../master/PHP/modal-useracc.php'; ?>
    <script>
        var loc = decodeURIComponent(window.location.search.substring(1));

        if(loc.indexOf("change_error") !== -1 || loc.indexOf("change_username_pass") !== -1) {
            document.getElementById('modal').style.display = "block";
            document.getElementById('cover').style.display = "block";
        }
    </script>
    <script src="../js/js-toggle.js"></script>
</body>

</html>