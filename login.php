<?php
    session_start();

    if(isset($_SESSION['userid'])) {
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

    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/mobile.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/styles-members/css-register.css" />
    <link rel="stylesheet" href="css/styles-members/css-login.css" />
    <link rel="stylesheet" href="css/styles-members/mobile/mob-register.css" />

    <script src="js/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function(){
            $('li:nth-child(2) div').addClass('menu-selected');
        });
    </script>
    
</head>

<body>
    <?php require_once 'includes/sidebar.inc.php' ?>

        <?php
            if(isset($_GET['register']) && isset($_SESSION['registered'])) {
                echo "<div class='alert-success'>".$_SESSION['registered']."</div>";
                unset($_SESSION['registered']);
            }
        ?>
        <?php
            if(isset($_GET['error']) && isset($_SESSION['login_error'])) {
                echo "<div class='alert-danger'>".$_SESSION['login_error']."</div>";
                unset($_SESSION['login_error']);
            }
        ?>

        <div class="content">
            <div class="form-area">
                <h1>E-VOTING</h1>
                <p>SYSTEM</p>
                
                <div class='form-desc'>
                    Please login to vote.
                </div>
                <form action="php/member-login.php" method="POST">
                    <input type='number' name='idnumber' class='form-group' placeholder='ID number' /> <br>
                    <input type='password' name='password' class='form-group' placeholder='Password' /><br>
                    <input type='submit' name='submit' value='LOGIN' />
                    <div id='register-label'>or <a href='index.php'>register</a></div>
                </form>
            </div>
            <div class="pic-area">
                <a href="imgs/sign 5.jpg"><img src="imgs/5.jpg" alt="image1"></a>
                <a href="imgs/sign 6.jpg"><img src="imgs/6.jpg" alt="image2"></a>
                <a href="imgs/sign 7.jpg"><img src="imgs/7.jpg" alt="image3"></a>
                <a href="imgs/sign 8.jpeg"><img src="imgs/8.jpg" alt="image4"></a>
            </div>
        </div>
        <footer class="instruct-area">
            <div class='title'>
                System Instructions
            </div>
            1. Before voting, login with your registered ID number and password in the login form.<br>
            2. If your ID number is not registered yet, click the register label button to go to the register page.
        </footer> 
    </div>
    <script src="js/main.js"></script>
    <script src="js/js-toggle.js"></script>
</body>

</html>