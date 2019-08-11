<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../public/login.php");
	}
	if(isset($_GET['roster'])){
		$db = new SQLite3('../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $date = $_GET['date'];
		
		echo '<!doctype html>';
                echo '<html lang="en">';
                echo '<head>';
                include('../public/components/head.php');
                echo '</head>';
                echo '<body>';
                include('../public/components/navbar.php');
                echo '<div class="container">';
                echo '<br><br><br><br>';
                echo "<table id=\"roster\" class=\"roster\">";
                echo "<tr>";
                echo "<th></th>";
                $columns = 1;
                $mechanics = $db->query("SELECT * FROM mechanic;");
                while($mecsRes = $mechanics->fetchArray(SQLITE3_ASSOC)) {
                    if(!isset($mecsRes['id'])) continue;
                    echo "<th style=\"padding:10px;\">";
                    echo $mecsRes['name'];
                    echo "</th>";
                    $columns++;
                }
                echo "</tr>";
                echo "<tr style=\"height:140px;\">";
                echo "<th style=\"padding:10px;\">09:00</th>"; 
                $mecId = 1;
                for($i = 0; $i<$columns - 1; $i++) {
                    echo "<td style=\"padding:10px;width:210px\">";
                    $booking = $db->query("SELECT * FROM booking WHERE time='09:00' AND (mechanic_id='$mecId' AND date='$date');");
                    $flag = false;
                    $printFlag = false;
                    while($bookingRes = $booking->fetchArray(SQLITE3_ASSOC)) {    
                        if(!isset($bookingRes['id'])) continue;
                        $booking_id = $bookingRes['id']; 
                        $date = $bookingRes['date']; 
                        $serviceId = $bookingRes['service_id'];
                        $service = $db->query("SELECT * FROM service WHERE id = '$serviceId';");
                        while($serviceRes = $service->fetchArray(SQLITE3_ASSOC)) {
                            if(!isset($serviceRes['id'])) continue;
                            $flag = true;
                            
                            echo "<form ";
                            if($serviceRes['description'] == "Major repair") {
                                echo 'class="majorRepair"';
                            }
                            echo "action=\"./controllers/cancel-assignment.php\" method=\"POST\">";
                            echo "<input type=\"text\" class=\"form-control\" placeholder=\"";
                            echo $serviceRes['description'];
                            echo " (n.: ";
                            echo $booking_id;
                            echo ")\" readonly><br>";
                            echo "<input type=\"text\" value=\"";
                            echo $date;
                            echo "\" name=\"date\" hidden>";
                            echo "<button class=\"btn btn-sm btn-danger btn-block\" type=\"submit\" value=\"";
                            echo $booking_id;
                            echo "\" name=\"cancelAssignment\">X</button>";
                            echo "</form>";
                        }
                        
                    }
                    if($flag == false) {
                        
                        $booking = $db->query("SELECT * FROM booking WHERE date = '$date' AND (time = '' OR time = NULL);");
                        
                        while($bookingRes = $booking->fetchArray(SQLITE3_ASSOC)) {
                            
                            if(!isset($bookingRes['id'])) continue;
                            
                            $booking_id = $bookingRes['id'];  
                            $serviceId = $bookingRes['service_id'];
                            $service = $db->query("SELECT * FROM service WHERE id = '$serviceId';");
                            while($serviceRes = $service->fetchArray(SQLITE3_ASSOC)) {
                                if(!isset($serviceRes['id'])) continue;
                                if($printFlag == false) {
                                    echo "<form  action=\"./controllers/assign.php\" method=\"POST\">";
                                    echo "<input type=\"text\" value=\"";
                                    echo $date;
                                    echo "\" name=\"date\" hidden>";
                                    echo "<select class=\"form-control\" name=\"booking_id\">";
                                    $printFlag = true;
                                }
                                echo "<option value=\"";
                                echo $booking_id;
                                echo "\">";
                                echo $serviceRes['description'];
                                echo " (n.: ";
                                echo $booking_id;
                                echo ")</option>";
                            }
                            
                        }
                        if($printFlag == true) {
                            echo "</select><br>";
                                    echo "<input type=\"text\" value=\"09:00\" name=\"time\" hidden>";
                                    echo "<input type=\"text\" value=\"";
                                    echo $mecId;
                                    echo "\" name=\"mechanic_id\" hidden>";

                                    echo "<button class=\"btn btn-sm btn-primary btn-block\" type=\"submit\" value=\"novalue\" name=\"assignment\">Assign</button>";
                                    echo "</form>";
                        }
                        
                    }
                    echo "</td>";
                    $mecId++;
                }
                echo "</tr>";
                echo "<tr style=\"height:140px;\">";
                echo "<th style=\"padding:10px;\">11:00</th>"; 
                $mecId = 1;
                for($i = 0; $i<$columns -1; $i++) {
                    echo "<td style=\"padding:10px;\">";
                    $booking = $db->query("SELECT * FROM booking WHERE time='11:00' AND (mechanic_id='$mecId' AND date='$date');");
                    $flag = false;
                    $printFlag = false;
                    while($bookingRes = $booking->fetchArray(SQLITE3_ASSOC)) {
                        if(!isset($bookingRes['id'])) continue;
                        $booking_id = $bookingRes['id']; 
                        $date = $bookingRes['date']; 
                        $serviceId = $bookingRes['service_id'];
                        $service = $db->query("SELECT * FROM service WHERE id = '$serviceId';");
                        while($serviceRes = $service->fetchArray(SQLITE3_ASSOC)) {
                            if(!isset($serviceRes['id'])) continue;
                            $flag = true;
                            echo "<form ";
                            if($serviceRes['description'] == "Major repair") {
                                echo 'class="majorRepair"';
                            }
                            echo "action=\"./controllers/cancel-assignment.php\" method=\"POST\">";
                            echo "<input type=\"text\" class=\"form-control\" placeholder=\"";
                            echo $serviceRes['description'];
                            echo " (n.: ";
                            echo $booking_id;
                            echo ")\" readonly><br>";
                            echo "<input type=\"text\" value=\"";
                            echo $date;
                            echo "\" name=\"date\" hidden>";
                            echo "<button class=\"btn btn-sm btn-danger btn-block\" type=\"submit\" value=\"";
                            echo $booking_id;
                            echo "\" name=\"cancelAssignment\">X</button>";
                            echo "</form>";
                        }
                        
                    }
                    if($flag == false) {
                        
                        $booking = $db->query("SELECT * FROM booking WHERE date = '$date' AND time = '';");
                        while($bookingRes = $booking->fetchArray(SQLITE3_ASSOC)) {
                            if(!isset($bookingRes['id'])) continue;
                            $booking_id = $bookingRes['id'];  
                            $serviceId = $bookingRes['service_id'];
                            $service = $db->query("SELECT * FROM service WHERE id = '$serviceId';");
                            while($serviceRes = $service->fetchArray(SQLITE3_ASSOC)) {
                                if(!isset($serviceRes['id'])) continue;
                                if($printFlag == false) {
                                    echo "<form  action=\"./controllers/assign.php\" method=\"POST\">";
                                    echo "<input type=\"text\" value=\"";
                                    echo $date;
                                    echo "\" name=\"date\" hidden>";
                                    echo "<select class=\"form-control\" name=\"booking_id\">";
                                    $printFlag = true;
                                }
                                echo "<option value=\"";
                                echo $booking_id;
                                echo "\">";
                                echo $serviceRes['description'];
                                echo " (n.: ";
                                echo $booking_id;
                                echo ")</option>";
                            }
                            
                        }
                        if($printFlag == true) {
                            echo "</select><br>";
                                    echo "<input type=\"text\" value=\"11:00\" name=\"time\" hidden>";
                                    echo "<input type=\"text\" value=\"";
                                    echo $mecId;
                                    echo "\" name=\"mechanic_id\" hidden>";

                                    echo "<button class=\"btn btn-sm btn-primary btn-block\" type=\"submit\" value=\"novalue\" name=\"assignment\">Assign</button>";
                                    echo "</form>";
                        }
                        
                    }
                    echo "</td>";
                    $mecId++;
                }
                echo "</tr>";
                echo "<tr style=\"height:140px;\">";
                echo "<th style=\"padding:10px;\">13:30</th>"; 
                $mecId = 1;
                for($i = 0; $i<$columns - 1; $i++) {
                    echo "<td style=\"padding:10px;\">";
                    $booking = $db->query("SELECT * FROM booking WHERE time='13:30' AND (mechanic_id='$mecId' AND date='$date');");
                    $flag = false;
                    $printFlag = false;
                    while($bookingRes = $booking->fetchArray(SQLITE3_ASSOC)) {
                        if(!isset($bookingRes['id'])) continue;
                        $booking_id = $bookingRes['id']; 
                        $date = $bookingRes['date']; 
                        $serviceId = $bookingRes['service_id'];
                        $service = $db->query("SELECT * FROM service WHERE id = '$serviceId';");
                        while($serviceRes = $service->fetchArray(SQLITE3_ASSOC)) {
                            if(!isset($serviceRes['id'])) continue;
                            $flag = true;
                            echo "<form ";
                            if($serviceRes['description'] == "Major repair") {
                                echo 'class="majorRepair" ';
                            }
                            echo "action=\"./controllers/cancel-assignment.php\" method=\"POST\">";
                            echo "<input type=\"text\" class=\"form-control\" placeholder=\"";
                            echo $serviceRes['description'];
                            echo " (n.: ";
                            echo $booking_id;
                            echo ")\" readonly><br>";
                            echo "<input type=\"text\" value=\"";
                            echo $date;
                            echo "\" name=\"date\" hidden>";
                            echo "<button class=\"btn btn-sm btn-danger btn-block\" type=\"submit\" value=\"";
                            echo $booking_id;
                            echo "\" name=\"cancelAssignment\">X</button>";
                            echo "</form>";
                        }
                        
                    }
                    if($flag == false) {
                        
                        $booking = $db->query("SELECT * FROM booking WHERE date = '$date' AND time = '';");
                        while($bookingRes = $booking->fetchArray(SQLITE3_ASSOC)) {
                            if(!isset($bookingRes['id'])) continue;
                            $booking_id = $bookingRes['id'];  
                            $serviceId = $bookingRes['service_id'];
                            $service = $db->query("SELECT * FROM service WHERE id = '$serviceId';");
                            while($serviceRes = $service->fetchArray(SQLITE3_ASSOC)) {
                                if(!isset($serviceRes['id'])) continue;
                                if($printFlag == false) {
                                    echo "<form action=\"./controllers/assign.php\" method=\"POST\">";
                                    echo "<input type=\"text\" value=\"";
                                    echo $date;
                                    echo "\" name=\"date\" hidden>";
                                    echo "<select class=\"form-control\" name=\"booking_id\">";
                                    $printFlag = true;
                                }
                                echo "<option value=\"";
                                echo $booking_id;
                                echo "\">";
                                echo $serviceRes['description'];
                                echo " (n.: ";
                                echo $booking_id;
                                echo ")</option>";
                            }
                            
                        }
                        if($printFlag == true) {
                            echo "</select><br>";
                                    echo "<input type=\"text\" value=\"13:30\" name=\"time\" hidden>";
                                    echo "<input type=\"text\" value=\"";
                                    echo $mecId;
                                    echo "\" name=\"mechanic_id\" hidden>";

                                    echo "<button class=\"btn btn-sm btn-primary btn-block\" type=\"submit\" value=\"novalue\" name=\"assignment\">Assign</button>";
                                    echo "</form>";
                        }
                        
                    }
                    echo "</td>";
                    $mecId++;
                }
                echo "</tr>";
                echo "<tr style=\"height:140px;\">";
                echo "<th style=\"padding:10px;\">15:30</th>"; 
                $mecId = 1;
                for($i = 0; $i<$columns - 1; $i++) {
                    echo "<td style=\"padding:10px;\">";
                    $booking = $db->query("SELECT * FROM booking WHERE time='15:30' AND (mechanic_id='$mecId' AND date='$date');");
                    $flag = false;
                    $printFlag = false;
                    while($bookingRes = $booking->fetchArray(SQLITE3_ASSOC)) {
                        if(!isset($bookingRes['id'])) continue;
                        $booking_id = $bookingRes['id']; 
                        $date = $bookingRes['date']; 
                        $serviceId = $bookingRes['service_id'];
                        $service = $db->query("SELECT * FROM service WHERE id = '$serviceId';");
                        while($serviceRes = $service->fetchArray(SQLITE3_ASSOC)) {
                            if(!isset($serviceRes['id'])) continue;
                            $flag = true;
                            echo "<form action=\"./controllers/cancel-assignment.php\" method=\"POST\">";
                            echo "<input type=\"text\" class=\"form-control\" placeholder=\"";
                            echo $serviceRes['description'];
                            echo " (n.: ";
                            echo $booking_id;
                            echo ")\" readonly><br>";
                            echo "<input type=\"text\" value=\"";
                            echo $date;
                            echo "\" name=\"date\" hidden>";
                            echo "<button class=\"btn btn-sm btn-danger btn-block\" type=\"submit\" value=\"";
                            echo $booking_id;
                            echo "\" name=\"cancelAssignment\">X</button>";
                            echo "</form>";
                        }
                        
                    }
                    if($flag == false) {
                        
                        $booking = $db->query("SELECT * FROM booking WHERE date = '$date' AND time = '';");
                        while($bookingRes = $booking->fetchArray(SQLITE3_ASSOC)) {
                            if(!isset($bookingRes['id'])) continue;
                            $booking_id = $bookingRes['id'];  
                            $serviceId = $bookingRes['service_id'];
                            $service = $db->query("SELECT * FROM service WHERE id = '$serviceId';");
                            while($serviceRes = $service->fetchArray(SQLITE3_ASSOC)) {
                                if(!isset($serviceRes['id'])) {
                                    
                                    continue;
                                };
                                if($printFlag == false) {
                                    echo "<form  action=\"./controllers/assign.php\" method=\"POST\">";
                                    echo "<input type=\"text\" value=\"";
                                    echo $date;
                                    echo "\" name=\"date\" hidden>";
                                    echo "<select class=\"form-control\" name=\"booking_id\">";
                                    $printFlag = true;
                                }
                                echo "<option value=\"";
                                echo $booking_id;
                                echo "\">";
                                echo $serviceRes['description'];
                                echo " (n.: ";
                                echo $booking_id;
                                echo ")</option>";
                                
                            }
                            
                        }
                        if($printFlag == true) {
                            echo "</select><br>";
                                    echo "<input type=\"text\" value=\"15:30\" name=\"time\" hidden>";
                                    echo "<input type=\"text\" value=\"";
                                    echo $mecId;
                                    echo "\" name=\"mechanic_id\" hidden>";

                                    echo "<button class=\"btn btn-sm btn-primary btn-block\" type=\"submit\" value=\"novalue\" name=\"assignment\">Assign</button>";
                                    echo "</form>";
                        }
                        
                    }
                    echo "</td>";
                    $mecId++;
                }
                echo "</tr>";
                echo "</table>";
                include('../public/components/footer.php');
                echo '<script src="../js/myScripts.js"></script>';
                echo '</body>';
                echo '</html>';

	} else {
		header("Location: ../public/index.php");
	}

?>