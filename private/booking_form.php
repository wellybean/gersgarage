<br>

<form class="form-booking" action="../private/controllers/make_booking.php" method="POST" enctype="application/x-www-form-urlencoded">

    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal"><b>Book a maintenance check</b></h1>
    </div>

    <div class="form-group">
        <label for="inputService">Select a maintenance check:</label>
        <select class="form-control" onchange="checkDates()" name="service_id">
            <?php 
                $db = new SQLite3('../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                
                $check = $db->query("SELECT * FROM service;");
                    
                while($res = $check->fetchArray(SQLITE3_ASSOC)){ 
                    if(!isset($res['id'])) continue; 
                    echo '<option value="';
                    echo $res['id'];
                    echo '">'; 
                    echo $res['description'];
                    echo '</option>';
                    $i++; 
                } 
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="inputDate">Select a date:</label>
        <select class="form-control" onchange="checkDates()" name="date">
        <?php
            $db = new SQLite3('../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
            date_default_timezone_set('Europe/Dublin');
            for($i = 1; $i <= 30; $i++) {
                $date  = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d") + $i, date("Y")));
                $check = $db->query("SELECT SUM(service.duration) FROM booking JOIN service ON booking.service_id = service.id WHERE booking.date = '$date';");
                
                while($res = $check->fetchArray(SQLITE3_ASSOC)){ 
                    if($res['SUM(service.duration)'] >= 1680) continue; 
                    if(date("l", strtotime($date)) == "Sunday") continue;
                    echo '<option value="';
                    echo $date;
                    echo '">'; 
                    echo date("D, jS F Y", strtotime($date));
                    echo '</option>';
                } 
                
            }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="vehicles">Select your vehicle</label>
        <select id="vehicles" class="form-control" name="vehicle_id">
            <?php 
                $db = new SQLite3('../db/db.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
                
                $check = $db->query("SELECT * FROM vehicle WHERE user_id = {$_SESSION['userId']};");
                 
                $i = 0; 
                    
                while($res = $check->fetchArray(SQLITE3_ASSOC)){ 
                    if(!isset($res['id'])) continue; 
                    echo '<option value="';
                    echo $res['id'];
                    echo '">'; 
                    echo $res['make'];
                    echo ' - License no. ';
                    echo $res['license'];
                    echo '</option>';
                    $i++; 
                } 
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="inputComments">Additional Comments</label>
        <textarea rows="3" class="form-control" placeholder="" name="comments"></textarea>
    </div>    

    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="booking">Book a service</button>

</form>
