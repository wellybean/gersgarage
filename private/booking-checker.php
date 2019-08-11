<br>
<br>
<br>
<br>

<form class="form-checker" action="./check_for_bookings.php" method="post" enctype="application/x-www-form-urlencoded">
    
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal"><b>Check for bookings</b></h1>
    </div>

    <div class="form-group">
        <label>Select a type of search:</label><br>
        <label>
            <input type="radio" id="dailyRadio" onclick="toggleDateFields()" name="searchType" value="miss">
            Daily &nbsp;
        </label>
        <label>
            <input type="radio" id="weeklyRadio" onclick="toggleDateFields()" name="searchType" value="miss">
            Weekly
        </label>
    </div>    

    <div class="form-group">
        <label for="weekInput">Select a week:</label><br>
        <input id="weekInput"  class="form-control" type="week" name="week" disabled>
    </div>   
    
    <div class="form-group">
        <label for="dateInput">Select a date:</label><br>
        <input id="dateInput" class="form-control" type="date" name="date" disabled>
    </div> 
    
    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="booking-check">Look for bookings</button>
</form>