<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (isset($_SESSION['username']) == false) {

?>



  <div class="container">

    <nav class="navbar navbar-inverse navbar-fixed-top gabanav bg-light" id="myNavbar">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav gabali">
            <li><a href="index.php">Home</a></li>
            <li><a href="features.php">Features</a></li>
            <li><a href="about.html">About Us</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>

      </div>
    </nav>
  </div>


<?php } else { ?>



  <div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top gabanav bg-light" id="myNavbar">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        </div>
        <div class="collapse navbar-collapse bg-light" id="myNavbar">
          <ul class="nav navbar-nav gabali">
            <li><a href="index.php">Home</a></li>
            <li><a href="myvehicle.php?id=<?php echo $_SESSION['username']; ?>">My Vehicle</a></li>
            <li><a href="mynotifications.php?id=<?php echo $_SESSION['username']; ?>">Notifications</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Log Out</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['username']; // echo var_dump($_SESSION);
                                                                                    ?></a></li>
          </ul>
        </div>

      </div>

    </nav>
  </div>


<?php } ?>