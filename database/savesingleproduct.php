<?php
    /* ************************************
        save/update single product

        called by: import.php
    ************************************ */
    include('../isParticipant.php');
	require_once '../settings/config.php';
    include('../settings/defaults.php');
    include('../settings/saved.php');

	$link = db_start();

	$data =  json_decode($_POST["data"], true);

	// Define variables and initialize with empty values
	$name = isset($data["name"])?trim($data["name"]):"";
    $name = preg_replace('!\s+!', ' ', $name);
	$category = isset($data["category"])?trim($data["category"]):"";
    $category = preg_replace('!\s+!', ' ', $category);
	$subcategory1 = isset($data["subcategory1"])?trim($data["subcategory1"]):"";
    $subcategory1 = preg_replace('!\s+!', ' ', $subcategory1);
	$subcategory2 = isset($data["subcategory2"])?trim($data["subcategory2"]):"";
    $subcategory2 = preg_replace('!\s+!', ' ', $subcategory2);
	$subcategory3 = isset($data["subcategory3"])?trim($data["subcategory3"]):"";
    $subcategory3 = preg_replace('!\s+!', ' ', $subcategory3);
    if (!isset($data["collectiondate"]) || empty($data["collectiondate"]) || is_null($data["collectiondate"])) {
        $collectiondate = NULL;
    } else {
        $collectiondate = date("Y-m-d", strtotime($data["collectiondate"]));
    }
	$wherecollected = isset($data["wherecollected"])?trim($data["wherecollected"]):"";
    $wherecollected = preg_replace('!\s+!', ' ', $wherecollected);
	$source = isset($data["source"])?trim($data["source"]):"";
    $source = preg_replace('!\s+!', ' ', $source);
	$salt = isset($data["salt"])?$data["salt"]:"";
	$notes = isset($data["notes"])?trim($data["notes"]):"";
    $notes = preg_replace('!\s+!', ' ', $notes);
	// automatically set today's date
	$dt = new DateTime();
	$entrydate = $dt->format('Y-m-d');
	$whoinserted =isset($data["whoinserted"])?$data["whoinserted"]:"";
	$brand = isset($data["brand"])?trim($data["brand"]):"";
    $brand = preg_replace('!\s+!', ' ', $brand);
	$subbrand = isset($data["subbrand"])?trim($data["subbrand"]):"";
    $subbrand = preg_replace('!\s+!', ' ', $subbrand);

    if (isset($data["teor"])) {
        $teor = $data["teor"];
    } else {
        if ( $salt < $LIMIT_SAL_ORANGE_FOOD) {
            $teor = "BAIXO";
        } else if ( $salt > $LIMIT_SAL_RED_FOOD) {
            $teor = "ALTO";
        } else {
            $teor = "MÉDIO";
        }
    }


    $salt = floatval(str_replace(',', '.', $salt));

		// check if product already exists
        $sql = "SELECT * FROM " . DB_TABLE_FOOD . " WHERE name = '" . $name . "' and category = '" . $category . "' and brand = '" . $brand . "'LIMIT 1";

        $query = mysqli_query($link, $sql);
    
        if (!$query) {
            die(mysqli_error($link));
        }

        if ($query->num_rows == 0) {
            $exists = false;
        } else {
        	$exists = true;
        	 $row = mysqli_fetch_array($query);
       		 $id = $row["id"];
        }


    // making sure
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if ($_POST["duplicate"] == "true" || !$exists) {

		$sql = "INSERT INTO " . DB_TABLE_FOOD . " (id, name, category, subcategory1, subcategory2, subcategory3, collectiondate, wherecollected, source, salt, validationdate, whovalidated, comments, entrydate, whoinserted, brand, subbrand, teor ) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
               
        	mysqli_stmt_bind_param($stmt, "ssssssssdssssss", $param_name, $param_category, $param_subcategory1, $param_subcategory2, $param_subcategory3, $param_collectiondate, $param_wherecollected, $param_source, $param_salt, $param_notes, $param_entrydate, $param_whoinserted, $param_brand, $param_subbrand, $param_teor);


            
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

		echo "ok";
		die();
	} else {

			$sql = "UPDATE " . DB_TABLE_FOOD . " SET 
                    name = ?, 
                    category = ?, 
                    subcategory1 = ?, 
                    subcategory2 = ?, 
                    subcategory3 = ?, 
                    collectiondate = ?, 
                    wherecollected = ?, 
                    source = ?, 
                    salt = ?, 
                    comments = ?, 
                    updatedate = ?, 
                    whoupdated = ?, 
                    brand = ?,
                    subbrand = ?,
                    teor = ?,
                    validationdate = NULL,
                    whovalidated = NULL 
                    WHERE id = " . $id;

        	if ($stmt = mysqli_prepare($link, $sql)) {
               
        		mysqli_stmt_bind_param($stmt, "sssssssssssssss", $param_name, $param_category, $param_subcategory1, $param_subcategory2, $param_subcategory3, $param_collectiondate, $param_wherecollected, $param_source, $param_salt, $param_notes, $param_updatedate, $param_whoupdated, $param_brand, $param_subbrand, $param_teor);


            
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
	            $param_updatedate = $entrydate;
	            $param_whoupdated = $_POST["username"];
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

        	echo "ok";
			die();
	}
}
