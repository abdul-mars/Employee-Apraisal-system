<?php session_start();
	if (@$_GET['operation'] == 'admin_logout') {
		session_unset();
		session_destroy();
		header("location: login.php");
		exit();
	}
	if (@$_GET['operation'] == 'user_logout') {
		session_unset();
		session_destroy();
		header("location: user.php");
		exit();
	}