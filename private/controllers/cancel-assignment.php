<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/login.php");
	}
	if(isset($_POST['cancelAssignment'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $booking_id = $_POST['cancelAssignment'];
        $date = $_POST['date'];
        
		
        $check = $db->query("UPDATE booking SET mechanic_id = '' WHERE id = '$booking_id';");
        $check = $db->query("UPDATE booking SET time = '' WHERE id = '$booking_id';");


        header("Location: ../make_roster.php?date=$date&roster=Login");

        

	} else {
		header("Location: ../../public/index.php");
	}

?>