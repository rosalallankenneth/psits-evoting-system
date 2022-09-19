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
    <title>PSITS E-Voting | All votes</title>

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

        $id = $_GET['id'];

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
                <a style='float: right;' id='backtodash' href="viewvotes.php?viewpoll=<?php echo $id; ?>">Back to results</a>
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



            <h5 style='text-align: center; padding-top: 20px;'>All vote records<br>
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
                <div class="tab">
                <table style='font-size: 18px !important; font-weight: normal !important; text-align: left; width: 100%; margin-top: 40px;'>
                <tr style='padding: 10px 0 !important; border-bottom: 1px #6d6d6d solid;'>
                    <th style='padding-bottom: 10px !important; font-size: 15px;'>ID number</th>
                    <th style='padding-bottom: 10px !important; font-size: 15px;'>Last name</th>
                    <th style='padding-bottom: 10px !important; font-size: 15px;'>First name</th>
                    <th style='padding-bottom: 10px !important; font-size: 15px;'>Date voted</th>
                </tr>
                    <?php
                        $sqlcat = "SELECT member_id, date_voted FROM vote_details WHERE poll_id='$id'";
                        $resultcat = mysqli_query($con, $sqlcat) or die("Database error: ".mysqli_error($con));

                        while($rowcat = mysqli_fetch_assoc($resultcat)):
                    ?>
                    <?php
        
                        $idnum = $rowcat['member_id'];
                        $sqli = "SELECT idnum, lastname, firstname FROM member WHERE idnum='$idnum'";
                        $resulti = mysqli_query($con, $sqli) or die("Database error: ".mysqli_error($con));
                        $rowi = mysqli_fetch_assoc($resulti);
                        $idnum = $rowi['idnum'];
                        $lname = $rowi['lastname'];
                        $fname = $rowi['firstname'];
                        $datevoted = date("F j, Y", strtotime($rowcat['date_voted']));

                    ?>
                    <tr style='padding: 10px 0 !important;'>
                        <td style='padding: 10px 0 !important;'><?php echo $idnum; ?></td>
                        <td style='padding: 10px 0 !important;'><?php echo $lname; ?></td>
                        <td style='padding: 10px 0 !important;'><?php echo $fname; ?></td>
                        <td style='padding: 10px 0 !important;'><?php echo $datevoted ?></td>
                    </tr>
                    <?php endwhile; ?>
                    
                </table>
                </div>
            <div id='cover'><div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <?php require_once '../master/PHP/modal-useracc.php'; ?>
    <script src="../js/js-toggle.js"></script>
</body>

</html>