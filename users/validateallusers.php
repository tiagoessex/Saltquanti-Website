<?php
    /* ************************************
        validate all non validated users

        called by: validateusers.php
    ************************************ */
    include('../isAdmin.php');
    require_once '../settings/config.php';     
    $link = db_start();
    // send emails
    if (IS_REAL_SERVER == "true") {
        $sql = 'SELECT email from  ' . DB_TABLE_USERS . " WHERE id = '".$_POST["id"]."'";
        $query = mysqli_query($link, $sql);
        if (!$query) {
          die(mysqli_error($link));
        }
        while ($row = mysqli_fetch_array($query)) {
           // if (is_null($row["validationdate"])) continue;
            if (!isset($row["email"]) || is_null($row["email"]) || empty ($row["email"])) continue;
            $to      = $row["email"];
            $subject = 'Conta validada';
            $message = "Olá.\r\n A sua conta na Saltquanti acabou de ser validada. Já pode usufruir de mais serviços.\r\n\r\n Obrigado.";
            /*
            if(!mail($to, $subject, $message)) {
                die("Erro no envio do email de validação.");
            }
            */
            mail($to, $subject, $message);
        }
    }
    $dt = new DateTime();
    $date = $dt->format('Y-m-d');
    $sql = "UPDATE " . DB_TABLE_USERS . " SET whovalidated = '" . $_POST["username"] . "',  validationdate = '" . $date . "' WHERE validationdate IS NULL OR validationdate = ''"; 
   	$query = mysqli_query($link, $sql);
    if (!$query) {
        die(mysqli_error($link));        
    }
    echo "ok";
    die();