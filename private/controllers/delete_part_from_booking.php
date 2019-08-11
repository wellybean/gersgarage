<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/login.php");
	}
	if(isset($_POST['deletePart'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $used_part_id = $_POST['deletePart']; 
        $booking_num = $_POST['booking_num'];    
		
		$check = $db->query("DELETE FROM parts_used WHERE id='$used_part_id';");
		
		header("Location: ../make_invoice.php?booking_id=$booking_num&invoicing=true");
	} else {
		header("Location: ../../public/index.php");
	}

?>