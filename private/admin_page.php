<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../public/login.php");
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <?php include '../public/components/head.php';?>
  </head>
  <body>
    <?php include '../public/components/navbar.php';?>
    <div class="container">
    <?php include './booking-checker.php';?>
    <?php include './rostering.php';?>
    <?php include './invoicing.php'; ?>
    <?php include '../public/components/footer.php';?>
    <script src="../js/myScripts.js"></script>
  </body>
</html>