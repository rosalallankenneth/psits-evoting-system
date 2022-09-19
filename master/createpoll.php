<?php
    session_start();
    
    if(!(isset($_SESSION['master-username']))) {
        header("Location: master/index.php");
    }

    if(!isset($_GET['editdetails'])) {
        unset($_SESSION['poll-title']);
        unset($_SESSION['poll-desc']);
        unset($_SESSION['open-date']);
        unset($_SESSION['close-date']);
    }

    unset($_SESSION['catnames']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PSITS E-Voting | Create poll</title>

    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/mobile.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-createpoll.css" />
    <link rel="stylesheet" href="../css/styles-masters/mobile/mob-createpoll.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-modal.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />

    <script src="../js/jquery-3.4.1.js"></script>
    <script src="../js/js-master-modal.js"></script>
    <script>
        $(document).ready(function(){
            $('li:nth-child(2) div').addClass('menu-selected');
        });
    </script>
    
</head>

<body>
    <?php require_once '../includes/master-dashboard.inc.php' ?>

        <div class="content">

            <h1>E-VOTING<small>SYSTEM</small></h1>
            <hr />
            <?php
                if(isset($_GET['error']) && isset($_SESSION['create_poll_error'])) {
                    echo "<div class='alert-danger'>".$_SESSION['create_poll_error']."</div>";
                    unset($_SESSION['create_poll_error']);
                }
                if(isset($_GET['savepoll']) && isset($_SESSION['savepoll'])) {
                    echo "<div class='alert-success'>".$_SESSION['savepoll']."</div>";
                    unset($_SESSION['savepoll']);
                }
                if(isset($_GET['create_cat_error']) && isset($_SESSION['create_cat_error'])) {
                    echo "<div class='alert-danger'>".$_SESSION['create_cat_error']."</div>";
                    unset($_SESSION['create_cat_error']);
                }
            ?>
            <div id='create-label'>Create poll</div>

            <div class="steps-box">
                <div class='step-label'><div id="icon1">1</div><span>Provide poll details</span></div></a>
                <div class='step-label'><div id="icon2">2</div><span>Create poll contents</span></div>
            </div>
            <form action='PHP/master-poll-details.php' method='POST' class="form-poll-details">
                <div class="form-group1">
                    <label for="poll-title">Poll title</label>
                    <input type='text' name='poll-title' placeholder='limit to 60 characters only' value='<?php if(isset($_SESSION['poll-title'])) echo $_SESSION['poll-title']; ?>' />
                    <label for="poll-desc">Poll Description</label>
                    <input type='text' name='poll-desc' placeholder='limit to 120 characters only' value='<?php if(isset($_SESSION['poll-desc'])) echo $_SESSION['poll-desc']; ?>' />
                </div>
                <div class="form-group2">
                    <label for="date-open">Opening date</label>
                    <div class="date">
                        <?php
                            require_once '../includes/displaydate.inc.php';
                            display("1");    
                        ?>
                    </div>

                    <label for="date-close">Closing date</label>
                    <div class="date">
                        <?php
                            display("2");
                        ?>
                    </div>
                </div>
                <div class="btn-container">
                    <input type='submit' name='btn-next' id='btn-next' value='NEXT'/>
                </div>
            </form>
            <div id='cover'><div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <?php require_once '../master/PHP/modal-useracc.php'; ?>
    <script src="../js/js-toggle.js"></script>
</body>

</html>