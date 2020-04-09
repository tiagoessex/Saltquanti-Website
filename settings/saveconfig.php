<?php
/* ************************************

	create/rewrite saved.php with the new settings.

	called by: settings.php
	*********************************** */
$myfile = fopen("saved.php", "w") or die("Unable to open file!");
$fields = $_POST['data'];

// FIELDS
fwrite($myfile, "<?php");
fwrite($myfile,"\n");
fwrite($myfile,"\n");

$str = '$SHOW_PRODUCT_COLUMNS = array(';
foreach ($fields as $field) {
    $str .= "'" . $field."',\n";
}
$str .=");";
fwrite($myfile, $str);


fwrite($myfile,"\n");
fwrite($myfile,"\n");


// BACKGROUND SALT COLUMN COLOR
fwrite($myfile,'$salt_color1 = "' . $_POST["salt_color1"] . '"' . ";\n");
fwrite($myfile,'$salt_color2 = "' . $_POST["salt_color2"] . '"' . ";\n");

fwrite($myfile,"\n");
fwrite($myfile,"\n");

// SALT COLUMN FONT STYLE
fwrite($myfile,'$salt_style_weight = "' . $_POST["salt_style_weight"] . '"' . ";\n");
fwrite($myfile,'$salt_style_font = "' . $_POST["salt_style_font"] . '"' . ";\n");
fwrite($myfile,'$salt_style_decoration = "' . $_POST["salt_style_decoration"] . '"' . ";\n");


fwrite($myfile,"\n");
fwrite($myfile,"\n");

fwrite($myfile,'$table_size = "' . $_POST["table_height"] . '"' . ";\n");


fwrite($myfile,"\n");
fwrite($myfile,"\n");

fwrite($myfile,'$table_results_per_page = "' . $_POST["table_results_per_page"] . '"' . ";\n");

fwrite($myfile,"\n");
fwrite($myfile,"\n");

fwrite($myfile,'$LIMIT_SAL_GREEN_FOOD = ' . $_POST["salt_limits_green_food"]  . ";\n");
fwrite($myfile,'$LIMIT_SAL_ORANGE_FOOD = ' . $_POST["salt_limits_orange_food"]  . ";\n");
fwrite($myfile,'$LIMIT_SAL_RED_FOOD = ' . $_POST["salt_limits_red_food"]  . ";\n");


fwrite($myfile,"\n");
fwrite($myfile,"\n");

fwrite($myfile,'$LIMIT_SAL_GREEN_DRINK = ' . $_POST["salt_limits_green_drink"] . ";\n");
fwrite($myfile,'$LIMIT_SAL_ORANGE_DRINK = ' . $_POST["salt_limits_orange_drink"] . ";\n");
fwrite($myfile,'$LIMIT_SAL_RED_DRINK = ' . $_POST["salt_limits_red_drink"]  . ";\n");

fwrite($myfile,"\n");
fwrite($myfile,"\n");

fwrite($myfile,'$salt_limit_low_background = "' . $_POST["salt_limit_low_background"] . '"' . ";\n");
fwrite($myfile,'$salt_limit_mid_background = "' . $_POST["salt_limit_mid_background"] . '"' . ";\n");
fwrite($myfile,'$salt_limit_high_background = "' . $_POST["salt_limit_high_background"] . '"' . ";\n");

fwrite($myfile,"\n");
fwrite($myfile,"\n");

fwrite($myfile,'$salt_limit_low_color = "' . $_POST["salt_limit_low_color"] . '"' . ";\n");
fwrite($myfile,'$salt_limit_mid_color = "' . $_POST["salt_limit_mid_color"] . '"' . ";\n");
fwrite($myfile,'$salt_limit_high_color = "' . $_POST["salt_limit_high_color"] . '"' . ";\n");

fwrite($myfile,"\n");
fwrite($myfile,"\n");

fwrite($myfile,'$show_teor_colors = "' . $_POST["show_teor_colors"] . '"' . ";\n");

fwrite($myfile,"\n");
fwrite($myfile,"\n");

fwrite($myfile,'$show_all_columns = "' . $_POST["show_all_columns"] . '"' . ";\n");

fwrite($myfile,"\n");
fwrite($myfile,"\n");


fclose($myfile);
echo "ok";