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
    <title>PSITS E-Voting | Create poll</title>

    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/mobile.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-createpoll.css" />
    <link rel="stylesheet" href="../css/styles-masters/mobile/mob-createpoll.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-createpoll-content.css" />
    <link rel="stylesheet" href="../css/styles-masters/mobile/mob-createpoll-content.css" />
    <link rel="stylesheet" href="../css/styles-masters/css-modal.css" />

    <script src="../js/jquery-3.4.1.js"></script>
    <script src="../js/js-master-modal.js"></script>
    <script>
        $(document).ready(function(){
            $('li:nth-child(2) div').addClass('menu-selected');
        });
    </script>
    
</head>

<body>
    <?php require_once '../includes/master-dashboard.inc.php' ?>

        <div class="content">

            <h1>E-VOTING<small>SYSTEM</small></h1>
            <hr />
            <?php
                if(isset($_GET['createpoll_error']) && isset($_SESSION['createpoll_error'])) {
                    echo "<div class='alert-danger'>".$_SESSION['createpoll_error']."</div>";
                    unset($_SESSION['createpoll_error']);
                }
                if(isset($_GET['create_cat_error']) && isset($_SESSION['create_cat_error'])) {
                    echo "<div class='alert-danger'>".$_SESSION['create_cat_error']."</div>";
                    unset($_SESSION['create_cat_error']);
                }
                if(isset($_GET['savepoll']) && isset($_SESSION['savepoll'])) {
                    echo "<div class='alert-success'>".$_SESSION['savepoll']."</div>";
                    unset($_SESSION['savepoll']);
                }
            ?>
            <div id='create-label'>Create poll</div>

            <div class="steps-box">
                <div class='step-label'>
                    <div id="icon1">
                        <a href='createpoll.php?editdetails=back'>1</a>
                    </div>
                    <span>                                          
                        <a href='createpoll.php?editdetails=back'>Provide poll details</a>
                    </span>
                </div>
                <div class='step-label'><div id="icon2">2</div><span>Create poll contents</span></div>
            </div>

            
            <div class='form-group' id='form-cat'>
                <?php
                    if(isset($_SESSION['catnames']) && isset($_GET['create'])):
                ?>
                    <form action='PHP/master-savepoll.php?numofcat=<?php echo $_GET['num']; ?>' method='POST'>
                        <input type='number' id='cat-counter' value='<?php echo $_GET['num']; ?>' />
                <?php
                    $catnames = explode("-", $_SESSION['catnames']);
                    for($x = 0; $x < count($catnames)-1; $x++):
                ?>  
                    <input type="number" class='hidden-fields' name='counter[]' id='counter<?php echo $x; ?>' value='0' />
                        <h4 class='lbl-catnames'> <?php echo $catnames[$x]; ?><small> (choices)</small></h4>
                        <table class="table table-bordered items-list" id='items-field<?php echo $x; ?>'>
                            <tr>
                                <td>
                                    <input type="text" name="items<?php echo $x; ?>[]" placeholder="Enter item name" class="form-control first-fields">
                                    <hr id='desc-div'/>
                                    <input type="text" name="descs<?php echo $x; ?>[]" placeholder="Enter item description (optional)" class="form-control desc">
                                    <button type="button" class="btn-photo btn">Upload photo...</button>
                                    <label for="btn">(This feature is currently unavailable)</label>
                                </td>

                                <td><button type="button" name='add-item' id='<?php echo $x; ?>' class='btn btn-success btn-add-item'>Add more</button></td>
                            </tr>
                            <tr id="max<?php echo $x; ?>">
                                <td>Maximum no. of selections <small class='text-danger'>(positive whole number)</small></td>
                                <td><input class="selection max" name="max[]" type="number" value="1" /></td>
                            </tr>
                        </table>

                    <?php endfor; ?>

                    <input type="submit" name='submit' id='btn-create' value='Create poll' class="btn btn-primary btn-create-poll"/>
                    </form>
                    <br><br><br>
                    <small class='text-danger'>Remember to check if all inputs are valid and all the required fields are filled up to be able to successfully create the poll. Maximum selections should not be greater than the number of the actual items and a category must have at least one(1) named item in its list.</small>
                    <hr>

                <?php else: ?>

                <?php unset($_SESSION['catnames']); ?>
                    <h5>Category names <small>(ex. President, Vice-pres, etc.)</small></h5>
                    <form action='PHP/master-catnames.php' method='POST'>
                        <table class="table table-bordered" id='dynamic-field'>
                            <tr>
                                <td><input type="text" name="name[]" placeholder="Enter name" class="form-control"></td>
                                <td><button type="button" name='add' id='add' class='btn btn-success'>Add more</button></td>
                            </tr>
                        </table>
                        <input type="submit" name='submit' id='submit' value='Create category forms' class="btn btn-primary btn-create-cat"/>
                    </form>
                
                <?php endif; ?>
            </div>
            <div id='cover'><div>
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script src="../js/js-toggle.js"></script>
    <?php require_once '../master/PHP/modal-useracc.php'; ?>
</body>

</html>

<script>
    var i = 1;
    var ii = [];
    var catnum = $('#cat-counter').attr("value");

    for(var x = 0; x < catnum; x++) {
        ii.push(0);
    }

    $(document).ready(function() {
        $('#add').click(function() {
            i++;
            $("#dynamic-field").append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter name" class="form-control"></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn-remove">X</button></td></tr>');

            $(document).on('click', '.btn-remove', function() {
                var button_id = $(this).attr("id");
                $("#row"+button_id+"").remove();
            });
        });

        $(document).on('click', '.btn-add-item', function() {
            var button_id = $(this).attr("id");
            ii[button_id]++;
            $("#max"+button_id+"").before('<tr id="row'+button_id+'-'+ii[button_id]+'"><td><input type="text" name="items'+button_id+'[]" placeholder="Enter item name" class="form-control"><hr id="desc-div"/><input type="text" name="descs'+button_id+'[]" placeholder="Enter item description" class="form-control desc"><button type="button" class="btn-photo btn">Upload photo...</button> <label for="btn"> (This feature is currently unavailable)</label></td><td><button type="button" name="remove-item" id="'+button_id+'-'+ii[button_id]+'" class="btn btn-danger btn-remove-item">X</button></td></tr>');
            
            var ini = parseInt($("#counter"+button_id+"").attr("value"));
            ini++;
            $("#counter"+button_id+"").attr("value", ini);

        });

        $(document).on('click', '.btn-remove-item', function() {
            var button_id = $(this).attr("id");
            $("#row"+button_id+"").remove();

            var cat_id = button_id.split("-");

            var ini = parseInt($("#counter"+cat_id[0]+"").attr("value"));
            ini--;
            $("#counter"+cat_id[0]+"").attr("value", ini);
        }); 

    });
</script>