<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/login.php");
	}
	if(isset($_POST['extras'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $booking_id = $_POST['extras'];
        $value = $_POST['value'];
        $description = $_POST['description'];
        
		
		$check = $db->query("INSERT INTO extras (booking_id, description, price) VALUES ('$booking_id', '$description', '$value');");
		
		header("Location: ../make_invoice.php?booking_id=$booking_id&invoicing=true");
	} else {
		header("Location: ../../public/index.php");
	}

?>