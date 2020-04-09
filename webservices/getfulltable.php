<?php
    /* ************************************
        download all table in json format
        only someone with credentials can get use this service

        usage:
            domain/webservices/getfulltable.php?user=XXX&password=YYY&format=ZZZ

            where XXX = xml or json (default)
    ************************************ */

    require_once '../settings/config.php';

    // Define variables and initialize with empty values
    $username = $password = "";

    $isLogIn = false;

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        /* Attempt to connect to MySQL database */
        $link = db_start();
     
        // Check if username is empty
        if(empty(trim($_GET["user"]))) {
            echo "Utilizador não especificado!";
            die();
        } else{
            $username = trim($_GET["user"]);
        }
       

        // Check if password is empty
        if(empty(trim($_GET['password']))) {
            echo "Password não especificada!";
            die();
        } else{
            $password = trim($_GET['password']);
        }


        // Prepare a select statement
        $sql = "SELECT username, password, administrator FROM " . DB_TABLE_USERS . " WHERE username = ?";


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
                            //if ($admin == 1) {
                                $isLogIn = true;
                            //}                               
                          } else {
                            echo "Credenciais inválidas.";
                            die();
                          }
                     }
                    } else {
                        echo "Credenciais inválidas.";
                        die();
                    }
                } else {
                    echo "Credenciais inválidas.";
                    die();
                }
            } else {
                echo "Problemas com a base de dados. Tente mais tarde.";
                die();
            }

            // Close statement
            mysqli_stmt_close($stmt);
    }



    if ($isLogIn) {
        require_once '../settings/fields.php'; 

        // default is json
        $format = strtolower($_GET['format']) == 'xml' ? 'xml' : 'json';

        $link = db_start();
        $sql = 'SELECT * from ' . DB_TABLE_FOOD . ' where validationdate is not NULL order by id';
        $result = mysqli_query($link, $sql);
        if (!$result) {
          die("error");
        }
        $posts = array();
        if(mysqli_num_rows($result)) {
          while($post = mysqli_fetch_assoc($result)) {
            $posts[] = array('produto'=>$post);
          }
        }
        if($format == 'json') {
            header('Content-type: application/json');
            echo json_encode(array('produtos'=>$posts));
        } else {
            header('Content-type: text/xml; charset=utf-8');
           /* echo '<?xml version="1.0" encoding="UTF-8"?>';*/
            echo '<produtos>';
            foreach($posts as $index => $post) {
                if(is_array($post)) {
                    foreach($post as $key => $value) {
                        echo '<',$key,'>';
                        if(is_array($value)) {
                            foreach($value as $tag => $val) {
                                echo '<',$tag,'>',htmlspecialchars($val),'</',$tag,'>';
                            }
                        }
                        echo '</',$key,'>';
                    }
                }
            }
            echo '</produtos>';
        }
    } else {
        echo "Não tem autorização para aceder a este serviço.";
        die();
    }