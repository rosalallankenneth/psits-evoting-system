<?php

    $masterid = $_SESSION['master-username'];

    echo <<< ENDSTRING
    
    <form id='modal' action='PHP/master-change-acc.php' method='POST'>
        <header>
            <h4>USER ACCOUNT SETTINGS</h4>
            <div id='btn-exit'>x</div>
        </header>
        <hr />

ENDSTRING;

    if(isset($_SESSION['change_error']) && isset($_GET['change_error'])) {
        echo "<div class='alert-danger'>";
        echo $_SESSION['change_error'];
        echo "</div>";
        unset($_SESSION['change_error']);
    }
    if(isset($_SESSION['master_change_userid_pass']) && isset($_GET['change_username_pass'])) {
        echo "<div class='alert-success'>";
        echo $_SESSION['master_change_userid_pass'];
        echo "</div>";
        unset($_SESSION['master_change_userid_pass']);
    }

    echo <<< ENDSTRING

        <h4 id='form-title'>Update your username and password</h4>
        <input class='modal-input' type='text' name='username' placeholder='Username' value='$masterid' />
        <input class='modal-input' type='password' name='oldpass' placeholder='Old password' />
        <input class='modal-input' type='password' name='newpass' placeholder='New password' />
        <input class='modal-input' type='password' name='retypepass' placeholder='Retype new password' /><br>
        <input type='submit' name='update-info' value='Update' />
    </form>

ENDSTRING;

?>