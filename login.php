<?php
	// Include config file
 	require_once 'settings/config.php';
    
     /* Attempt to connect to MySQL database */
   // $link = db_start();

    // Define variables and initialize with empty values
	$username = $password = "";
	$username_err = $password_err = "";

	// Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        /* Attempt to connect to MySQL database */
        $link = db_start();
     
        // Check if username is empty
        if(empty(trim($_POST["username"]))) {
            $username_err = 'Please enter username.';
        } else{
            $username = trim($_POST["username"]);
        }
       

        // Check if password is empty
        if(empty(trim($_POST['password']))) {
            $password_err = 'Please enter your password.';
        } else{
            $password = trim($_POST['password']);
        }


        // Validate credentials

        if(empty($username_err) && empty($password_err)) {

            // Prepare a select statement
            $sql = "SELECT username, password, administrator FROM " . DB_TABLE_USERS . " WHERE username = ? and validationdate is not NULL";



            if($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);               

                // Set parameters
                $param_username = $username;               

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)) {
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $username, $hashed_password, $admin);
                        if(mysqli_stmt_fetch($stmt)) {
                            if (password_verify($password, $hashed_password) || ($password == $hashed_password)) {
                                /* Password is correct, so start a new session and
                                save the username to the session */
                                if(!isset($_SESSION)) {
                                    session_start();
                                }
                                $_SESSION['username'] = $username;
                                if ($admin == 1) {
                                    $_SESSION['admin'] = $admin;
                                }                                                     
                                $isLogIn = true;
                            } else {
                                // Display an error message if password is not valid
                                $password_err = 'The password you entered was not valid.';
                             //   Error("Credenciais inválidas. Tente novamente!");
                             //   die();
                            }
                        }
                    } else {
                        // Display an error message if username doesn't exist
                        $username_err = 'No account found with that username.';
                      //  Error("Credenciais inválidas. Tente novamente!");
                      //  die();
                    }
                } else {
                    Error("Problemas com a base de dados!");
                    die();
                }
            } else {
                Error("Problemas com a base de dados!");
                die();
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        db_stop();

    }
?>