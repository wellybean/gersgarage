<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/index.php");
	}
	if(isset($_POST['register_vehicle'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $type = $_POST['type'];
        $make = $_POST['make'];
        $license = $_POST['license'];
        $engine = $_POST['engine'];
        $userId = $_SESSION['userId'];
        
		
		$check = $db->query("INSERT INTO vehicle (type, make, license, engine, user_id) VALUES ('$type', '$make', '$license', '$engine', '$userId')");
		
		header("Location: ../booking.php");
	} else {
		header("Location: ../../public/index.php");
	}

?>