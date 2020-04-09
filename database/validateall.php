<?php
    /* ************************************
        validate all non validated products

        called by: validateproducts.php
    ************************************ */
    include('../isAdmin.php');
    require_once '../settings/config.php';     
    $link = db_start();
    $dt = new DateTime();
    $date = $dt->format('Y-m-d');
    $sql = "UPDATE " . DB_TABLE_FOOD . " SET whovalidated = '" . $_POST["username"] . "',  validationdate = '" . $date . "' WHERE validationdate IS NULL OR validationdate = ''"; 
   	$query = mysqli_query($link, $sql);
    if (!$query) {
        echo  "Error: " . mysqli_error($link);
        die();
    }
    echo "ok";
    die();