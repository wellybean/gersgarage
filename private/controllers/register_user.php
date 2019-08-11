<?php
	
	if(isset($_POST['signup'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $password = $_POST['password'];
		
		$check = $db->query("INSERT INTO user (name, email, phone, username, password) VALUES ('$name', '$email', '$phone', '$username', '$password')");
		
		header("Location: ../../public/login.php");
	} else {
		header("Location: ../../public/index.php");
	}

?>