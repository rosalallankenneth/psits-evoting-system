<?php

    echo <<< ENDSTRING
        
        <div class="sidebar">
            <i class='fa fa-close sidebarxbtn'></i>
            <div class="logo">
                <img src="imgs/ccs logo.png" alt="PSITS logo" />
            </div>

            <div class='user-side'>User: <span>
ENDSTRING;

    echo $_SESSION['userid'];

    echo <<< ENDSTRING
            </span>
            </div>

            <ul>
                <li>
                    <a href="dashboard.php"><div><i class='fa fa-home'></i> DASHBOARD</div></a>
                </li>
                <li>
                    <a href="user-account.php"><div><i class='fa fa-user'></i> USER ACCOUNT</div></a>
                </li>
                <li>
                    <a href="php/member-logout.php"><div><div><i class='fa fa-sign-out'></i> LOGOUT</div></a>
                </li>
            </ul>
            
            <div class='side-footer' id='mu-footer'>
                <img src='imgs/mu logo.png' alt='MU logo' />
                <span id='span'>MISAMIS UNIVERSITY</span>
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