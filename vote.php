<?php
    session_start();

    if(!(isset($_SESSION['userid']))) {
        header("Location: login.php");
    }
    if(!(isset($_GET['pollid']))) {
        header("Location: dashboard.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PSITS E-Voting | Vote</title>

    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/mobile.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/styles-members/css-vote.css" />
    <link rel="stylesheet" href="css/styles-members/mobile/mob-vote.css" />

    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/js-user-account.js"></script>

</head>

<body>
    <?php 
        require 'includes/dashboard.inc.php'; 
        require 'includes/dbh.inc.php';

        $id = $_GET['pollid'];

        $sql = "SELECT title, date_close FROM poll WHERE id='$id'";
        $result = mysqli_query($con, $sql) or die("Database error. Error: ".mysqli_error($con));
        $count = mysqli_num_rows($result);
        
        if(!$result) {
            header("Location: dashboard.php");
            exit();
        }

        if($count < 1) {
            header("Location: dashboard.php");
            exit();
        }

        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];

        $today = date("Y-m-d");
        $dateclose = $row['date_close'];
    ?>

        <div class="content">

            <div class="title">
                <h4><a href="dashboard.php">Dashboard</a> / <?php echo $title; ?></h4>
                <a id='backtodash' href="dashboard.php">Back to dashboard</a>
            </div>
            <hr />
            
            <?php

                $userid = $_SESSION['userid'];

                $sqlrev = "SELECT code, date_voted FROM vote_details WHERE poll_id='$id' AND member_id='$userid'";
                $resultrev = mysqli_query($con, $sqlrev) or die("Database error: ".mysqli_error($con));
                $countrev = mysqli_num_rows($resultrev);
                $rowrev = mysqli_fetch_assoc($resultrev);

                if($countrev > 0 || $dateclose < $today):
            ?>
                <h5 style='text-align: center; padding-top: 20px;'>Review votes<br>
                <p style='font-size: 15px; color: #6d6d6d; padding-top: 10px;'>
                <?php
                if($countrev == 0) {
                    echo "You have not voted for this poll";
                } else {
                    $datevoted = date("F j, Y", strtotime($rowrev['date_voted']));    
                    echo "Date voted: ".$datevoted;
                }
                ?></p>
                </h5>
                <?php
                    $sqlcat = "SELECT * FROM poll_category WHERE poll_id='$id'";
                    $resultcat = mysqli_query($con, $sqlcat) or die("Database error: ".mysqli_error($con));
                    
                    while($rowcat = mysqli_fetch_assoc($resultcat)):

                ?>
                <?php if($countrev == 0) {
                    echo "<div style='margin-top: 20px !important;' class='cat-container'>";
                    break;
                } ?>
                <span style='display: none;' id='poll-id'><?php echo $id; ?></span>
                <div style='margin-top: 20px !important;' class='cat-container'>
                    <div class="cat-header">
                        <h4 class='catname'><?php echo $rowcat['name']; ?></h4>
                    </div>
                    <?php
                        $votesr = explode("-", $rowrev['code']);

                        for($x = 0; $x < count($votesr); $x++):
                    ?>
                        <?php
                            $it = $votesr[$x];
                            $sqlI = "SELECT * FROM poll_category_item WHERE id='$it'";
                            $resultI = mysqli_query($con, $sqlI) or die("Database error. Error: ".mysqli_error($con));
                            $rowI = mysqli_fetch_assoc($resultI);

                            if($rowI['cat_id'] == $rowcat['id']):
                        ?>
                                <div class="item-container">
                                    <i class='fa fa-image'></i>
                                    <div class="item-contents">
                                        <h5><?php echo $rowI['name']; ?></h5>
                                        <div class="div-btn">
                                            <?php 
                                                if(empty($rowI['description'])) {
                                                    echo "<p>. . .</p>";
                                                } else {
                                                    echo "<p>".$rowI['description']."</p>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php endwhile; ?>
                </div>
                
                <h5 style='text-align: center; padding-top: 20px;'>Poll results<br>
                <?php
                    if($dateclose < $today):
                ?>
                    <p style='font-size: 15px; color: #6d6d6d; padding-top: 10px;'>Voting was closed on 
                    <?php
                        $datevoted = date("F j, Y", strtotime($dateclose));    
                        echo $datevoted;
                    ?></p>
                    <?php
                        $sqlcat = "SELECT * FROM poll_category WHERE poll_id='$id'";
                        $resultcat = mysqli_query($con, $sqlcat) or die("Database error: ".mysqli_error($con));

                        while($rowcat = mysqli_fetch_assoc($resultcat)):
                    ?>



            <?php
                $catid = $rowcat['id'];
                $catname = $rowcat['name'];

            ?>
                <div style='margin-top: 20px !important;' class='cat-container'>
                    <div class="cat-header">
                        <h4 class='catname'><?php echo $rowcat['name']; ?></h4>
                    </div>
                <?php

                    $sqlI = "SELECT id, name, votes FROM poll_category_item WHERE cat_id='$catid' ORDER BY votes DESC";
                    $resultI = mysqli_query($con, $sqlI) or die("Database error. Error: ".mysqli_error($con));
                    
                    while($rowI = mysqli_fetch_assoc($resultI)):
                        
                ?>
                    <div class="item-container">
                        <i class='fa fa-image'></i>
                        <div class="item-contents">
                            <h5 style='text-align: left !important;'><?php echo $rowI['name']; ?></h5>
                            <div class="div-btn">
                                <p><?php echo "Votes: " ?></p>
                                <span class='text-primary'><?php echo $rowI['votes']."</span>"; ?>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php endwhile; ?>


                <?php else: ?>
                    <p style='font-size: 15px; color: #6d6d6d; padding-top: 10px;'>There are no final results yet.</p>
                <?php endif; ?>
            <?php
                 else:
            ?>

            <form>
            <?php 

                $id = $_GET['pollid'];

                $sql = "SELECT * FROM poll_category WHERE poll_id='$id'";
                $result = mysqli_query($con, $sql) or die("Database error. Error: ".mysqli_error($con));
                
                if(!$result) {
                    header("Location: dashboard.php");
                    exit();
                }

                while($row = mysqli_fetch_assoc($result)):

            ?>
            <?php
                $catid = $row['id'];
                $catname = $row['name'];

            ?>
                <span style='display: none;' id='poll-id'><?php echo $id; ?></span>
                <div class='cat-container'>
                    <div class="cat-header">
                        <h4 class='catname'><?php echo $catname; ?> | <small>Please choose <?php echo $row['max_selection']; ?> item(s)</small></h4>
                        <div class="div-counter"><span class='counter' id="counter<?php echo $catid; ?>">0</span> out of <span id='maxcou<?php echo $catid; ?>'><?php echo $row['max_selection']; ?></span></div>
                    </div>
                <?php

                    $sqlI = "SELECT id, name, description FROM poll_category_item WHERE cat_id='$catid'";
                    $resultI = mysqli_query($con, $sqlI) or die("Database error. Error: ".mysqli_error($con));
                    
                    while($rowI = mysqli_fetch_assoc($resultI)):
                        
                ?>
                    <div class="item-container">
                        <i class='fa fa-image'></i>
                        <div class="item-contents">
                            <h5><?php echo $rowI['name']; ?></h5>
                            <div class="div-btn">
                                <?php 
                                    if(empty($rowI['description'])) {
                                        echo "<p class='desc-hide'>. . .</p>";
                                    } else {
                                        echo "<p class='desc-hide'>".$rowI['description']."</p>";
                                    }
                                ?>
                                <input type='button' id="<?php echo $rowI['id']."-".$catid; ?>" class='btn btn-success btn-vote' value="VOTE"/>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php endwhile; ?>
            </form>
            <div class="bottom">
                <hr />
                <button type="button" id='submit' class='btn btn-primary'>CAST VOTES</button>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="js/main.js"></script>
    <script src="js/js-toggle.js"></script>
</body>
<script>
    $(document).ready(function() {

        $("#submit").click(function() {
            var sure = confirm("Please click OK to confirm your vote.");
            
            if(sure) {
                var id = $("#poll-id").html();
                
                var flag = 0;
                $(".counter").each(function() {
                    if(parseInt($(this).html()) == 0) {
                        alert("There are some categories that you have not voted yet. Please review.");
                        flag = 1;
                    }
                });
                if(flag == 0) {
                    var votes = [];
                    $(".btn-vote").each(function() {
                        votes.push($(this).val());
                    });
                    $.post("php/member-castvotes.php",
                    {
                        votes: votes,
                        id: id
                    },
                    function(data, status) {
                        if(data == "Success!") {
                            alert("Your vote was submitted successfully.")
                            window.location = window.location;
                        } else {
                            alert(data);
                        }
                    });
                }
            }
        });

        $(document).on('click', '.btn-vote', function() {

            var id = $(this).attr("id");
            var itemid = id.split("-")[0];
            var catid = id.split("-")[1];

            if($(this).attr("value") == "VOTE") {

                var counter = parseInt($("#counter"+catid+"").html());
                var max = parseInt($("#maxcou"+catid+"").html());

                if(counter == max) {
                    alert("You have reached the maximum selections for this category.");
                } else {
                    $("#"+id+"").attr("value", "CANCEL");
                    $("#"+id+"").removeClass("btn-success");
                    $("#"+id+"").addClass("btn-danger");

                    var counter = parseInt($("#counter"+catid+"").html());
                    counter++;
                    $("#counter"+catid+"").html(counter);
                }


            } else {

                $("#"+id+"").attr("value", "VOTE");
                $("#"+id+"").removeClass("btn-danger");
                $("#"+id+"").addClass("btn-success");
                var counter = parseInt($("#counter"+catid+"").html());
                counter--;
                $("#counter"+catid+"").html(counter);

            }
        });
    });
</script>
</html>