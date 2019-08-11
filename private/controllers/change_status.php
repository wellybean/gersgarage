<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/login.php");
	}
	if(isset($_POST['status'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $id = $_POST['status'];
        $newStatus = $_POST['newstatus'];
		
		$check = $db->query("UPDATE booking SET status = '$newStatus' WHERE id = '$id';");
		
		header("Location: ../../private/admin_page.php");
	} else {
		header("Location: ../../public/index.php");
	}

?>