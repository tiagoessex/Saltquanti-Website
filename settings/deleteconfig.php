<?php
/* ************************************

	clear saved.php, which is the same as reseting
	all configurations.

	called by: settings.php
	*********************************** */
	include('../isAdmin.php');
	if (unlink('saved.php')) {
		$myfile = fopen("saved.php", "w") or die("Unable to open file!");
		fclose($myfile);
		echo "ok";
		die();
	} else {
		echo "error";
		die();
	}