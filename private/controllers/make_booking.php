<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/login.php");
	}
	if(isset($_POST['booking'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $date = $_POST['date'];
        $vehicle_id = $_POST['vehicle_id'];
        $service_id = $_POST['service_id'];
        $comments = $_POST['comments'];
        $userId = $_SESSION['userId'];
        $status = "booked";
		$time = "";
		$invoice_num = "";
		$mechanic_id = "";
		
		$check = $db->query("INSERT INTO booking (date, time, vehicle_id, service_id, user_id, status, comments, invoice_num, mechanic_id) 
        VALUES ('$date', '$time', '$vehicle_id', '$service_id', '$userId', '$status', '$comments', '$invoice_num', '$mechanic_id')");
		
		header("Location: ../../private/booking.php");
	} else {
		header("Location: ../../public/index.php");
	}

?>