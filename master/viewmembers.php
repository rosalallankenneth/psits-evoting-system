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
    <title>PSITS E-Voting | View members</title>

    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/mobile.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-viewmembers.css" />
    <link rel="stylesheet" href="../css/styles-masters/mobile/mob-viewmembers.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-modal.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />

    <script src="../js/jquery-3.4.1.js"></script>
    <script src="../js/js-master-modal.js"></script>
    <script>
        $(document).ready(function() {
            $('li:nth-child(3) div').addClass('menu-selected');
        });
    </script>
    
</head>

<body>
    <?php require_once '../includes/master-dashboard.inc.php' ?>

    <?php
        if(isset($_GET['addmember']) && isset($_SESSION['addmember'])) {
            echo "<div class='alert-success'>".$_SESSION['addmember']."</div>";
            unset($_SESSION['addmember']);
        }
        if(isset($_GET['editmember']) && isset($_SESSION['editmember'])) {
            echo "<div class='alert-success'>".$_SESSION['editmember']."</div>";
            unset($_SESSION['editmember']);
        }
        if(isset($_GET['editerror']) && isset($_SESSION['editerror'])) {
            echo "<div class='alert-warning'>".$_SESSION['editerror']."</div>";
            unset($_SESSION['editerror']);
        }
        if(isset($_GET['delete']) && isset($_SESSION['deleted'])) {
            echo "<div class='alert-warning'>A member with the ID: ".$_SESSION['deleted']." was permanently deleted.</div>";
            unset($_SESSION['deleted']);
        }
        if(isset($_GET['error']) && isset($_SESSION['error_add'])) {
            echo "<div class='alert-danger'>".$_SESSION['error_add']."</div>";
            unset($_SESSION['error_add']);
        }
        if(isset($_GET['resetpass']) && isset($_SESSION['resetpass'])) {
            echo "<div class='alert-warning'>Password reset was successful for a member with the ID: ".$_SESSION['resetpass']."</div>";
            unset($_SESSION['resetpass']);
        }
    ?>

        <div class="content">
            <div class='title'>
                <h2>PSITS Members <small>- S.Y. 2019-2020</small></h2>
                <div class='total'>Total<?php

                        require_once 'PHP/dbh.inc.php';

                        $sql = "SELECT idnum, lastname, firstname, midname, course_name, year, email, last_access FROM member INNER JOIN course ON member.course_id = course.id ORDER BY lastname";
                        
                        if(isset($_GET['search'])) {

                            $item = trim(mysqli_real_escape_string($con, $_GET['search']));
                            if(strlen($item) > 20) {
                                $cut = substr($item, 0, 20);
                                echo " search results for '$cut...' ";
                            } else {
                                echo " search results for '$item' ";
                            }

                            $sql = "SELECT idnum, lastname, firstname, midname, course_name, year, email, last_access FROM member INNER JOIN course ON member.course_id = course.id WHERE idnum LIKE '%$item%' OR lastname LIKE '%$item%' OR lastname LIKE '%$item%' OR firstname LIKE '%$item%' OR midname LIKE '%$item%' OR course_name LIKE '%$item%' OR year LIKE '%$item%' OR email LIKE '%$item%' OR last_access LIKE '%$item%' ORDER BY lastname";
                        }

                        $result = mysqli_query($con, $sql) or die("Unable to display data. Error: ".mysqli_error($con));
                        $count = mysqli_num_rows($result);
                        
                        echo ": <b>$count</b>";
                    ?></div>
            </div>
            <hr />
            <div class='topbar'>
                <div class='search-field'>
                    <form action="PHP/master-search.php">
                        <input type="text" name='search-item' id='search-item' placeholder='Search...' <?php 
                        if(isset($_GET['search'])) {
                            $item = $_GET['search']; echo "value='$item'";
                        }
                        ?>/>
                        <button type="submit" name='search'><i class='fa fa-search'></i></button>
                    </form>
                </div>
                <form class='topbar-inner' action='viewmembers.php'>
                    <button type="submit" name='submit' id='f5'><i class='fa fa-refresh'></i> &nbspRefresh</button>
                </form>
            </div>
            <div class="tab">
                
            <table>
                <tr style='background: #d41a1a !important; color: #fff;'>
                    <th>ID number</th>
                    <th>Last name</th>
                    <th>First name</th>
                    <th>Middle name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Email</th>
                    <th>Last access</th>
                    <th>Action</th>
                </tr>
                
                <?php

                if($count == 0) {
                    echo "</table><div class='results'>There are no results for your query.</div>"; exit();
                }

                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                            echo "<td>".$row['idnum']."</td>";
                            echo "<td>".$row['lastname']."</td>";
                            echo "<td>".$row['firstname']."</td>";
                            if(empty($row['midname'])) {
                                echo "<td>N/A</td>";
                            } else {
                                echo "<td>".$row['midname']."</td>";
                            }
                            echo "<td>".$row['course_name']."</td>";
                            echo "<td>".$row['year']."</td>";
                            echo "<td>".$row['email']."</td>";
                            if(empty($row['last_access'])) {
                                echo "<td>N/A</td>";
                            } else {
                                echo "<td>".$row['last_access']."</td>";
                            }
                            echo "<td><a class='btn btn-sm btn-outline-primary table-btn' href='viewmembers.php?editid=".$row['idnum']."'>Edit</a><a class='btn btn-sm btn-outline-danger table-btn' href='PHP/deletemember.php?idnum=".$row['idnum']."'>Delete</a><a class='btn btn-sm btn-outline-warning table-btn' href='PHP/changepass.php?idnum=".$row['idnum']."'>Reset pwd</a></td>";
                        echo "</tr>";
                    }

                ?>
                
                <tr style='background: #a02323 !important; color: #fff;'>
                    <th>ID number</th>
                    <th>Last name</th>
                    <th>First name</th>
                    <th>Middle name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Email</th>
                    <th>Last access</th>
                    <th>Action</th>
                </tr>
            </table>
            
            </div>
            <a href="#top" id='gototop'>TOP</a>
            <button id='addbtn'>ADD MEMBER</button>

            <?php
                    $count = 0;
                    $rowE;

                    if(isset($_GET['editid'])) {
                        $id = $_GET['editid'];
                        $sql = "SELECT idnum, lastname, firstname, midname, course_name, course_id, year, email, last_access FROM member INNER JOIN course ON member.course_id = course.id WHERE idnum='$id'";
                        $resultE = mysqli_query($con, $sql) or die("Unable to display data. Error: ".mysqli_error($con));
                        $count = mysqli_num_rows($resultE);
                        $rowE = mysqli_fetch_assoc($resultE);
                    }

            ?>

            <div id="panel">
                <i class="fa fa-close" id='exitbtn'></i>
                <h4 class='panel-title'><?php if($count > 0) {
                    echo "Update a member";
                } else {
                    echo "Add a member";
                } ?></h4>
                

                <form action="<?php if($count > 0) {
                    echo "PHP/editmember.php?idOrig=".$rowE['idnum']."&emailOrig=".$rowE['email'];
                } else {
                    echo "PHP/addmember.php";
                } ?>" method='POST'>

                    <input style='color: #ffd200;' name='idnum' type='number' placeholder='ID number' value='<?php if($count > 0) echo $rowE['idnum']; ?>' /><br>
                    <input name='lname' type='text' placeholder='Last name' value='<?php if($count > 0) echo $rowE['lastname']; ?>' /><br>
                    <input name='fname' type='text' placeholder='First name' value='<?php if($count > 0) echo $rowE['firstname']; ?>' /><br>
                    <input name='mname' type='text' placeholder='Middle name (optional)' value='<?php if($count > 0) echo $rowE['midname']; ?>' /><br>
                    <label name='lbl-course'>Course</label>
                    <select name='course' placeholder='Course' >
                        <option value="1" <?php if($count > 0) if($rowE['course_id'] == "1") echo "selected"; ?> >BSIT</option>
                        <option value="2" <?php if($count > 0) if($rowE['course_id'] == "2") echo "selected"; ?> >BSCS</option>
                    </select>
                    <label name='lbl-year'>Year</label>
                    <select name='year' placeholder='Year' >
                        <option value="1" <?php if($count > 0) if($rowE['year'] == "1") echo "selected"; ?> >1</option>
                        <option value="2" <?php if($count > 0) if($rowE['year'] == "2") echo "selected"; ?> >2</option>
                        <option value="3" <?php if($count > 0) if($rowE['year'] == "3") echo "selected"; ?> >3</option>
                        <option value="4" <?php if($count > 0) if($rowE['year'] == "4") echo "selected"; ?> >4</option>
                    </select><br>
                    <input name='email' type="text" placeholder='Email' value='<?php if($count > 0) echo $rowE['email']; ?>' />
                    <input class='btn btn-outline-warning' type="submit" name='submit' value='<?php if($count > 0) echo "UPDATE MEMBER"; else echo "ADD MEMBER"; ?>' />

                </form>
                <form id='panel-reset' action='viewmembers.php'>
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
                window.location = "viewmembers.php?click=btnadd";
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