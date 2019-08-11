<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../../public/login.php");
	}
	if(isset($_POST['genInvoice'])){
		$db = new SQLite3('../../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $id = $_POST['genInvoice'];
		$check = $db->query("SELECT * FROM booking ORDER BY invoice_num DESC LIMIT 1;");
        $res = $check->fetchArray(SQLITE3_ASSOC);
        $max = $res['invoice_num'];
        $newInvNum = ((int)$max) + 1;
        $check = $db->query("UPDATE booking SET invoice_num='$newInvNum' WHERE id='$id';");
        header("Location: ../make_invoice.php?booking_id=$id&invoicing=Login");
        
	} else {
		header("Location: ../../public/index.php");
	}

?>