<?php
  /* ************************************
    calculated and returns info (max, min, mean) from a specific category

    called by: consultcat.php
  ************************************ */
  require_once '../settings/config.php';
  $link = db_start();
  $path = $_POST["path"];

  $cat_query = '';
  if (isset($path[1])) {
      $cat_query .= ' category="' . $path[1] . '"';
  }
  if (isset($path[2])) {
      $cat_query .= ' AND subcategory1="' . $path[2] . '"';
  }
  if (isset($path[3])) {
      $cat_query .= ' AND subcategory2="' . $path[3] . '"';
  }
  if (isset($path[4])) {
      $cat_query .= ' AND subcategory3="' . $path[4] . '"';
  }

  // get max salt product
  if ($cat_query == '') {
      $sql = 'SELECT id,name,salt FROM ' . DB_TABLE_FOOD . ' WHERE validationdate IS NOT NULL ORDER BY salt DESC LIMIT 1';
  }  else {  
    $sql = 'SELECT id,name,salt FROM ' . DB_TABLE_FOOD . " WHERE " . $cat_query; 
    $sql .= ' AND validationdate IS NOT NULL ORDER BY salt DESC LIMIT 1';
  }
  //die($sql);
	$query = mysqli_query($link, $sql);
  if (!$query) {
    die("error");
  }
  $row = mysqli_fetch_array($query);
  $max_product = $row["id"] . ', ' . $row["name"] . ', ' . $row["salt"] . ' [g/100g]';
  $max_product_id = $row['id'];


  // get min salt product
  if ($cat_query == '') {
        $sql = 'SELECT id,name,salt FROM ' . DB_TABLE_FOOD . ' WHERE validationdate IS NOT NULL ORDER BY salt ASC LIMIT 1';
  } else {
    $sql = 'SELECT id,name,salt FROM ' . DB_TABLE_FOOD . " WHERE " . $cat_query; 
    $sql .= ' AND validationdate IS NOT NULL ORDER BY salt ASC LIMIT 1';
  }
  $query = mysqli_query($link, $sql);
  if (!$query) {
    die("error");
  }
  $row = mysqli_fetch_array($query);
  $min_product = $row["id"] . ', ' . $row["name"] . ', ' . $row["salt"] . ' [g/100g]';
  $min_product_id = $row['id'];

  // get average salt category
  if ($cat_query == '') {
    $sql = 'SELECT AVG(salt) FROM ' . DB_TABLE_FOOD . ' WHERE validationdate IS NOT NULL';
  } else {
    $sql = 'SELECT AVG(salt) FROM ' . DB_TABLE_FOOD . " WHERE " . $cat_query; 
    $sql .= ' AND validationdate IS NOT NULL';
  }
  $query = mysqli_query($link, $sql);
  if (!$query) {
    die("error");
  }
  $row = mysqli_fetch_array($query);
  //$avg = str_replace('.', ',', round($row["0"], 2));

  $info = array();
  array_push($info,  round($row["0"], 2));
  array_push($info, $min_product);  
  array_push($info, $min_product_id);
  array_push($info, $max_product);
  array_push($info, $max_product_id);  
  echo json_encode($info);