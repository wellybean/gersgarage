<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/login.php");
	}
	if(isset($_POST['cancel'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $booking_num = $_POST['cancel'];
        
		
		$check = $db->query("DELETE FROM booking WHERE id = '$booking_num';");
		
		header("Location: ../../private/booking.php");
	} else {
		header("Location: ../../public/index.php");
	}

?>