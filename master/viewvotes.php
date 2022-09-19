<?php
    session_start();
    
    if(!(isset($_SESSION['master-username']))) {
        header("Location: master/index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PSITS E-Voting | View votes</title>

    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/mobile.css" />
    <link rel="stylesheet" href="../css/styles-members/css-vote.css" />
    <link rel="stylesheet" href="../css/styles-members/mobile/mob-vote.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-modal.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />

    <script src="../js/jquery-3.4.1.js"></script>
    <script src="../js/js-master-modal.js"></script>
    
</head>

<body>
    <?php
        require_once '../includes/master-dashboard.inc.php';
        require '../includes/dbh.inc.php';

        $id = $_GET['viewpoll'];

        $sql = "SELECT * FROM poll WHERE id='$id'";
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
        $dateopen = $row['date_open'];
        $create = $row['creator_id'];
        $edit = $row['last_editor_id'];
    ?>

        <div class="content">

            <div class="title">
                <h4 style='display: inline-block'><a href="dashboard.php">Dashboard</a> / <?php echo $title; ?></h4>
                <a style='float: right;' id='backtodash' href="dashboard.php">Back to dashboard</a>
            </div>
            <hr />



            <p style='text-align: left; font-size: 15px; margin-bottom: 5px; color: #6d6d6d;'>Created by:  
                <?php
                    $sqlcr = "SELECT username FROM committee WHERE id='$create'";
                    $resultcr = mysqli_query($con, $sqlcr) or die("Database error: ".mysqli_error($con));
                    $rowcr = mysqli_fetch_assoc($resultcr);
                    $createdby = $rowcr['username'];

                    echo $createdby;
                ?>
            </p>
            <p style='text-align: left; font-size: 15px; margin-bottom: 5px; color: #6d6d6d;'>Edited by: 
                <?php
                    $sqled = "SELECT username FROM committee WHERE id='$edit'";
                    $resulted = mysqli_query($con, $sqled) or die("Database error: ".mysqli_error($con));
                    $rowed = mysqli_fetch_assoc($resulted);
                    $editedby = $rowed['username'];

                    echo $editedby;
                ?>
            </p>



            <h5 style='text-align: center; padding-top: 20px;'>Poll results<br>
                <?php
                    if($dateclose < $today):
                ?>
                    <p style='font-size: 15px; color: #6d6d6d; padding: 10px;'>Voting was closed on 
                    <?php
                        $datevoted = date("F j, Y", strtotime($dateclose));    
                        echo $datevoted;
                    ?>
                    </p>

                    <?php else: ?>
                        <p style='font-size: 15px; color: #6d6d6d; padding: 10px;'>Voting is open on  
                        <?php
                            $dateO = date("F j, Y", strtotime($dateopen));    
                            echo $dateO;
                        ?> until 
                        <?php
                            $dateC = date("F j, Y", strtotime($dateclose));    
                            echo $dateC;
                        ?>
                        </p>
                <?php endif; ?>

                <p style='text-align: left; font-size: 18px; margin-bottom: 5px !important;'>Total votes: <span class='text-primary'>
                    <?php 
                        $sqlrev = "SELECT vote_id FROM vote_details WHERE poll_id='$id'";
                        $resultrev = mysqli_query($con, $sqlrev) or die("Database error: ".mysqli_error($con));
                        $countrev = mysqli_num_rows($resultrev);
                        
                        echo $countrev;
                    ?></span><br>
                </p>
                <div style='text-align: left; padding: 0; margin: 0;'>
                    <a href='allvotes.php?id=<?php echo $id; ?>' style='text-align: left; font-size: 15px;'>Click here to view all</a>
                </div>

                <?php
                    $sqlcat = "SELECT * FROM poll_category WHERE poll_id='$id'";
                    $resultcat = mysqli_query($con, $sqlcat) or die("Database error: ".mysqli_error($con));

                    while($rowcat = mysqli_fetch_assoc($resultcat)):
                ?>

                <?php
                    $catid = $rowcat['id'];
                    $catname = $rowcat['name'];

                    ?>
                    <div style='margin-top: 20px !important; text-align: left; margin-top: 40px !important;' class='cat-container'>
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

                <div id='cover'><div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <?php require_once '../master/PHP/modal-useracc.php'; ?>
    <script src="../js/js-toggle.js"></script>
</body>

</html>