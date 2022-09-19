<?php

    require_once 'dbh.inc.php';

    if(isset($_POST['search'])) {
        $item = $_POST['search-item'];

        header("Location: ../viewmasters.php?search=$item");
    }