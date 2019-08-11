<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/login.php");
	}
	if(isset($_POST['deleteExtra'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $extra_id = $_POST['deleteExtra']; 
        $booking_num = $_POST['booking_num'];    
		
		$check = $db->query("DELETE FROM extras WHERE id='$extra_id';");
		
		header("Location: ../make_invoice.php?booking_id=$booking_num&invoicing=true");
	} else {
		header("Location: ../../public/index.php");
	}

?>