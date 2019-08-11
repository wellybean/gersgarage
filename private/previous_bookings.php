<br>

<div class="form-previous-bookings">

    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal"><b>Your previous bookings</b></h1>
    </div>

    <?php 
        $db = new SQLite3('../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $check = $db->query("SELECT * FROM booking WHERE user_id = {$_SESSION['userId']};");

        $row = array();
        $i = 0;

        while($res = $check->fetchArray(SQLITE3_ASSOC)){ 
			if(!isset($res['id'])) continue; 
			$row[$i]['id'] = $res['id']; 
			$row[$i]['date'] = $res['date']; 
            $row[$i]['time'] = $res['time'];
            $row[$i]['status'] = $res['status']; 
            $row[$i]['comments'] = $res['comments'];
            $row[$i]['invoice_num'] = $res['invoice_num'];
            $mecId = $res['mechanic_id'];
            
            echo $mecId;
            if($mecId == NULL || $mecId = "") {
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
			echo "<div class=\"text-center mb-4\"><h1 class=\"h5 mb-3 font-weight-normal\">No bookings found</h1></div>";
		} else {
		    for($i = sizeof($row) - 1; $i >= 0 ; $i--) {
                echo "<hr>";
                echo "<form action=\"./controllers/cancel_booking.php\" method=\"post\">";
                echo "<div class=\"form-group row\">";
                echo "<label onclick=\"toggleDetails(this)\" class=\"col-sm-8 col-form-label\" style=\"cursor:pointer\">";
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
                echo "<div class=\"col-sm-4\">";
                echo "<br>";
                echo "<button class=\"btn btn-sm btn-danger btn-block\" type=\"submit\" value=\"";
                echo $row[$i]['id'];
                echo "\" name=\"cancel\"";
                if($row[$i]['status'] != "booked"){
                    echo " hidden";
                }
                echo ">Cancel</button>";
                if($row[$i]['invoice_num'] != "") {
                    echo '<a style="text-decoration: none; color:white" href="./make_invoice.php?booking_id=', $row[$i]['id'],'&invoicing=Login"><div class="btn btn-sm btn-primary btn-block">Invoice</div></a>';
                }
                echo "</div>";
                echo "</div>";
                echo "</form>";
            }
		}
    ?>

    </div>
