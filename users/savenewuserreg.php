<?php
    /* ************************************
        create and save new user by new user

        called by: newuserreg.php
    ************************************ */
	require_once '../settings/config.php';
	
	$link = db_start();

    // making sure
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// check if username already exists
		$sql = "SELECT id FROM " . DB_TABLE_USERS . " WHERE username = ?";

		if ($stmt = mysqli_prepare($link, $sql)) {
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_username);

			// Set parameters
			$param_username = trim($_POST["username_1A"]);

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				/* store result */
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt) == 1) {
                        echo "usernameerror";
                        die();
                    } else {
                        $username = trim($_POST["username_1A"]);
                    }
                }
            }

            mysqli_stmt_close($stmt);



            // alles gut => save user
            $username = "";
            $password = "";
            $firstname = "";
            $lastname = "";
            $email = "";
            $phone = "";
            $administrator = 0;
            $address = "";
            $city = "";
            $zip = "";
            $country = "";
            $comments = "";
            $dt = new DateTime();
            $date = $dt->format('Y-m-d');

 
            $sql = "INSERT INTO " . DB_TABLE_USERS . " (id, username, password, date, firstname, email, phone, administrator, lastname, address, city, zip, country, comments) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($link, $sql)) {

                mysqli_stmt_bind_param($stmt, "ssssssissssss", $param_username, $param_password, $param_date, $param_firstname, $param_email, $param_phone, $param_administrator, $param_lastname, $param_address, $param_city, $param_zip, $param_country, $param_comments);

                    $param_username = trim($_POST['username_1A']);
                    $param_password = trim($_POST['password']);
                    $param_administrator = 0;
                    $param_firstname = trim($_POST['firstname']);
                    $param_lastname = trim($_POST['lastname']);
                    $param_email = trim($_POST['email']);
                    $param_address = trim($_POST['address']);
                    $param_city = trim($_POST['city']);
                    $param_zip = $_POST['zip'];
                    $param_country = $_POST['country'];
                    $param_comments = trim($_POST['comments']);
                    $param_date = $date;
                    $param_phone = $_POST['phone'];

                    if (!mysqli_stmt_execute($stmt)) {
                        die("Execute failed: (" . $link->errno . ") " . $link->error);
                    }
            
                    mysqli_stmt_close($stmt);    

                } else {
                    die("Prepare failed: (" . $link->errno . ") " . $link->error);
                }
            }
	echo "ok";