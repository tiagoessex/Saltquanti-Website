<?php
    /* ************************************
        delete single user by id

        called by: manageusers.php, myaccount.php, validateusers.php
    ************************************ */
    include('../isParticipant.php');
    require_once '../settings/config.php';     
    $link = db_start();
    $sql = "DELETE FROM " . DB_TABLE_USERS . " WHERE id = '".$_POST["id"]."'"; 
   	$query = mysqli_query($link, $sql);
    if (!$query) {
        die(mysqli_error($link));
    }
    if (mysqli_affected_rows($link) > 0) {
        echo "ok";
        die();
    } else {
        die("error");
    }