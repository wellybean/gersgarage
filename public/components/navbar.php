<!-- <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"><a class="nav-link text-dark" href="../public/index.php">Ger's garage</a></h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="../public/aboutus.php">About us</a>
    <a class="p-2 text-dark" href="../public/ourservice.php">Our services</a>
    <a class="p-2 text-dark" href="../public/ourteam.php">Our team</a>
    <a class="p-2 text-dark" href="../public/pricing.php">Pricing</a>
    <?php 
      // if(isset($_SESSION['active'])) {
      //   echo "<a class=\"p-2 text-dark\" href=\"../private/booking.php\">Bookings</a>";
      // }
    ?>
  </nav>
  <?php 
    // if(isset($_SESSION['active'])) {
    //   echo "&nbsp;&nbsp;&nbsp;Hello,&nbsp;<b>";
    //   echo $_SESSION['name'];
    //   echo "&nbsp;&nbsp;&nbsp;</b>";
    //   echo "<a class=\"btn btn-outline-primary\" href=\"../private/controllers/logout.php\">Log out</a>";
    // } else {
    //   echo "<a class=\"btn btn-outline-primary\" href=\"../public/login.php\">Log in</a>";
    // }
  ?>
</div> -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#">Ger's garage</a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="../public/index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <?php 
          if(isset($_SESSION['active']) && $_SESSION['username'] != 'admin' ) {
            echo "<li class=\"nav-item\">";
            echo "<a class=\"nav-link\" href=\"../private/booking.php\">Bookings</a>";
            echo "</li>";
          } elseif (isset($_SESSION['active']) && $_SESSION['username'] == 'admin' ) {
            echo "<li class=\"nav-item\">";
            echo "<a class=\"nav-link\" href=\"../private/admin_page.php\">Admin page</a>";
            echo "</li>";
          }
        ?>
      </ul>
      <?php 
        if(!isset($_SESSION['active'])) {
          echo "<form action=\"./login.php\" class=\"form-inline my-2 my-lg-0\">";
          echo "<button class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\">Log in</button>";
          echo "</form>";
        } else {
          echo "<form action=\"../private/controllers/logout.php\" class=\"form-inline my-2 my-lg-0\">";
          echo "<label class=\"username-label\">Hello, &nbsp;<b>";
          echo $_SESSION['name'];
          echo "</b>&nbsp;&nbsp;&nbsp;</label>";
          echo "<button class=\"btn btn-outline-success my-2 my-sm-0\" type=\"submit\">Log out</button>";
          echo "</form>";
        }
      ?>
    </div>
  </div>
</nav>