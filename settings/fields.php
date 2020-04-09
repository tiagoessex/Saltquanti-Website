<?php

// used to translate between db columns names to pt names
$USERSCOLUMN2NAME = array();
$USERSCOLUMN2NAME["id"] = "Id";
$USERSCOLUMN2NAME["username"] = "Nome de utilizador";
$USERSCOLUMN2NAME["password"] = "Password";
$USERSCOLUMN2NAME["date"] = "Date de registo";
$USERSCOLUMN2NAME["firstname"] = "Nome";
$USERSCOLUMN2NAME["lastname"] = "Apelido";
$USERSCOLUMN2NAME["email"] = "Email";
$USERSCOLUMN2NAME["phone"] = "Telefone";
$USERSCOLUMN2NAME["administrator"] = "Privilegios";
$USERSCOLUMN2NAME["address"] = "Morada";
$USERSCOLUMN2NAME["city"] = "Cidade";
$USERSCOLUMN2NAME["zip"] = "Código postal";
$USERSCOLUMN2NAME["country"] = "País";
$USERSCOLUMN2NAME["comments"] = "Comentários";
$USERSCOLUMN2NAME["validationdate"] = "Data de validação";
$USERSCOLUMN2NAME["whovalidated"] = "Quem validou";




// used to translate between db columns names to pt names
$COLUMN2NAME = array();
$COLUMN2NAME["id"] = "Id";
$COLUMN2NAME["name"] = "Designação";
$COLUMN2NAME["salt"] = "Sal [g/100g]";
$COLUMN2NAME["category"] = "Categoria";
$COLUMN2NAME["subcategory1"] = "Subcategoria 1";
$COLUMN2NAME["subcategory2"] = "Subcategoria 2";
$COLUMN2NAME["subcategory3"] = "Subcategoria 3";
$COLUMN2NAME["brand"] = "Marca";
$COLUMN2NAME["subbrand"] = "Sub marca";
$COLUMN2NAME["collectiondate"] = "Data da recolha";
$COLUMN2NAME["wherecollected"] = "Local da recolha";
$COLUMN2NAME["source"] = "Fonte da recolha";
$COLUMN2NAME["comments"] = "Comentários";
$COLUMN2NAME["entrydate"] = "Data do registo";
$COLUMN2NAME["whoinserted"] = "Quem inseriu";
$COLUMN2NAME["updatedate"] = "Ultima actualização";
$COLUMN2NAME["whoupdated"] = "Quem actualizou";
$COLUMN2NAME["validationdate"] = "Data da validação";// used to check if data was validadate - used in consults and db administration -- NULL => not validated
$COLUMN2NAME["whovalidated"] = "Quem validou";
$COLUMN2NAME["teor"] = "Teor";

// default columns to show to the user and their respective order
$SHOW_PRODUCT_COLUMNS = array(	'id',
								'name',
								'salt',
								'category',
								'subcategory1',
								'subcategory2',
								'subcategory3',
								'teor'
							);


// default order of the tables
$DEFAULT_TABLE_ORDER = "id";

// cannot import this info from imported files
$DATABASE_DONTIMPORT = array("id", "whovalidated", "validationdate","entrydate","whoinserted","updatedate","whoupdated");

// import files must contain at least these fields
$DATABASE_MUSTIMPORT = array("name", "category", "salt");


$MIN_DATABASE_EXPORTALL = array("id","name", "category", "salt");


// dont show these one when validating products
$DATABASE_DONTSHOWWHENVALIDATING = array("whovalidated", "validationdate");//,"updatedate","whoupdated");

