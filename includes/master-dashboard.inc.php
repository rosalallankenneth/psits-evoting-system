<?php

    echo <<< ENDSTRING
        
        <div class="sidebar">
            <i class='fa fa-close sidebarxbtn'></i>
            <div class="logo">
                <img src="../imgs/ccs logo.png" alt="PSITS logo" />

            </div>

            <div class='user-side' style="color: #fff; font-size: 12px !important; padding: 5px 10px !important;
 padding-left: 5px; margin: 5px 5px !important; width: 200px; text-align: left;"><i class='fa fa-user' style="font-size: 20px; margin-left: 5px;"></i> <span style="overflow: hidden; margin-left: 5px;">
ENDSTRING;

    echo $_SESSION['master-username'];

    echo <<< ENDSTRING
            </span><i class='fa fa-cog' id='master-useracc' style="font-size: 20px; margin-left: 10px;"></i>
            </div>

            <ul>
                <li>
                    <a href="dashboard.php"><div><i class='fa fa-home'></i> DASHBOARD</div></a>
                </li>
                <li>
                    <a href="createpoll.php"><div><i class='fa fa-tasks'></i> CREATE POLL</div></a>
                </li>
                <li>
                    <a href="viewmembers.php"><div><i class='fa fa-users'></i> VIEW MEMBERS</div></a>
                </li>
                <li>
                <a href="viewmasters.php"><div><i class='fa fa-lock'></i> VIEW MASTERS</div></a>
                </li>
                <li>
                    <a href="../master/PHP/master-logout.php"><div><i class='fa fa-sign-out'></i> LOGOUT</div></a>
                </li>
            </ul>
            
            <div class='side-footer' id='mu-footer'>
                <img src='../imgs/mu logo.png' alt='MU logo' />
                <span id='span'>MISAMIS UNIVERSITY</span>
            </div>
        </div>

        <div></div>
        
        <div class='main'>
            <div id='top' class="header">
                <i class='fa fa-bars'></i>
                <span id='psits'>PHILIPPINE SOCIETY OF INFORMATION TECHNOLOGY STUDENTS</span>
            </div>
ENDSTRING;

?>