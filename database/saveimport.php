<?php
    /* ************************************
        save/update multiple produts

        called by: import.php
    ************************************ */
    include('../isParticipant.php');
	require_once '../settings/config.php';
    include('../settings/defaults.php');
    include('../settings/saved.php');
	
function Exists($name, $category, $brand, $conn) {
	   // check if product already exists
        $sqla = "SELECT * FROM " . DB_TABLE_FOOD . " WHERE name = '" . $name . "' and category = '" . $category . "' and brand = '" . $brand . "'LIMIT 1";

        $querya = mysqli_query($conn, $sqla);
    
        if (!$querya) {
            die(mysqli_error($link));
        }

        if ($querya->num_rows > 0) {
        	$rowa = mysqli_fetch_array($querya);
       		return $rowa["id"];
        }
        return -1;
}

	$link = db_start();

	$rows = 0;
	$stmt = null;
	$stmt_update = null;

    // making sure
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$data = json_decode($_POST["data"]);




		// **************************************************
		$sql_update = "UPDATE " . DB_TABLE_FOOD . " SET 
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
                    WHERE id = ?";

        	if ($stmt_update = mysqli_prepare($link, $sql_update)) {
               
        		mysqli_stmt_bind_param($stmt_update, "ssssssssssssssis", $param_name, $param_category, $param_subcategory1, $param_subcategory2, $param_subcategory3, $param_collectiondate, $param_wherecollected, $param_source, $param_salt, $param_notes, $param_updatedate, $param_whoupdated, $param_brand, $param_subbrand,$param_id,$param_teor);
			} else {
            	die("Prepare failed: (" . $link->errno . ") " . $link->error);
        	}
        	// **************************************************




		
		$sql = "INSERT INTO " . DB_TABLE_FOOD . " (id, name, category, subcategory1, subcategory2, subcategory3, collectiondate, wherecollected, source, salt, validationdate, whovalidated, comments, entrydate, whoinserted, brand, subbrand,teor ) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
               
        	mysqli_stmt_bind_param($stmt, "sssssssssssssss", $param_name, $param_category, $param_subcategory1, $param_subcategory2, $param_subcategory3, $param_collectiondate, $param_wherecollected, $param_source, $param_salt, $param_notes, $param_entrydate, $param_whoinserted, $param_brand, $param_subbrand, $param_teor);
        } else {
			die("error2");
		}



        $fields = array();	
		foreach ($data as $key => $jsons) { // This will search in the 2 jsons
			
			$fields["name"] = "";
			$fields["category"] = "";
			$fields["salt"] = "";
			$fields["subcategory1"] = "";
			$fields["subcategory2"] = "";
			$fields["subcategory3"] = "";
			$fields["brand"] = "";
			$fields["subbrand"] = "";
			$fields["collectiondate"] = "";
			$fields["wherecollected"] = "";
			$fields["source"] = "";
			$fields["comments"] = "";
			$dt = new DateTime();
			$fields["entrydate"] = $dt->format('Y-m-d');
			$fields["whoinserted"] = "";
            $fields["teor"] = "";


     		foreach($jsons as $key => $value) {
     			$fields[$key] = $value;
    		}
 
            $param_name = !empty($fields["name"])?trim($fields["name"]):"";
            $param_name = preg_replace('!\s+!', ' ', $param_name);
            $param_category = !empty($fields["category"])?trim($fields["category"]):"";
            $param_category = preg_replace('!\s+!', ' ', $param_category);
            $param_subcategory1 = !empty($fields["subcategory1"])?trim($fields["subcategory1"]):"";
            $param_subcategory1 = preg_replace('!\s+!', ' ', $param_subcategory1);
            $param_subcategory2 = !empty($fields["subcategory2"])?trim($fields["subcategory2"]):"";
            $param_subcategory2 = preg_replace('!\s+!', ' ', $param_subcategory2);
            $param_subcategory3 = !empty($fields["subcategory3"])?trim($fields["subcategory3"]):"";
            $param_subcategory3 = preg_replace('!\s+!', ' ', $param_subcategory3);
            if (!isset($fields["collectiondate"]) || empty($fields["collectiondate"]) || is_null($fields["collectiondate"])) {
        		$param_collectiondate = NULL;
    		} else {
        		$param_collectiondate = date("Y-m-d", strtotime($fields["collectiondate"]));
    		}
            $param_wherecollected = !empty($fields["wherecollected"])?$fields["wherecollected"]:"";
            $param_source = !empty($fields["source"])?trim($fields["source"]):"";
            $param_source = preg_replace('!\s+!', ' ', $param_source);
            $salt = floatval(str_replace(',', '.', $fields['salt']));
            $param_salt = $salt;
            $param_notes = !empty($fields["notes"])?trim($fields["notes"]):"";
            $param_notes = preg_replace('!\s+!', ' ', $param_notes);
            $param_entrydate = !empty($fields["entrydate"])?$fields["entrydate"]:"";
            $param_whoinserted = isset($_POST["username"])?$_POST["username"]:"";
            $param_brand = !empty($fields["brand"])?trim($fields["brand"]):"";
            $param_brand = preg_replace('!\s+!', ' ', $param_brand);
            $param_subbrand = !empty($fields["subbrand"])?trim($fields["subbrand"]):"";
            $param_subbrand = preg_replace('!\s+!', ' ', $param_subbrand);
            $param_updatedate = $param_entrydate;
	        $param_whoupdated = isset($_POST["username"])?$_POST["username"]:"";


            if (!empty($fields["teor"])) {
                $param_teor = $fields["teor"];
            } else {
                if ( $salt < $LIMIT_SAL_ORANGE_FOOD) {
                    $param_teor = "BAIXO";
                } else if ( $salt > $LIMIT_SAL_RED_FOOD) {
                    $param_teor = "ALTO";
                } else {
                    $param_teor = "MÉDIO";
                }
            }


            if ($_POST["duplicate"] == "true") {
	            if (mysqli_stmt_execute($stmt)) {
	            	$rows += 1;
	            } else {
	            	die("error1");
	            }
			} else {
				$param_id = Exists($param_name, $param_category, $param_brand, $link);
				if (intval($param_id) > -1) {
					if (mysqli_stmt_execute($stmt_update)) {
	            		$rows += 1;
	            	} else {
	            		die("error1");
	            	}
	            } else {
	            	if (mysqli_stmt_execute($stmt)) {
	            		$rows += 1;
	            	} else {
	            		die("error1");
	            	}
	            }
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_stmt_close($stmt_update);
		echo $rows;		
	}
?>
