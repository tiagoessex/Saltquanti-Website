<?php include_once('../settings/fields.php'); ?>
<?php include('../settings/defaults.php'); ?>
<?php include('../settings/saved.php'); ?>
<?php
    /* ************************************
        get the data (only from allowed columns) from single product by id
        returns the contents of an html table

        called by: consultalpha.php, consultglobal.php, consultcat.php
    ************************************ */
    require_once '../settings/config.php';

   $link = db_start();

   	$sql = 'SELECT * from  ' . DB_TABLE_FOOD . " WHERE id = '".$_POST["id"]."'"; ;
   	$query = mysqli_query($link, $sql);

    if (!$query) {
        echo "error";
        die();
    }

    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

    $str = "";
    $salt = 0;


    // which columns to show
    if(!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['username'])  && $show_all_columns === "true" ) {
        foreach  (array_keys($COLUMN2NAME) as $item) {
            if (!in_array($item, $SHOW_PRODUCT_COLUMNS)) {
                array_push($SHOW_PRODUCT_COLUMNS, $item);
            }
        }
    }  


    foreach ($SHOW_PRODUCT_COLUMNS as &$field) {
        $str .= '<tr>';
        $str .= '<th class="text-right" style="background-color: #dff0d8;" width = "30%">';
        $str .= $COLUMN2NAME[$field];
        $str .= '</th>';
        if ($field == "salt") {
          $str .= '<td style="background-color: #CEF6F5; font-weight: bold;">';
           $str .=  sprintf("%0.2f",$row[$field]);
           $salt = $row[$field];
        } else if ($field == "teor") {
            $salt = $row['salt'];
            if (  $salt < $LIMIT_SAL_ORANGE_FOOD) {
                $str .= '<td style="background-color: ' . $salt_limit_low_background . ';"> BAIXO </td></tr>';
            } else if ($salt > $LIMIT_SAL_RED_FOOD) {
                $str .= '<td style="background-color:  ' . $salt_limit_high_background . ';"> ALTO </td></tr>';
            } else {
                $str .= '<td style="background-color:  ' . $salt_limit_mid_background . ';"> MÉDIO </td></tr>';
            }

        } else {
            $str .= '<td>';
            $str .= $row[$field];
        }

        $str .= '</td>';
        $str .= '</tr>';
    }
    echo $str;