<?php
	
	if(isset($_POST['login'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

		$username = $_POST['userID'];
		$password = $_POST['userPassword'];
		
		$check = $db->query("SELECT * FROM user WHERE username = '$username' AND password ='$password';");
		
		$row = array(); 
		$i = 0; 
			
		while($res = $check->fetchArray(SQLITE3_ASSOC)){ 
			if(!isset($res['id'])) continue; 
			$row[$i]['id'] = $res['id']; 
			$row[$i]['username'] = $res['username']; 
			$row[$i]['name'] = $res['name']; 
			$i++; 
		} 

		if(sizeof($row) > 0){
			
			session_start();
			$_SESSION['active'] = "Y";

			
			$_SESSION['name'] = $row[0]['name'];
			$_SESSION['userId'] = $row[0]['id'];
			$_SESSION['username'] = $row[0]['username'];

			if($row[0]['username'] == "admin") {
				header('Location: ../../private/admin_page.php');
			} else {
				header('Location: ../../private/booking.php');
			}
			
		} else {
		    header("Location: ../../public/login.php");
		}
	} else {
		header("Location: ../../public/index.php");
	}

?>