<?php
    session_start();

    if(!(isset($_SESSION['loggedin']))) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PSITS E-Voting | User Account</title>

    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/mobile.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/styles-members/css-user-account.css" />
    <link rel="stylesheet" href="css/styles-members/mobile/mob-user-account.css" />

    <script src="js/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function(){
            $('li:nth-child(2) div').addClass('menu-selected');
        });
    </script>
    <script src="js/js-user-account.js"></script>

</head>

<body>
    <?php require_once 'includes/dashboard.inc.php' ?>
        <div class="content">

            <p>USER ACCOUNT INFORMATION</p>
            <hr />
            <?php
                if(isset($_SESSION['mnameEdit']) && isset($_GET['changeMname'])) {
                    echo "<div class='alert-success'>";
                    echo $_SESSION['mnameEdit'];
                    echo "</div>";
                    unset($_SESSION['mnameEdit']);
                }
            ?>
            <div class="info-box">

                <?php
                    require_once 'includes/dbh.inc.php';

                    $idnum = $_SESSION['userid'];

                    $sql = "SELECT idnum, midname, lastname, course_name, firstname, year, email FROM member INNER JOIN course ON member.course_id = course.id WHERE idnum='$idnum'";
                    $result =  mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));

                    while($row = mysqli_fetch_assoc($result)):

                ?>

                <div>ID number: <div><?php echo $row['idnum']; ?></div></div>
                <div>Middle name: <div><span id='btn-mname'>edit</span><span id='mname'><?php echo $row['midname']; ?><span></div></div>
                <div>Lastname: <div><?php echo $row['lastname']; ?></div></div>
                <div>Course: <div><?php echo $row['course_name']; ?></div></div>
                <div>Firstname: <div><?php echo $row['firstname']; ?></div></div>
                <div>Year: <div><?php echo $row['year']; ?></div></div>

            </div>
            
            <div class="info-small">*Some of your information are uneditable to avoid falsification or misrepresentation of your data. Please contact your system administrator for any erroneous information.</div>
            <hr />
            
            <?php
                if(isset($_SESSION['change_error']) && isset($_GET['change_error'])) {
                    echo "<div class='alert-danger'>";
                    echo $_SESSION['change_error'];
                    echo "</div>";
                    unset($_SESSION['change_error']);
                }
                if(isset($_SESSION['change_success']) && isset($_GET['change_pass_mail'])) {
                    echo "<div class='alert-success'>";
                    echo $_SESSION['change_success'];
                    echo "</div>";
                    unset($_SESSION['change_success']);
                }
            ?>

            <div class="password-form">
                <div class='form-title'>CHANGE YOUR PASSWORD AND EMAIL HERE</div>

                <form>
                    <div>Old password: <input type="password" name='old-pass' placeholder='type here'/></div>
                    <div>New password: <input type="password" name='new-pass' placeholder='type here'/></div>
                    <div>Retype new password: <input type="password" name='new-pass-retype' placeholder='type here' /></div>
                    <div>Email: <input type="text" name='email' value="<?php echo $row['email']; ?>"></div>
                    <div id='controls'><input type='button' id='change-reset' value='RESET'/><input type="button" id='change-submit' name='submit' value='SUBMIT' /></div>
                    

                    <?php endwhile; ?>
                </form>
            </div>

        </div>

    </div>
    <script src="js/main.js"></script>
    <script src="js/js-toggle.js"></script>
</body>

</html>