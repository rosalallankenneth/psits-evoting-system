<?php

    echo <<< ENDSTRING
        
        <div class="sidebar">
            <i class='fa fa-close sidebarxbtn'></i>
            <div class="logo">
                <img src="imgs/ccs logo.png" alt="PSITS logo" />
            </div>

            <div class='user-side'>No user is currently logged in.</div>

            <ul>
                <li>
                    <a href="index.php"><div><i class='fa fa-user-plus'></i> REGISTER</div></a>
                </li>
                <li>
                    <a href="login.php"><div><i class='fa fa-sign-in'></i> LOGIN</div></a>
                </li>
            </ul>
            
            <div class='side-footer' id='mu-footer'>
                <img src='imgs/mu logo.png' alt='MU logo' />
                <span id='span1'>MISAMIS <br>UNIVERSITY</span>
            </div>
        </div>

        <div></div>

        <div class='main'>
            <div class="header">
                <i class='fa fa-bars'></i>
                <span id='psits'>PHILIPPINE SOCIETY OF INFORMATION TECHNOLOGY STUDENTS</span>
            </div>
ENDSTRING;

?>