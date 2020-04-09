<?php
// database name
define('DOMAIN_URL', 'https://xxxxx.pt/xxxxxxxx/');      //  

// database name
define('IS_REAL_SERVER', 'true');

// database name
define('DB_NAME', 'saltquanti');  // saltfood

// database user
define('DB_USER', 'saltquanti');      // root 

// database password
define('DB_PASSWORD', 'xxxxxxxxx'); // mysql

// database location
define('DB_SERVER', 'db.fe.up.pt');   // localhost

// database char code
define('DB_CHARSET', 'utf8');

// database users table
define('DB_TABLE_USERS', 'users');

// database products table
define('DB_TABLE_FOOD', 'food');

// default category for "searchcat.php" --- REMOVE
define('DB_TABLE_FOOD_DEFAULT_CATEGORY', 'carne');

// default letter for "searchalpha.php" --- REMOVE
define('DB_TABLE_FOOD_DEFAULT_LETTER', 'A');

// server timezone --- REMOVE
define('CONST_SERVER_TIMEZONE', 'UTC');
 
// server dateformat --- REMOVE
define('CONST_SERVER_DATEFORMAT', 'Ymd');




// can't use header directly otherwise errors in some situations
function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

function Error($errormsg) {
    if (!empty($errormsg)) {
        redirect("error.php?error=".$errormsg);    
    } else {
        redirect("error.php");
    }    
    die();
}


function db_start(){

    if (isset($link) and $link) {
      return $link;
    }

    $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);     

    // Check connection
    if($link === false) {
        $error = true;
        Error("Problemas com a base de dados: " . mysqli_connect_error());
        die();
        //die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    if (!$link->set_charset(DB_CHARSET)) {
        Error("Problemas com a base de dados: character set " . DB_CHARSET);
        die();
      //die("Error loading character set utf8");
    }


    mysqli_set_charset($link,DB_CHARSET);
   // mysqli_query("SET NAMES utf8");

    return $link;
}

function db_stop(){
  //mysql_close();
}


// remove tail and header spaces
// remove all extra spaces
function clean($what) {
    $what = preg_replace('!\s+!', ' ', $what);
    $what = trim($what);
    return $what;
}
