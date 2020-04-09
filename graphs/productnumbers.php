<?php
  /* ************************************


    called by: graphs.php
  ************************************ */
  require_once '../settings/config.php';

  $info = array();
  $path = $_POST["path"];


  // get info from subcategory3
  if (isset($path[3])) {
      $sql = 'SELECT DISTINCT subcategory3 from  ' . DB_TABLE_FOOD . ' where  category="' . $path[1] . '" and subcategory1 = "' . $path[2] . '" and  subcategory2 = "' . $path[3] . '" and validationdate is not NULL order by subcategory3';
  } else   // get info from subcategory2
  if (isset($path[2])) {
      $sql = 'SELECT DISTINCT subcategory2 from  ' . DB_TABLE_FOOD . ' where  category="' . $path[1] . '" and subcategory1 = "' . $path[2] . '" and validationdate is not NULL order by subcategory2';
  } else   // get info from subcategory1
  if (isset($path[1])) {
      $sql = 'SELECT DISTINCT subcategory1 from  ' . DB_TABLE_FOOD . ' where  category="' . $path[1] . '" and validationdate is not NULL order by subcategory1';
  } else {
      // default - root - get info from only main categories
  $sql = 'SELECT DISTINCT category from  ' . DB_TABLE_FOOD . ' where validationdate is not NULL order by category';
  }

  //die($sql);

  $link = db_start();
  
  $query = mysqli_query($link, $sql);
  if (!$query) {
    Error("Problemas com a base de dados. " . mysqli_error($link));
    die();
  }
  while ($row = mysqli_fetch_array($query)) {
    if (isset($path[3])) {
      $sql2 = 'SELECT count(*) as total from ' . DB_TABLE_FOOD . ' WHERE category="' . $path[1] . '"  and subcategory1="' . $path[2] . '" and subcategory2="' . $path[3] . '" and subcategory3="' . $row['subcategory3'] . '" AND validationdate IS NOT NULL';
    } else if (isset($path[2])) {
      $sql2 = 'SELECT count(*) as total from ' . DB_TABLE_FOOD . ' WHERE category="' . $path[1] . '"  and subcategory1="' . $path[2] . '" and subcategory2="' . $row['subcategory2'] . '" AND validationdate IS NOT NULL';
    } else if (isset($path[1])) {
      $sql2 = 'SELECT count(*) as total from ' . DB_TABLE_FOOD . ' WHERE category="' . $path[1] . '"  and subcategory1="' . $row['subcategory1'] . '" AND validationdate IS NOT NULL';
    } else {
      // default - root - get info from only main categories
      $sql2 = 'SELECT count(*) as total from ' . DB_TABLE_FOOD . ' WHERE category="' . $row['category'] . '" AND validationdate IS NOT NULL';
    }
    
    
    
    // die($sql2);
      $query2 = mysqli_query($link, $sql2);
      $data=mysqli_fetch_assoc($query2);
      if (!$query2) {
        Error("Problemas com a base de dados. " . mysqli_error($link));
        die();
      }
      if (isset($path[3])) {
        array_push($info,  $row['subcategory3']);
      } else if (isset($path[2])) {
        array_push($info,  $row['subcategory2']);
      } else if (isset($path[1])) {
        array_push($info,  $row['subcategory1']);
      } else {
        array_push($info,  $row['category']);
      }      
      array_push($info,   $data['total']);
  }

  echo json_encode($info);