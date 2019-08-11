    <br>
    <br>
    <br>
    <br>

    <form class="form-register-vehicle" action="../private/controllers/register_vehicle.php" method="POST" enctype="application/x-www-form-urlencoded">

        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal"><b>Register a vehicle</b></h1>
            <h1 class="h5 mb-3 font-weight-normal">(before making a booking)</h1>
        </div>

        <div class="form-group">
            <label for="inputType">Select car type:</label>
            <select onchange="displayMakes(this)" class="form-control" name="type">
                <option value="unselected">Please select an option</option>
                <option value="car">Car</option>
                <option value="motorbike">Motorbike</option>
                <option value="van">Van</option>
                <option value="minibus">Minibus</option>
            </select>
        </div>

        <div class="form-group">
            <label for="vehicle_make_select">Select car make:</label>
            <select id="vehicle_make_select" class="form-control" name="make">
                <option value="unselected">Please select a vehicle type</option>
            </select>
        </div>

        <div class="form-group">
            <label for="vehicle_make_select">Select type of engine:</label>
            <select id="vehicle_make_select" class="form-control" name="engine">
                <option value="unselected">Please select an engine type</option>
                <option value="diesel">Diesel</option>
                <option value="petrol">Petrol</option>
                <option value="hybrid">Hybrid</option>
                <option value="electric">Electric</option>
            </select>
        </div>

        <div class="form-group">
        <label for="inputLicense">License no.:</label>
            <input type="text" id="inputLicense" class="form-control" placeholder="" required name="license">
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="register_vehicle">Register vehicle</button>

    </form>
