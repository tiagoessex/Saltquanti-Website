<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['admin'])) {
		header("location: https://web.fe.up.pt/~saltquanti/index.php");
		exit();
	}