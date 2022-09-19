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
    <title>PSITS E-Voting | Register</title>

    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/mobile.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/styles-members/mobile/mob-register.css" />
    <link rel="stylesheet" href="css/styles-members/css-register.css" />

    <script src="js/jquery-3.4.1.js"></script>

    <script>
        $(document).ready(function(){
            $('li:nth-child(1) div').addClass('menu-selected');
        });
    </script>

</head>

<body>
    <?php require_once 'includes/sidebar.inc.php' ?>

        <?php
            if(isset($_GET['error']) && isset($_SESSION['reg_error'])) {
                echo "<div class='alert-danger'>".$_SESSION['reg_error']."</div>";
                unset($_SESSION['reg_error']);
            }
        ?>

        <div class="content">
            <div class="form-area">
                <h1>E-VOTING</h1>
                <p>SYSTEM</p>
                
                <div class='form-desc'>
                    Please register to login.
                </div>
                <form action="php/member-register.php" method="POST">
                    <input type='number' name='idnumber' class='form-group' placeholder='ID number' /> <br>
                    <input type='password' name='password' class='form-group' placeholder='Password' /><br>
                    <input type='submit' name='submit' value='REGISTER' />
                </form>
            </div>
            <div class="pic-area">
                <a href="imgs/sign 1.jpg"><img src="imgs/1.jpg" alt="image1"></a>
                <a href="imgs/sign 2.jpeg"><img src="imgs/2.jpg" alt="image2"></a>
                <a href="imgs/sign 3.jpg"><img src="imgs/3.jpg" alt="image3"></a>
                <a href="imgs/sign 4.jpg"><img src="imgs/4.jpg" alt="image4"></a>
            </div>
        </div>
        <footer class="instruct-area">
            <div class='title'>
                System Instructions
            </div>
                1. Enter your ID number and a password with at least 6 characters (letters and numbers only).<br>
                2. Click the register button to verify your input and proceed to the login page.<br>
                3. If your ID number is not recognized and this isn’t supposed to happen, contact your system’s administrator.
        </footer>
    </div>
    <script src="js/main.js"></script>
    <script src="js/js-toggle.js"></script>
</body>

</html>