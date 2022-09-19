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
    <title>PSITS E-Voting | View masters</title>

    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/mobile.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-viewmembers.css" />
    <link rel="stylesheet" href="../css/styles-masters/mobile/mob-viewmembers.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-viewmasters.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-modal.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />

    <script src="../js/jquery-3.4.1.js"></script>
    <script src="../js/js-master-modal.js"></script>
    <script>
        $(document).ready(function() {
            $('li:nth-child(4) div').addClass('menu-selected');
        });
    </script>
    
</head>

<body>
    <?php require_once '../includes/master-dashboard.inc.php' ?>

    <?php
        if(isset($_GET['addmaster']) && isset($_SESSION['addmaster'])) {
            echo "<div class='alert-success'>".$_SESSION['addmaster']."</div>";
            unset($_SESSION['addmaster']);
        }
        if(isset($_GET['editmaster']) && isset($_SESSION['editmaster'])) {
            echo "<div class='alert-success'>".$_SESSION['editmaster']."</div>";
            unset($_SESSION['editmaster']);
        }
        if(isset($_GET['masterediterror']) && isset($_SESSION['masterediterror'])) {
            echo "<div class='alert-warning'>".$_SESSION['masterediterror']."</div>";
            unset($_SESSION['masterediterror']);
        }
        if(isset($_GET['deletemaster']) && isset($_SESSION['deletedmaster'])) {
            echo "<div class='alert-warning'>A master with the username: ".$_SESSION['deletedmaster']." was permanently deleted.</div>";
            unset($_SESSION['deletedmaster']);
        }
        if(isset($_GET['mastererror']) && isset($_SESSION['mastererror_add'])) {
            echo "<div class='alert-danger'>".$_SESSION['mastererror_add']."</div>";
            unset($_SESSION['mastererror_add']);
        }
        if(isset($_GET['masterresetpass']) && isset($_SESSION['masterresetpass'])) {
            echo "<div class='alert-warning'>Password reset was successful for a member with the ID: ".$_SESSION['masterresetpass']."</div>";
            unset($_SESSION['masterresetpass']);
        }

    ?>

        <div class="content">
            <div class='title'>
                <h2>PSITS COMMITTEE <small>- master users</small></h2>
                <div class='total'>Total<?php

                        require_once 'PHP/dbh.inc.php';

                        $sql = "SELECT committee.id, username, position_id, name, last_access FROM committee INNER JOIN committee_position ON committee_position.id = committee.position_id";
                        
                        if(isset($_GET['search'])) {

                            $item = trim(mysqli_real_escape_string($con, $_GET['search']));
                            if(strlen($item) > 20) {
                                $cut = substr($item, 0, 20);
                                echo " search results for '$cut...' ";
                            } else {
                                echo " search results for '$item' ";
                            }

                            $sql = "SELECT committee.id, username, position_id, name, last_access FROM committee INNER JOIN committee_position ON committee_position.id = committee.position_id WHERE committee.id LIKE '%$item%' OR username LIKE '%$item%' OR name LIKE '%$item%' OR last_access LIKE '%$item%'";
                        }

                        $result = mysqli_query($con, $sql) or die("Unable to display data. Error: ".mysqli_error($con));
                        $count = mysqli_num_rows($result);
                        
                        echo ": <b>$count</b>";
                    ?></div>
            </div>
            <hr />
            <div class='topbar'>
                <div class='search-field'>
                    <form action="PHP/comm-search.php" method='POST'>
                        <input type="text" name='search-item' id='search-item' placeholder='Search...' <?php 
                        if(isset($_GET['search'])) {
                            $item = $_GET['search']; echo "value='$item'";
                        }

                        $userid = $_SESSION['master-username'];
                        $sqlm = "SELECT position_id FROM committee WHERE username='$userid'";
                        $resultm = mysqli_query($con, $sqlm) or die("Database error: ".mysqli_error($con));
                        $rowm = mysqli_fetch_assoc($resultm);
                        $masterpos = $rowm['position_id'];
                        
                        ?>/>
                        <button type="submit" name='search'><i class='fa fa-search'></i></button>
                    </form>
                </div>
                <form class='topbar-inner' action='viewmasters.php'>
                    <button type="submit" name='submit' id='f5'><i class='fa fa-refresh'></i> &nbspRefresh</button>
                </form>
            </div>
            <div class="tab">
            <table>
                <tr style='background: #d41a1a !important; color: #fff;'>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Position</th>
                    <th>Last access</th>
                    <?php if($masterpos > 1) echo "<th>Action</th>"; ?>
                </tr>

                <?php
                        
                        $sqlID = "SELECT id FROM committee ORDER BY id DESC LIMIT 1";
                        $resultID = mysqli_query($con, $sqlID) or die("Unable to display data. Error: ".mysqli_error($con));
                        $rowID = mysqli_fetch_assoc($resultID);
                        $newID = (int) $rowID['id'];
                        $newID = $newID + 1;

                ?>

                <?php

                if($count == 0) {
                    echo "</table><div class='results'>There are no results for your query.</div>"; exit();
                }

                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td>".$row['name']."</td>";
                            if(empty($row['last_access'])) {
                                echo "<td>N/A</td>";
                            } else {
                                echo "<td>".$row['last_access']."</td>";
                            }
                            if($masterpos > 1) {
                                if($row['username'] == $_SESSION['master-username']) {
                                    echo "<td>&nbsp - - -</td>";
                                } else {
                                    echo "<td><a class='btn btn-sm btn-outline-primary table-btn' href='viewmasters.php?editid=".$row['id']."'>Edit</a><a class='btn btn-sm btn-outline-danger table-btn' href='PHP/comm-delete.php?username=".$row['username']."'>Delete</a></td>";
                                }
                            }
                        echo "</tr>";
                    }

                ?>

            </table>
            </div>
            <a href="#top" id='gototop'>TOP</a>
            <?php if($masterpos > 1) echo "<button id='addbtn'>ADD MASTER USER</button>"; ?>

            <?php
                    $count = 0;
                    $rowE;

                    if(isset($_GET['editid'])) {
                        $id = $_GET['editid'];
                        $sql = "SELECT id, username, position_id FROM committee WHERE id='$id'";
                        $resultE = mysqli_query($con, $sql) or die("Unable to display data. Error: ".mysqli_error($con));
                        $count = mysqli_num_rows($resultE);
                        $rowE = mysqli_fetch_assoc($resultE);
                    }

            ?>

            <div id="panel">
                <i class="fa fa-close" id='exitbtn'></i>
                <h4 class='panel-title'><?php if($count > 0) {
                    echo "Update a master user";
                } else {
                    echo "Add a master user";
                } ?></h4>
                

                <form action="<?php if($count > 0) {
                    echo "PHP/comm-edit.php?usernameOrig=".$rowE['username'];
                } else {
                    echo "PHP/comm-add.php";
                } ?>" method='POST'>
                    
                    <input name='username' type='text' placeholder='Username' value='<?php if($count > 0) echo $rowE['username']; ?>' /><br>
                    <input name='password' type='text' placeholder='<?php if($count > 0) echo "New password (leave blank if no changes)"; else echo "Token/Password" ?>' />
                    <label name='lbl-position'>Position</label>
                    <select name='position' placeholder='Position' >
                        <option value="1" <?php if($count > 0) if($rowE['position_id'] == "1") echo "selected"; ?> >OFFICER</option>
                        <option value="2" <?php if($count > 0) if($rowE['position_id'] == "2") echo "selected"; ?> >ADVISER</option>
                        <option value="3" <?php if($count > 0) if($rowE['position_id'] == "3") echo "selected"; ?> >DEAN</option>
                    </select>
                    <input class='btn btn-outline-warning' type="submit" name='submit' value='<?php if($count > 0) echo "UPDATE MASTER USER"; else echo "ADD MASTER USER"; ?>' />

                </form>
                <form id='panel-reset' action='viewmasters.php'>
                    <input style='width: 100px; padding' type="submit" name='submit' value='Reset' class='btn btn-outline-info btn-sm' />
                </form>
            </div>

            <div id='cover'><div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/js-toggle.js"></script>
    <?php require_once '../master/PHP/modal-useracc.php'; ?>
    <script>
        $(document).ready(function() {
            $("#addbtn").click(function() {
                window.location = "viewmasters.php?click=btnadd";
            });
            $("#exitbtn").click(function() {
                $("#panel").removeClass("slider");
            });
        });
    </script>
    <script>
        var loc = decodeURIComponent(window.location.search.substring(1));

        if(loc.indexOf("editid") !== -1) {
            $("#panel").addClass("slider");
        }
        if(loc.indexOf("click") !== -1) {
            $("#panel").addClass("slider");
        }
    </script>
</body>

</html>