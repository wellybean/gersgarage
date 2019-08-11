<?php
	session_start();
	if(!isset($_SESSION['active'])) {
		header("location: ../public/login.php");
	}
	if(isset($_GET['invoicing'])){
		$db = new SQLite3('../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

        $booking_id = $_GET['booking_id'];
        
        $row = array();
        $i = 0;

        $total = 0;

        $booking = $db->query("SELECT * FROM booking WHERE id='$booking_id';");
        while($res = $booking->fetchArray(SQLITE3_ASSOC)){ 
            if(!isset($res['id'])) continue; 
            $row[$i]['id'] = $res['id']; 
            $row[$i]['user_id'] = $res['user_id'];
            $userId = $row[$i]['user_id'];
            $user = $db->query("SELECT * FROM user WHERE id = '$userId';");
            while($userRes = $user->fetchArray(SQLITE3_ASSOC)) {
                if(!isset($userRes['id'])) continue;
                $row[$i]['user_name'] = $userRes['name'];
                $row[$i]['user_phone'] = $userRes['phone'];
                $row[$i]['user_email'] = $userRes['email'];
            }
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
                $row[$i]['service_price'] = $serviceRes['price'];
                $total += $row[$i]['service_price'];
            }
            $row[$i]['invoice_num'] = $res['invoice_num'];
			$i++; 
        } 

		if(sizeof($row) == 0){
            echo '<!doctype html>';
            echo '<html lang="en">';
            echo '<head>';
            include('../public/components/head.php');
            echo '</head>';
            echo '<body>';
            include('../public/components/navbar.php');
            echo '<div class="container">';
            echo "<div class=\"text-center mb-4\"><h1 class=\"h5 mb-3 font-weight-normal\"><br><br><br><br><br><br><br><br><br><br>No such booking found<br><br><br><br><br><br></h1></div>";
            echo '</div>';
            include('../public/components/footer.php');
            echo '<script src="../js/myScripts.js"></script>';
            echo '</body>';
            echo '</html>';
			
		} else {
            if($row[0]['status'] == "fixed/completed") {
                if($row[0]['invoice_num'] == "") {
                    echo '<!doctype html>';
                    echo '<html lang="en">';
                    echo '<head>';
                    include('../public/components/head.php');
                    echo '</head>';
                    echo '<body>';
                    include('../public/components/navbar.php');
                    echo '<div class="container"><br><br><br><br><br>';
                    echo '<h1 class=\"h3 mb-3 font-weight-normal\">Booking reference number: ', $row[0]['id'], '</h1>';
                    echo '<p>Date: <b>', $row[0]['date'], '</b><br>';
                    echo 'Time: <b>', $row[0]['time'], '</b><br>';
                    echo 'Service: <b>', $row[0]['service_description'], '</b><br>';
                    echo 'Vehicle type: <b>', ucfirst($row[0]['vehicle_type']), '</b><br>';
                    echo 'Vehicle make: <b>', $row[0]['vehicle_make'], '</b><br>';
                    echo 'Mechanic: <b>', $row[0]['mechanic_name'], '</b><br>';
                    echo 'Status: <b>', $row[0]['status'], '</b></p>';
                    $parts = array();
                    $j = 0;
                    $booking_id = $row[0]['id'];
                    $usedParts = $db->query("SELECT * FROM parts_used WHERE booking_id='$booking_id';");
                    while($res = $usedParts->fetchArray(SQLITE3_ASSOC)){ 
                        if(!isset($res['booking_id'])) continue; 
                        $parts[$j]['part_used_id'] = $res['id'];
                        $part_id = $res['part_id'];
                        
                        $part = $db->query("SELECT * FROM parts WHERE id='$part_id';");
                        while($partRes = $part->fetchArray(SQLITE3_ASSOC)){
                            if(!isset($partRes['id'])) continue;
                            
                            $parts[$j]['part_description'] = $partRes['description'];
                            $parts[$j]['part_price'] = $partRes['price'];
                            $total += $parts[$j]['part_price'];
                        }
                        $j++;
                    }

                    $extras = array();
                    $j = 0;
                    $extrasRes = $db->query("SELECT * FROM extras WHERE booking_id='$booking_id';");
                    while($res = $extrasRes->fetchArray(SQLITE3_ASSOC)){ 
                        if(!isset($res['booking_id'])) continue; 
                        $extras[$j]['extra_id'] = $res['id'];
                        $extras[$j]['description'] = $res['description'];
                        $extras[$j]['price'] = $res['price'];
                        $total += $extras[$j]['price'];
                        $j++;
                    }

                    echo '<table>';
                    echo '<tr>';
                    echo '<th colspan="3">BASE COST</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td style="width:400px">', $row[0]['service_description'], '</td>';
                    echo '<td  colspan="2">€', $row[0]['service_price'], '.00</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th colspan="3">EXTRA PARTS</th>';
                    echo '</tr>';
                    if(sizeof($parts) > 0) {
                        
                        for ($i = 0; $i < sizeof($parts); $i++) {
                            echo '<tr>
                            <td>', $parts[$i]['part_description'], '</td>
                            <td>€', number_format($parts[$i]['part_price'], 2, '.', ''), '</td>
                            <td><form action="./controllers/delete_part_from_booking.php" method="POST" enctype="application/x-www-form-urlencoded">
                            <input id="inputBookingNumber" type="text" class="form-control" value="', $booking_id, '" placeholder="" name="booking_num" hidden>
                            <button class="btn btn-sm btn-danger" type="submit" value="', $parts[$i]['part_used_id'], '" name="deletePart">Delete</button>
                            </form></td></tr>';
                        }
                    }
                    echo '<tr><td colspan="3">
                    <form class="form-booking" action="./controllers/add_part_to_booking.php" method="POST" enctype="application/x-www-form-urlencoded">
                        <div class="form-group">
                            <select class="form-control" name="part_id">';
                                
                                    $db = new SQLite3('../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                                    
                                    $check = $db->query("SELECT * FROM parts;");
                                        
                                    while($res = $check->fetchArray(SQLITE3_ASSOC)){ 
                                        if(!isset($res['id'])) continue; 
                                        echo '<option value="', $res['id'], '">', $res['description'], '</option>';
                                    } 
                            echo '</select>
                        </div>
                    
                        <div class="form-group">
                            <input id="inputBookingNumber" type="text" class="form-control" value="', $booking_id, '" placeholder="" name="booking_num" hidden>
                        </div>
                    
                        <button class="btn btn-sm btn-primary btn-block" type="submit" value="Login" name="parts">Add part to booking</button>
                    
                    </form></td></tr>';
                    echo '<tr>';
                    echo '<th colspan="3">EXTRA COSTS/DISCOUNTS</th>';
                    echo '</tr>';
                    if(sizeof($extras) > 0) {
                        
                        for ($i = 0; $i < sizeof($extras); $i++) {
                            echo '<tr>
                            <td>', $extras[$i]['description'], '</td>
                            <td>€', number_format($extras[$i]['price'], 2, '.', ''), '</td>
                            <td><form action="./controllers/delete_extra_from_booking.php" method="POST" enctype="application/x-www-form-urlencoded">
                            <input id="inputBookingNumber" type="text" class="form-control" value="', $booking_id, '" placeholder="" name="booking_num" hidden>
                            <button class="btn btn-sm btn-danger" type="submit" value="', $extras[$i]['extra_id'], '" name="deleteExtra">Delete</button>
                            </form></td></tr>';
                        }
                    }

                    

                    echo '<tr><td colspan="3">
                    <form class="form-booking" action="./controllers/add_extra_to_booking.php" method="POST" enctype="application/x-www-form-urlencoded">
                    
                        <div class="form-group">
                            <label>Type in description:</label>
                            <input id="inputBookingNumber" type="text" class="form-control" placeholder="" name="description">
                        </div>

                        <div class="form-group">
                            <label>Type in price/discount:</label>
                            <input id="inputBookingNumber" type="text" class="form-control" placeholder="" name="value">
                        </div>
                    
                        <button class="btn btn-sm btn-primary btn-block" type="submit" value="', $booking_id, '" name="extras">Add extra to booking</button>
                    
                    </form></td></tr>';
                    echo '<tr>';
                    echo '<th>TOTAL</th>';
                    echo '<th colspan="2">€', $total, '</th>';
                    echo '</tr>';
                    echo '</table>';
                    echo    '<form action="./controllers/generate_invoice.php" method="POST">
                                <button  class="btn btn-sm btn-primary btn-block" type="submit" value="', $booking_id, '" name="genInvoice">Add extra to booking</button>           
                            </form>';
                    echo '</div>';
                    include('../public/components/footer.php');
                    echo '<script src="../js/myScripts.js"></script>';
                    echo '</body>';
                    echo '</html>';
                } else {
                    echo '  <!doctype html>
                            <html lang="en">
                                <head>';
                                include('../public/components/head.php');
                    echo '      </head>
                                <body>
                                    <div class="invoice p-3 m-3" style="width:800px;height:1132px;border:1px solid black;">
                                        <h1 class="text-right">INVOICE N. ', $row[0]['invoice_num'],'</h1>
                                        <br>
                                        <p class="text-right">', date("D, jS F Y", strtotime($row[0]['date'])),'</p>
                                        <p><b>Ger\'s Garage</b><br>
                                        30 - 34 Westmoreland St., Dublin 2<br>
                                        Phone: +353 254 5984<br>
                                        E-mail: contact@gersgarage.ie</p>
                                        <br>
                                        <p><b>Bill to:</b><br>',
                                        $row[0]['user_name'],'<br>',
                                        'Phone: ', $row[0]['user_phone'],'<br>',
                                        'E-mail: ', $row[0]['user_email'], '</p>
                                        <br>
                                        <table class="table">
                                            <tr>
                                                <th scope="column">DESCRIPTION</th>
                                                <th scope="column">AMOUNT</th>
                                            </tr>
                                            <tr>
                                                <td>', $row[0]['service_description'],'</td>
                                                <td>€', $row[0]['service_price'],'.00</td>
                                            </tr>';
                    $parts = array();
                    $j = 0;
                    $booking_id = $row[0]['id'];
                    $usedParts = $db->query("SELECT * FROM parts_used WHERE booking_id='$booking_id';");
                    while($res = $usedParts->fetchArray(SQLITE3_ASSOC)){ 
                        if(!isset($res['booking_id'])) continue; 
                        $parts[$j]['part_used_id'] = $res['id'];
                        $part_id = $res['part_id'];
                                                
                        $part = $db->query("SELECT * FROM parts WHERE id='$part_id';");
                        while($partRes = $part->fetchArray(SQLITE3_ASSOC)){
                            if(!isset($partRes['id'])) continue;
                                                    
                            $parts[$j]['part_description'] = $partRes['description'];
                            $parts[$j]['part_price'] = $partRes['price'];
                            $total += $parts[$j]['part_price'];
                        }
                        $j++;
                    }
                    $extras = array();
                    $j = 0;
                    $extrasRes = $db->query("SELECT * FROM extras WHERE booking_id='$booking_id';");
                    while($res = $extrasRes->fetchArray(SQLITE3_ASSOC)){ 
                        if(!isset($res['booking_id'])) continue; 
                        $extras[$j]['extra_id'] = $res['id'];
                        $extras[$j]['description'] = $res['description'];
                        $extras[$j]['price'] = $res['price'];
                        $total += $extras[$j]['price'];
                        $j++;
                    }
                    for ($i = 0; $i < sizeof($parts); $i++) {
                        echo '              <tr>
                                                <td>', $parts[$i]['part_description'], '</td>
                                                <td>€', number_format($parts[$i]['part_price'], 2, '.', ''), '</td>
                                            </tr>';
                    }
                    for($i = 0; $i < sizeof($extras);$i++) {
                        echo '              <tr>
                                                <td>', $extras[$i]['description'], '</td>
                                                <td>€', number_format($extras[$i]['price'], 2, '.', ''), '</td>
                                            </tr>';
                    }                        
                    echo '                  <tr>    
                                                <th>TOTAL</th>
                                                <th>€', $total, '</th>
                                            </tr>
                                        </table>
                                        <br>
                                        <p class="text-center">THANK YOU FOR YOUR BUSINESS</p>
                                    </div>
                                    <script src="../js/myScripts.js"></script>
                                </body>
                            </html>';
                }
            } else {
                echo '<!doctype html>';
                echo '<html lang="en">';
                echo '<head>';
                include('../public/components/head.php');
                echo '</head>';
                echo '<body>';
                include('../public/components/navbar.php');
                echo '<div class="container">';
                echo "<div class=\"text-center mb-4\"><h1 class=\"h5 mb-3 font-weight-normal\"><br><br><br><br><br><br><br><br><br><br>Maintenance check not yet finilised.<br><br><br><br><br><br></h1></div>";
                echo '</div>';
                include('../public/components/footer.php');
                echo '<script src="../js/myScripts.js"></script>';
                echo '</body>';
                echo '</html>';
            }
            
		    // for($i = sizeof($row) - 1; $i >= 0 ; $i--) {
            //     echo "<hr>";
            //     echo "<form action=\"./controllers/cancel_booking.php\" method=\"post\">";
            //     echo "<div class=\"form-group row\">";
            //     echo "<label onclick=\"toggleDetails(this)\" class=\"col-sm-8 col-form-label\">";
            //     echo "<h1 class=\"h5 font-weight-normal\">";
            //     echo $row[$i]['date'];
            //     echo ": ";
            //     echo $row[$i]['service_description'];
            //     echo " on ";
            //     echo $row[$i]['vehicle_make'];
            //     echo " (License no. ";
            //     echo $row[$i]['vehicle_license'];
            //     echo ")";
            //     echo "</h1>";
            //     echo "<p>Booking reference number: <b>";
            //     echo $row[$i]['id'];
            //     echo "</b><br>Status: <b>";
            //     echo $row[$i]['status'];
            //     echo "</b><br>Engine type: <b>";
            //     echo $row[$i]['vehicle_engine'];
            //     echo "</b><br>";
            //     echo "Mechanic: <b>";
            //     if($row[$i]['mechanic_name'] == NULL) {
            //         echo "not yet assigned";
            //     } else {
            //         echo $row[$i]['mechanic_name'];
            //     }
            //     echo "</b></p>";
            //     echo "</label>";
            //     echo "<div class=\"col-sm-4\">";
            //     echo "<button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\" value=\"";
            //     echo $row[$i]['id'];
            //     echo "\" name=\"cancel\">Cancel</button>";
            //     echo "</div>";
            //     echo "</div>";
            //     echo "</form>";
            // }
        }

	} else {
        echo "meu cu";
		//header("Location: ../public/index.php");
	}

?>