<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/login.php");
	}
	if(isset($_POST['assignment'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $booking_id = $_POST['booking_id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $mechanic_id = $_POST['mechanic_id'];
		
		$check = $db->query("SELECT service_id FROM booking WHERE id='$booking_id';");
		$res = $check->fetchArray(SQLITE3_ASSOC);
		$service_id = $res['service_id'];

		$check = $db->query("SELECT duration FROM service WHERE id='$service_id';");
		$res = $check->fetchArray(SQLITE3_ASSOC);
		$service_duration = $res['duration'];
		if($service_duration > 120 && $time == "15:30") {
			header("Location: ../make_roster.php?date=$date&roster=Login");
		} else {
			if($service_duration > 120 && $time == "09:00") {
				$check = $db->query("SELECT * FROM booking WHERE mechanic_id='$mechanic_id' AND (time='11:00' AND date='$date');");
				$res = $check->fetchArray(SQLITE3_ASSOC);
				if(isset($res['id'])) {
					header("Location: ../make_roster.php?date=$date&roster=Login");
				} else {
					$check = $db->query("UPDATE booking SET mechanic_id = '$mechanic_id', time = '$time' WHERE id = '$booking_id';");
					header("Location: ../make_roster.php?date=$date&roster=Login");
				}
			} elseif($service_duration > 120 && $time == "11:00") {
				$check = $db->query("SELECT * FROM booking WHERE mechanic_id='$mechanic_id' AND (time='13:30' AND date='$date');");
				$res = $check->fetchArray(SQLITE3_ASSOC);
				if(isset($res['id'])) {
					header("Location: ../make_roster.php?date=$date&roster=Login");
				} else {
					$check = $db->query("UPDATE booking SET mechanic_id = '$mechanic_id', time = '$time' WHERE id = '$booking_id';");
					header("Location: ../make_roster.php?date=$date&roster=Login");
				}
			} elseif($service_duration > 120 && $time == "13:30") {
				$check = $db->query("SELECT * FROM booking WHERE mechanic_id='$mechanic_id' AND (time='15:30' AND date='$date');");
				$res = $check->fetchArray(SQLITE3_ASSOC);
				if(isset($res['id'])) {
					header("Location: ../make_roster.php?date=$date&roster=Login");
				} else {
					$check = $db->query("UPDATE booking SET mechanic_id = '$mechanic_id', time = '$time' WHERE id = '$booking_id';");
					header("Location: ../make_roster.php?date=$date&roster=Login");
				}
			} else {
				$check = $db->query("UPDATE booking SET mechanic_id = '$mechanic_id', time = '$time' WHERE id = '$booking_id';");
				header("Location: ../make_roster.php?date=$date&roster=Login");
			}


			
		}
        

        

	} else {
		header("Location: ../../public/index.php");
	}

?>