<?php

function display($grp) {

    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d");
    $today = explode("-", $date);
    $intY = (int) $today[0];
    $open = "0"; $close = "0";

    $dateset = isset($_SESSION['open-date']) && isset($_SESSION['close-date']);

    if($dateset) {
        $open = explode("-", $_SESSION['open-date']);
        $close = explode("-", $_SESSION['close-date']);
    }

    echo "<select class='mm' name='mm".$grp."'>";

    $mm = array(
        array("01","January"), array("02","February"), array("03","March"),
        array("04","April"), array("05","May"), array("06","June"),
        array("07","July"), array("08","August"), array("09","September"),
        array("10","October"), array("11","November"), array("12","December")
    );

    foreach($mm as $m) {
        if($dateset && $grp == 1 && $m[0] == $open[1]) {
            echo "<option value='".$m[0]."' selected >".$m[1]."</option>";
        } else if($dateset && $grp == 2 && $m[0] == $close[1]) {
            echo "<option value='".$m[0]."' selected >".$m[1]."</option>";
        } else if($today[1] == $m[0] && !$dateset) {
            echo "<option value='".$m[0]."' selected >".$m[1]."</option>";
        } else {
            echo "<option value='".$m[0]."'>".$m[1]."</option>";
        }
    }

    echo "</select>";
    echo "<label class='dash'>-</label>";
    echo "<select class='dd' name='dd".$grp."'>";

    $dd = array(
        "01","02","03","04","05","06","07","08","09","10",
        "11","12","13","14","15","16","17","18","19","20",
        "21","22","23","24","25","26","27","28","29","30","31"
    );
    
    foreach($dd as $d) {
        if($dateset && $grp == 1 && $d == $open[2]) {
            echo "<option value='".$d."' selected >".$d."</option>";
        } else if($dateset && $grp == 2 && $d == $close[2]) {
            echo "<option value='".$d."' selected >".$d."</option>";
        } else if($today[2] == $d && !$dateset) {
            echo "<option value='".$d."' selected >".$d."</option>";
        } else {
            echo "<option value='".$d."'>".$d."</option>";
        }
    }       

    echo "</select>";
    echo "<label class='dash'>-</label>";
    echo "<select class='yy' name='yy".$grp."'>";
        if($dateset && $grp == 1) {
            if($today[0] == $open[0]) {
                echo "<option value='".$today[0]."' selected >".$today[0]."</option>";
                echo "<option value='".$intY++."'>".$intY++."</option>";
            } else {
                echo "<option value='".$today[0]."'>".$today[0]."</option>";
                echo "<option value='".$intY++."' selected >".$intY++."</option>";
            }
        } else if($dateset && $grp == 2) {
            if($today[0] == $close[0]) {
                echo "<option value='".$today[0]."' selected >".$today[0]."</option>";
                echo "<option value='".$intY++."'>".$intY++."</option>";
            } else {
                echo "<option value='".$today[0]."'>".$today[0]."</option>";
                echo "<option value='".$intY++."' selected >".$intY++."</option>";
            }
        } else {
            echo "<option value='".$today[0]."'>".$today[0]."</option>";
            echo "<option value='".$intY++."'>".$intY++."</option>";
        }
    echo "</select>";

}


?>