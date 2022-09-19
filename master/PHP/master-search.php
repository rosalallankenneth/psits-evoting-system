<?php

    require_once 'dbh.inc.php';

    if(isset($_GET['search'])) {
        $item = $_GET['search-item'];

        header("Location: ../viewmembers.php?search=$item");
    }