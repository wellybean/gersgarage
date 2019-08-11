<br>
<br>
<br>
<br>
<div class="container">
    <!-- Login form -->
    <form class="form-login" action="../private/controllers/check_login_details.php" method="POST" enctype="application/x-www-form-urlencoded">

        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Already registered?</h1>
        </div>

        <div class="form-label-group">
            <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus name="userID">
            <label for="inputUsername">Username</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="userPassword">
            <label for="inputPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="login">Sign in</button>

    </form>
    <br>
    <!-- Sign up form -->
    <form class="form-signup" id="signup" action="../private/controllers/register_user.php" method="POST" enctype="application/x-www-form-urlencoded">

        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Not yet registered?</h1>
            <h1 class="h5 mb-3 font-weight-normal">Register here:</h1>
        </div>

        <div class="form-label-group">
            <input type="text" id="inputName" class="form-control" placeholder="Name" required autofocus name="name">
            <label for="inputName">Name</label>
        </div>

        <div class="form-label-group">
            <input type="email" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus name="email">
            <label for="inputEmail">E-mail</label>
        </div>

        <div class="form-label-group">
            <input type="tel" id="inputTel" class="form-control" placeholder="Telephone number" required autofocus name="phone">
            <label for="inputTel">Telephone number</label>
        </div>

        <div class="form-label-group">
            <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus name="username">
            <label for="inputUsername">Username</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
            <label for="inputPassword">Password</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Sign up" name="signup">Sign up</button>
        
    </form>