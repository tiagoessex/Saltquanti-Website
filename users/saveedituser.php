<?php
    /* ************************************
        update user

        called by: edituser.php
    ************************************ */
    include('../isParticipant.php');
	require_once '../settings/config.php';	

	$link = db_start();

    $username = "";
    // making sure
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

        
            // alles gut => save user            
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
 
            $sql = "update " . DB_TABLE_USERS . " set 
                    password = ?, 
                    firstname = ?, 
                    email = ?, 
                    phone = ?, 
                    administrator = ?, 
                    lastname = ?, 
                    address = ?, 
                    city = ?, 
                    zip = ?, 
                    country = ?, 
                    comments = ?
                    where id = " . $_POST["userid"];


        
            if ($stmt = mysqli_prepare($link, $sql)) {

                mysqli_stmt_bind_param($stmt, "ssssissssss", $param_password, $param_firstname, $param_email, $param_phone, $param_administrator, $param_lastname, $param_address, $param_city, $param_zip, $param_country, $param_comments);

                $param_password = trim($_POST['password']);
                $param_administrator = trim($_POST['rights']);
                $param_firstname = trim($_POST['firstname']);
                $param_lastname = trim($_POST['lastname']);
                $param_email = trim($_POST['email']);
                $param_address = trim($_POST['address']);
                $param_city = trim($_POST['city']);
                $param_zip = $_POST['zip'];
                $param_country = $_POST['country'];
                $param_comments = trim($_POST['comments']);
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