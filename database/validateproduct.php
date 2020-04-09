<?php
    /* ************************************
        validate single product

        called by: editproduct.php, validateproducts.php
    ************************************ */
    include('../isAdmin.php');
    require_once '../settings/config.php';     
    $link = db_start();
    $dt = new DateTime();
    $date = $dt->format('Y-m-d');
    $sql = "UPDATE " . DB_TABLE_FOOD . " SET whovalidated = '" . $_POST["username"] . "',  validationdate = '" . $date . "' WHERE id = '".$_POST["id"]."'"; 
   	$query = mysqli_query($link, $sql);
    if (!$query) {
        $error = true;
        echo  "Error: " . mysqli_error($link);
        die();
    }
    echo "ok";
    die();