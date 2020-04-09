<?php
  	/* ************************************
    	save single produtct

    	called by: newproduct.php
  	************************************ */
	include('../isParticipant.php');
	require_once '../settings/config.php';
	$link = db_start();

	// Define variables and initialize with empty values
	//$id = $_POST["id"];
	$name = trim($_POST["name"]);
	$name = preg_replace('!\s+!', ' ', $name);
	$category = trim($_POST["category"]);
	$category = preg_replace('!\s+!', ' ', $category);
	$subcategory1 = trim($_POST["subcategory1"]);
	$subcategory1 = preg_replace('!\s+!', ' ', $subcategory1);
	$subcategory2 = trim($_POST["subcategory2"]);
	$subcategory2 = preg_replace('!\s+!', ' ', $subcategory2);
	$subcategory3 = trim($_POST["subcategory3"]);
	$subcategory3 = preg_replace('!\s+!', ' ', $subcategory3);
	$wherecollected = trim($_POST["wherecollected"]);
	$wherecollected = preg_replace('!\s+!', ' ', $wherecollected);
	//$collectiondate = $_POST["collectiondate"];
    if (!isset($_POST["collectiondate"]) || empty($_POST["collectiondate"]) || is_null($_POST["collectiondate"])) {
        $collectiondate = NULL;
    } else {
        $collectiondate = date("Y-m-d", strtotime($_POST["collectiondate"]));
    }
	$source = trim($_POST["source"]);
	$source = preg_replace('!\s+!', ' ', $source);
	$salt = $_POST["salt"];
	$notes = trim($_POST["notes"]);
	$notes = preg_replace('!\s+!', ' ', $notes);
	// automatically set today's date
	$dt = new DateTime();
	$entrydate = $dt->format('Y-m-d');
	$whoinserted = $_POST["whoinserted"];
	$brand = trim($_POST["brand"]);
	$brand = preg_replace('!\s+!', ' ', $brand);
	$subbrand = trim($_POST["subbrand"]);
	$subbrand = preg_replace('!\s+!', ' ', $subbrand);
	$teor = $_POST["teor"];

	$salt = floatval(str_replace(',', '.', $salt));

    // making sure
	if ($_SERVER["REQUEST_METHOD"] == "POST") {


		$sql = "INSERT INTO " . DB_TABLE_FOOD . " (id, name, category, subcategory1, subcategory2, subcategory3, collectiondate, wherecollected, source, salt, validationdate, whovalidated, comments, entrydate, whoinserted, brand, subbrand, teor ) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
               
        	mysqli_stmt_bind_param($stmt, "sssssssssssssss", $param_name, $param_category, $param_subcategory1, $param_subcategory2, $param_subcategory3, $param_collectiondate, $param_wherecollected, $param_source, $param_salt, $param_notes, $param_entrydate, $param_whoinserted, $param_brand, $param_subbrand, $param_teor);


            
            $param_name = $name;
            $param_category = $category;
            $param_subcategory1 = $subcategory1;
            $param_subcategory2 = $subcategory2;
            $param_subcategory3 = $subcategory3;
            $param_collectiondate = $collectiondate;
            $param_wherecollected = $wherecollected;
            $param_source = $source;
            $param_salt = $salt;
            $param_notes = $notes;
            $param_entrydate = $entrydate;
            $param_whoinserted = $whoinserted;
            $param_brand = $brand;
            $param_subbrand = $subbrand;
            $param_teor = $teor;
            
			if (!mysqli_stmt_execute($stmt)) {
				die("Execute failed: (" . $link->errno . ") " . $link->error);
			}
            mysqli_stmt_close($stmt);

		} else {
			die("Prepare failed: (" . $link->errno . ") " . $link->error);
		}
	}
	echo "ok";
