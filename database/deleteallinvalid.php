<?php
    /* ************************************
        delete all non validated products

        called by: validateproducts.php
    ************************************ */
    include('../isParticipant.php');
    require_once '../settings/config.php';     
    $link = db_start();
    $sql = "DELETE FROM " . DB_TABLE_FOOD . " WHERE validationdate IS NULL OR validationdate = ''"; 
   	$query = mysqli_query($link, $sql);
    if (!$query) {
        echo "Error: " . mysqli_error($link);
        die();
    }
    echo "ok";
    die();