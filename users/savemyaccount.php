<?php
    /* ************************************
        update user's own account

        called by: myaccount.php
    ************************************ */
    include('../isParticipant.php');
	require_once '../settings/config.php';
	
	$link = db_start();

    // making sure
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Define variables and initialize with empty values
        $password = "";
        $firstname = "";
        $lastname = "";
        $email = "";
        $phone = "";
        $address = "";
        $city = "";
        $zip = "";
        $country = "";
        $comments = "";

        // extra validations
		$password = trim($_POST['password']);
      
            
        $sql = "UPDATE " . DB_TABLE_USERS . " SET  
                password = ?, 
                firstname = ?,
                lastname = ?, 
                email = ?, 
                phone = ?,                     
                address = ?, 
                city = ?, 
                zip = ?, 
                country = ?,
                comments = ?
                WHERE id = '" . $_POST["id"] . "'";
        

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_password, $param_firstname, $param_lastname,  $param_email, $param_phone, $param_address, $param_city, $param_zip, $param_country,$param_comments);

            // Set parameters
            $param_password = $password;
            $param_firstname = trim($_POST['firstname']);
            $param_lastname = trim($_POST['lastname']);
            $param_email = trim($_POST['email']);
            $param_address = trim($_POST['address']);
            $param_city = trim($_POST['city']);
            $param_zip = $_POST['zip'];
            $param_country = $_POST['country'];
 			$param_phone = $_POST['phone'];
            $param_comments = trim($_POST['comments']);

            if (!mysqli_stmt_execute($stmt)) {
                die("Execute failed: (" . $link->errno . ") " . $link->error);
            }
            
            mysqli_stmt_close($stmt);    

            } else {
                die("Prepare failed: (" . $link->errno . ") " . $link->error);
            }
	}
	echo "ok";
    die();