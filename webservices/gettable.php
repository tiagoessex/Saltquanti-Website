<?php
    /* ************************************
        download all table in json format
        only someone with admin credentials can do this

        usage:
            domain/webservices/gettable.php?format=XXX

            where XXX = xml or json (default)
    ************************************ */
    require_once '../settings/config.php';

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        include_once('../settings/fields.php');
        include('../settings/defaults.php');
        include('../settings/saved.php');

        $format = strtolower($_GET['format']) == 'xml' ? 'xml' : 'json';

        /* Attempt to connect to MySQL database */
        $link = db_start();     
          
        $link = db_start();
        $col = implode(",", $SHOW_PRODUCT_COLUMNS);
        $sql = 'SELECT ' . $col . ' from  ' . DB_TABLE_FOOD . ' where validationdate is not NULL order by id';

       // $sql = 'SELECT * from ' . DB_TABLE_FOOD;
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
    }