<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/login.php");
	}
	if(isset($_POST['parts'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $booking_num = $_POST['booking_num'];
        $part_id = $_POST['part_id'];
        
		
		$check = $db->query("INSERT INTO parts_used (booking_id, part_id) VALUES ('$booking_num', '$part_id');");
		
		header("Location: ../make_invoice.php?booking_id=$booking_num&invoicing=true");
	} else {
		header("Location: ../../public/index.php");
	}

?>