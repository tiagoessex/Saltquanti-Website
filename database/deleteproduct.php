<?php
    /* ************************************
        delete single product by id

        called by: editproduct.php, manageproducts.php, validateproducts.php
    ************************************ */
    include('../isParticipant.php');
    require_once '../settings/config.php';     
    $link = db_start();
    $sql = "DELETE FROM " . DB_TABLE_FOOD . " WHERE id = '".$_POST["id"]."' LIMIT 1"; 
   	$query = mysqli_query($link, $sql);
    if (!$query) {
        $error = true;
        die(mysqli_error($link));
    }
    echo "ok";
    die();