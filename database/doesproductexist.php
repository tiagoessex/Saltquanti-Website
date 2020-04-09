<?php
    /* ************************************
        checks if product exists
        if p1(name,category,brand) == p2(name,category,brand) then
            duplicated => return id
        else
            return -1

        called by: newproduct.php, editproduct.php, editproductparticipant.php
    ************************************ */
	require_once '../settings/config.php';
	
	$link = db_start();

    // making sure
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// check if product already exists
        $sql = "SELECT * FROM " . DB_TABLE_FOOD . " WHERE name = '" . $_POST["name"] . "' and category = '" . $_POST["category"] . "' and brand = '" . $_POST["brand"] . "'LIMIT 1";

        $query = mysqli_query($link, $sql);
    
        if (!$query) {
            die(mysqli_error($link));
        }

        if ($query->num_rows == 0) {
            die('-1');
        }

        $row = mysqli_fetch_array($query);
        echo $row["id"];
        die();
    }