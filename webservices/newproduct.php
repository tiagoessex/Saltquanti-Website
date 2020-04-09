<?php
    /* ************************************

        add a new product to the database
        only someone with admin credentials can do this

        usage:
            domain/webservices/newproduct.php?user=XXX&password=YYY&fields=ZZZ

            where fields=ZZZ are the fields and the respective values, e.g., name=productname&brand=productbrand&...

        returns ok if product was added to the database

        Notes:
            - checks if another product with similar name,category, source and collectiondate already exists. if yes, then it wont add this one.

    ************************************ */

    require_once '../settings/config.php';

    function Exists($name, $category, $source, $collectiondate, $conn) {
           // check if product already exists
            $sqla = "SELECT * FROM " . DB_TABLE_FOOD . " WHERE name = '" . $name . "' and category = '" . $category . "' and source = '" . $source . "' and collectiondate = '" . $collectiondate . "'LIMIT 1";

            $querya = mysqli_query($conn, $sqla);
        
            if (!$querya) {
                die(mysqli_error($link));
            }

            if ($querya->num_rows > 0) {                
                return true;
            }
            return false;
    }



    // Define variables and initialize with empty values
    $username = $password = "";

    $isLogIn = true;

    if (isset($_GET["help"])) {
        echo "<h1>AJUDA</h1>";
        echo "<h3>Uso:</h3>";
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . DOMAIN_URL . "webservices/newproduct.php?user=nome do utilizador&password=palavra chave&campo1=valor1&campo2=valor2...";
        echo "<br><br>";
        echo "Retorna <i>ok</i> se produto introduzido com exito.";
        echo " Se um produto com os mesmos valores de <i>name</i>, <i>category</i>, <i>source</i> e <i>collectiondate</i> já existir na base de dados, então retorna erro.";
        echo "<br>";
        echo "<h3>Campos disponiveis:</h3>";
        echo "<b>name</b> - nome ou designação do produto (obrigatorio)<br>";
        echo "<b>salt</b> - teor de sal em [g/100g] (obrigatorio)<br>";
        echo "<b>category</b> - categoria do produto (obrigatorio)<br>";
        echo "<b>subcategory1</b> - primeira subcategoria<br>";
        echo "<b>subcategory2</b> - segunda subcategoria<br>";
        echo "<b>subcategory3</b> - terceira subcategoria<br>";
        echo "<b>wherecollected</b> - local de recolha<br>";
        echo "<b>collectiondate</b> - data de recolha <i>(YYYY-MM-AA)</i><br>";
        echo "<b>source</b> - fonte de recolha<br>";
        echo "<b>brand</b> - marca do produto<br>";
        echo "<b>subbrand</b> - submarca do produto<br>";
        echo "<b>teor</b> - teor de sal (<i>BAIXO, MÉDIO, ALTO</i>)<br>";
        echo "<br>";
        echo "<br>";
        echo "Exemplo: ";
        echo DOMAIN_URL ."webservices/newproduct.php?user=joao&password=pass1234&name=product 1&salt=100&category=cat 1&collectiondate=2018-10-05";
        die();
    }


    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        // Attempt to connect to MySQL database
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
                                $isLogIn = true;
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

        if (!isset($_GET["name"])) {
            echo "NECESSITA DE UM NOME OU DESIGNAÇÃO";
            die();
        }
        $name = trim($_GET["name"]);
        $name = preg_replace('!\s+!', ' ', $name);
        if (!isset($_GET["category"])) {
            echo "NECESSITA DE UMA CATEGORIA";
            die();
        }
        $category = trim($_GET["category"]);
        $category = preg_replace('!\s+!', ' ', $category);
        $subcategory1 = trim($_GET["subcategory1"]);
        $subcategory1 = preg_replace('!\s+!', ' ', $subcategory1);
        $subcategory2 = trim($_GET["subcategory2"]);
        $subcategory2 = preg_replace('!\s+!', ' ', $subcategory2);
        $subcategory3 = trim($_GET["subcategory3"]);
        $subcategory3 = preg_replace('!\s+!', ' ', $subcategory3);
        $wherecollected = trim($_GET["wherecollected"]);
        $wherecollected = preg_replace('!\s+!', ' ', $wherecollected);
        if (!isset($_GET["collectiondate"]) || empty($_GET["collectiondate"]) || is_null($_GET["collectiondate"])) {
            $collectiondate = NULL;
        } else {
            $collectiondate = date("Y-m-d", strtotime($_GET["collectiondate"]));
        }
        $source = trim($_GET["source"]);
        $source = preg_replace('!\s+!', ' ', $source);
        if (!isset($_GET["salt"])) {
            echo "NECESSITA DE TEOR DE SAL [g/100g].";
            die();
        }
        $salt = $_GET["salt"];
        $notes = trim($_GET["notes"]);
        $notes = preg_replace('!\s+!', ' ', $notes);
        // automatically set today's date
        $dt = new DateTime();
        $entrydate = $dt->format('Y-m-d');
        $whoinserted =trim($_GET["user"]);
        $brand = trim($_GET["brand"]);
        $brand = preg_replace('!\s+!', ' ', $brand);
        $subbrand = trim($_GET["subbrand"]);
        $subbrand = preg_replace('!\s+!', ' ', $subbrand);
        //$teor = $_GET["teor"];
        if (isset($_GET["teor"]) && (strtoupper($_GET["teor"]) == 'ALTO' || strtoupper($_GET["teor"]) == 'MÉDIO' || strtoupper($_GET["teor"]) == 'BAIXO')) {
            $teor = $_GET["teor"];
        } else {
            if ( $salt < $LIMIT_SAL_ORANGE_FOOD) {
                $teor = "BAIXO";
            } else if ( $salt > $LIMIT_SAL_RED_FOOD) {
                $teor = "ALTO";
            } else {
                $teor = "MÉDIO";
            }
        }


        $salt = floatval(str_replace(',', '.', $salt));
      
        $link = db_start();

        if (Exists($name, $category, $source, $collectiondate, $link)) {
            echo "PRODUTO JÁ EXISTENTE NA BASE DE DADOS";
            die();
        }


        $sql = "INSERT INTO " . DB_TABLE_FOOD . " (id, name, category, subcategory1, subcategory2, subcategory3, collectiondate, wherecollected, source, salt, validationdate, whovalidated, comments, entrydate, whoinserted, brand, subbrand, teor ) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "sssssssssssssss", $param_name, $param_category, $param_subcategory1, $param_subcategory2, $param_subcategory3, $param_collectiondate, $param_wherecollected, $param_source, $param_salt, $param_notes, $param_entrydate, $param_whoinserted, $param_brand, $param_subbrand, $param_teor);


            
                $param_name = $name;
                $param_category = $category;
                $param_subcategory1 = $subcategory1;
                $param_subcategory2 = $subcategory2;
                $param_subcategory3 = $subcategory3;
                $param_collectiondate = $collectiondate;
                $param_wherecollected = $wherecollected;
                $param_source = $source;
                $param_salt = $salt;
                $param_notes = $notes;
                $param_entrydate = $entrydate;
                $param_whoinserted = $whoinserted;
                $param_brand = $brand;
                $param_subbrand = $subbrand;
                $param_teor = $teor;
            
                if (!mysqli_stmt_execute($stmt)) {
                    echo "Problemas: (" . $link->errno . ") " . $link->error. "";
                    die();
                }
            mysqli_stmt_close($stmt);

        } else {
            echo "Problemas: (" . $link->errno . ") " . $link->error. "";
            die();        
        }
        echo "ok";
    } else {
        echo "Não tem autorização para aceder a este serviço.";
        die();
    }