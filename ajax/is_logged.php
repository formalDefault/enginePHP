<?php	
	session_start();
	if (!isset($_SESSION['admin_id']) AND $_SESSION['admin_usuario']) {
        header("location: ../login.php");
		exit;
    }