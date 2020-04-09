<?php
/* ************************************

	DO NOT DELETE

	*********************************** */
/* default columns to show to the user and their respective order */
// not in here because
// see fields.php


/* limits to id whether if low/mid/high salt content */
$LIMIT_SAL_GREEN_FOOD = 0;
$LIMIT_SAL_ORANGE_FOOD = 0.301;
$LIMIT_SAL_RED_FOOD = 1.501;


$LIMIT_SAL_GREEN_DRINK = 0;
$LIMIT_SAL_ORANGE_DRINK = 0.301;
$LIMIT_SAL_RED_DRINK = 0.751;

/* background color of the salt column in category search */
$salt_color1 = "#cef6f5";
/* background color of the salt column in all other searchs and managers */
$salt_color2 = "inherited";

/* salt column text style */
$salt_style_weight = "bold";
$salt_style_font = "normal";
$salt_style_decoration = "none";

/* table display */
$table_results_per_page = "10";
$table_size = "400";

/* background color according to limits */
$salt_limit_low_background = "#80ff94";
$salt_limit_mid_background = "#fcff71";
$salt_limit_high_background = "#ff7c7c";


/* text color according to limits */
$salt_limit_low_color = "#000000";
$salt_limit_mid_color = "#000000";
$salt_limit_high_color = "#000000";

/* teor levels colorized or not */
$show_teor_colors = "true";

/* access to all columns in search if logged */
$show_all_columns = "false";