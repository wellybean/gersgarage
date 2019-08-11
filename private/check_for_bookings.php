<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../public/login.php");
	}
	if(isset($_POST['booking-check'])){
		$db = new SQLite3('../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        echo '<!doctype html>';
            echo '<html lang="en">';
            echo '<head>';
            include('../public/components/head.php');
            echo '</head>';
            echo '<body>';
            include('../public/components/navbar.php');
            echo '<div class="container">';
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";

        if(isset($_POST['week'])) {
            $week = $_POST['week'];
            $year = substr($week, 0, 4);
            $weekNum = substr($week, -2);
            $dto = new DateTime();
            $date = $dto->setISODate($year, $weekNum)->format('Y-m-d');
            
            $row = array();
            $i = 0;

            for($j = 0; $j < 6; $j++) {
                $check = $db->query("SELECT * FROM booking WHERE date = '$date';");

                while($res = $check->fetchArray(SQLITE3_ASSOC)){ 
                    if(!isset($res['id'])) continue; 
                    $row[$i]['id'] = $res['id']; 
                    $row[$i]['date'] = $res['date']; 
                    $row[$i]['time'] = $res['time'];
                    $row[$i]['status'] = $res['status']; 
                    $row[$i]['comments'] = $res['comments'];
                    $mecId = $res['mechanic_id'];
                    if($mecId == NULL) {
                        $row[$i]['mechanic_name'] = NULL;
                    } else {
                        $mechanic = $db->query("SELECT * FROM mechanic WHERE id = '$mecId';");
                        while($mecRes = $mechanic->fetchArray(SQLITE3_ASSOC)) {
                            if(!isset($mecRes['id'])) continue;
                            $row[$i]['mechanic_name'] = $mecRes['name'];
                        }
                    }
                    $vehicleId = $res['vehicle_id'];
                    $vehicle = $db->query("SELECT * FROM vehicle WHERE id = '$vehicleId';");
                    while($vehicleRes = $vehicle->fetchArray(SQLITE3_ASSOC)) {
                        if(!isset($vehicleRes['id'])) continue;
                        $row[$i]['vehicle_type'] = $vehicleRes['type'];
                        $row[$i]['vehicle_make'] = $vehicleRes['make'];
                        $row[$i]['vehicle_license'] = $vehicleRes['license'];
                        $row[$i]['vehicle_engine'] = $vehicleRes['engine'];
                    }
                    $serviceId = $res['service_id'];
                    $service = $db->query("SELECT * FROM service WHERE id = '$serviceId';");
                    while($serviceRes = $service->fetchArray(SQLITE3_ASSOC)) {
                        if(!isset($serviceRes['id'])) continue;
                        $row[$i]['service_description'] = $serviceRes['description'];
                        $row[$i]['service_duration'] = $serviceRes['duration'];
                    }
                    $i++; 
                } 
                $date = $dto->modify('+1 days')->format('Y-m-d');

            }

            
            if(sizeof($row) == 0){
                echo "<br><br><br><br><br><br><div class=\"text-center mb-4\"><h1 class=\"h5 mb-3 font-weight-normal\"><b>No bookings found</b></h1></div><br><br><br><br><br><br>";
            } else {
                for($i = sizeof($row) - 1; $i >= 0 ; $i--) {
                    echo "<hr>";
                    echo "<form action=\"./controllers/change_status.php\" method=\"post\">";
                    echo "<div class=\"form-group row\">";
                    echo "<label style=\"cursor:pointer\" onclick=\"toggleDetails(this)\" class=\"col-sm-8 col-form-label\">";
                    echo "<h1 class=\"h5 font-weight-normal\">";
                    echo $row[$i]['date'];
                    echo ": ";
                    echo $row[$i]['service_description'];
                    echo " on ";
                    echo $row[$i]['vehicle_make'];
                    echo " (License no. ";
                    echo $row[$i]['vehicle_license'];
                    echo ")";
                    echo "</h1>";
                    echo "<p hidden>Booking reference number: <b>";
                    echo $row[$i]['id'];
                    echo "</b><br>Status: <b>";
                    echo $row[$i]['status'];
                    echo "</b><br>Engine type: <b>";
                    echo $row[$i]['vehicle_engine'];
                    echo "</b><br>Estimated start time: <b>";
                    if($row[$i]['time'] == NULL) {
                        echo "not yet assigned";
                    } else {
                        echo $row[$i]['time'];
                    }
                    echo "</b><br>Estimated duration: <b>";
                    echo $row[$i]['service_duration'];
                    echo " minutes</b><br>";
                    echo "Mechanic: <b>";
                    if($row[$i]['mechanic_name'] == NULL) {
                        echo "not yet assigned";
                    } else {
                        echo $row[$i]['mechanic_name'];
                    }
                    echo "</b></p>";
                    echo "</label>";
                    echo "<div class=\"col-sm-4 text-center\">";
                    echo "<select class=\"form-control\" name=\"newstatus\"><option value=\"booked\">Booked</option>
                    <option value=\"in service\">In service</option>
                    <option value=\"fixed/completed\">Fixed/Completed</option>
                    <option value=\"collected\">Collected</option>
                    <option value=\"unrepairable/scrapped\">Unrepairable/Scrapped</option>
                    </select>";
                    echo "<br><button class=\"btn btn-sm btn-primary \" type=\"submit\" value=\"";
                    echo $row[$i]['id'];
                    echo "\" name=\"status\">Change status</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                }
            }
            
        }
        if(isset($_POST['date'])) {
            $date = $_POST['date'];
            $check = $db->query("SELECT * FROM booking WHERE date = '$date';");

            $row = array();
            $i = 0;

            while($res = $check->fetchArray(SQLITE3_ASSOC)){ 
                if(!isset($res['id'])) continue; 
                $row[$i]['id'] = $res['id']; 
                $row[$i]['date'] = $res['date']; 
                $row[$i]['time'] = $res['time'];
                $row[$i]['status'] = $res['status']; 
                $row[$i]['comments'] = $res['comments'];
                $mecId = $res['mechanic_id'];
                if($mecId == NULL) {
                    $row[$i]['mechanic_name'] = NULL;
                } else {
                    $mechanic = $db->query("SELECT * FROM mechanic WHERE id = '$mecId';");
                    while($mecRes = $mechanic->fetchArray(SQLITE3_ASSOC)) {
                        if(!isset($mecRes['id'])) continue;
                        $row[$i]['mechanic_name'] = $mecRes['name'];
                    }
                }
                $vehicleId = $res['vehicle_id'];
                $vehicle = $db->query("SELECT * FROM vehicle WHERE id = '$vehicleId';");
                while($vehicleRes = $vehicle->fetchArray(SQLITE3_ASSOC)) {
                    if(!isset($vehicleRes['id'])) continue;
                    $row[$i]['vehicle_type'] = $vehicleRes['type'];
                    $row[$i]['vehicle_make'] = $vehicleRes['make'];
                    $row[$i]['vehicle_license'] = $vehicleRes['license'];
                    $row[$i]['vehicle_engine'] = $vehicleRes['engine'];
                }
                $serviceId = $res['service_id'];
                $service = $db->query("SELECT * FROM service WHERE id = '$serviceId';");
                while($serviceRes = $service->fetchArray(SQLITE3_ASSOC)) {
                    if(!isset($serviceRes['id'])) continue;
                    $row[$i]['service_description'] = $serviceRes['description'];
                    $row[$i]['service_duration'] = $serviceRes['duration'];
                }
                $i++; 
            } 

            if(sizeof($row) == 0){
                echo "<br><br><br><br><br><br><div class=\"text-center mb-4\"><h1 class=\"h5 mb-3 font-weight-normal\"><b>No bookings found</b></h1></div><br><br><br><br><br><br>";
            } else {
                for($i = sizeof($row) - 1; $i >= 0 ; $i--) {
                    echo "<hr>";
                    echo "<form action=\"./controllers/change_status.php\" method=\"post\">";
                    echo "<div class=\"form-group row\">";
                    echo "<label style=\"cursor:pointer\" onclick=\"toggleDetails(this)\" class=\"col-sm-8 col-form-label\">";
                    echo "<h1 class=\"h5 font-weight-normal\">";
                    echo $row[$i]['date'];
                    echo ": ";
                    echo $row[$i]['service_description'];
                    echo " on ";
                    echo $row[$i]['vehicle_make'];
                    echo " (License no. ";
                    echo $row[$i]['vehicle_license'];
                    echo ")";
                    echo "</h1>";
                    echo "<p hidden>Booking reference number: <b>";
                    echo $row[$i]['id'];
                    echo "</b><br>Status: <b>";
                    echo $row[$i]['status'];
                    echo "</b><br>Engine type: <b>";
                    echo $row[$i]['vehicle_engine'];
                    echo "</b><br>Estimated start time: <b>";
                    if($row[$i]['time'] == NULL) {
                        echo "not yet assigned";
                    } else {
                        echo $row[$i]['time'];
                    }
                    echo "</b><br>Estimated duration: <b>";
                    echo $row[$i]['service_duration'];
                    echo " minutes</b><br>";
                    echo "Mechanic: <b>";
                    if($row[$i]['mechanic_name'] == NULL) {
                        echo "not yet assigned";
                    } else {
                        echo $row[$i]['mechanic_name'];
                    }
                    echo "</b></p>";
                    echo "</label>";
                    echo "<div class=\"col-sm-4 text-center\">";
                    echo "<select class=\"form-control\" name=\"newstatus\"><option value=\"booked\">Booked</option>
                    <option value=\"in service\">In service</option>
                    <option value=\"fixed/completed\">Fixed/Completed</option>
                    <option value=\"collected\">Collected</option>
                    <option value=\"unrepairable/scrapped\">Unrepairable/Scrapped</option>
                    </select>";
                    echo "<br><button class=\"btn btn-sm btn-primary \" type=\"submit\" value=\"";
                    echo $row[$i]['id'];
                    echo "\" name=\"status\">Change status</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                }
            }
            
        }
        echo "<br><br><br>";
        include('../public/components/footer.php');
            echo '<script src="../js/myScripts.js"></script>';
            echo '</body>';
            echo '</html>';
       
        
		
		
		//header("Location: ../../private/booking.php");
	} else {
		header("Location: ../public/index.php");
	}

?>