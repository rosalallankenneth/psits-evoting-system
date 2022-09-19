<?php
    session_start();

    if(isset($_SESSION['master-username'])) {
        header("Location: dashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PSITS E-Voting | Login</title>

    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/mobile.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-login.css" />

    <script src="../js/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function(){
            $('li:nth-child(1) div').addClass('menu-selected');
        });
    </script>
    
</head>

<body>
    <?php require_once '../includes/master-sidebar.inc.php' ?>

        <div class="content">
            <h1>E-VOTING<small>SYSTEM</small></h1>
            <hr />
            <?php
                if(isset($_GET['error']) && isset($_SESSION['master_login_error'])) {
                    echo "<div class='alert-danger'>".$_SESSION['master_login_error']."</div>";
                    unset($_SESSION['master_login_error']);
                }
            ?>
            <form action="PHP/master-login.php" class="form-master-login" method='POST'>
                <h5>MASTER USERS LOGIN</h5>
                <input type="text" name='username' placeholder='Username' />
                <input type="password" name='password' placeholder='Password' /><br>
                <input type="submit" name='login' placeholder='LOGIN' />
            </form>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/js-toggle.js"></script>
</body>

</html>