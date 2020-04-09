<?php
  	/* ************************************
    	delete all non validated users

    	called by: validateusers.php
  	************************************ */
	include('../isAdmin.php');
    require_once '../settings/config.php';     
    $link = db_start();
    $sql = "DELETE FROM " . DB_TABLE_USERS . " WHERE validationdate IS NULL OR validationdate = ''"; 
   	$query = mysqli_query($link, $sql);
    if (!$query) {
        die(mysqli_error($link));
    }
    echo "ok";