<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (!isset($_SESSION)) {
  session_start();
}


$servername = "localhost";
$usernam = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $usernam, $password, $database);

$username = $_SESSION['username'];
// echo $username;

$query = "SELECT  `fname`, `lname`, `email` FROM `user` WHERE username='$username'";
$result = mysqli_query($connection, $query);

$row = mysqli_fetch_assoc($result);
$name = $row['fname'] . " " . $row['lname'];

$uid_query = "SELECT user_id FROM user WHERE username = '$username';";
$uid_res = mysqli_query($connection, $uid_query);
$userid = mysqli_fetch_assoc($uid_res);
$user_id = $userid['user_id'];
echo $user_id;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register Vehicle</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/wickedpicker.min.css">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="sweetalert2/sweetalert2.css">
  <script src="sweetalert2/sweetalert2.min.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/wickedpicker.min.js"></script>
  <link rel="stylesheet" href="animate.css">
  <link rel="stylesheet" href="style.css">

</head>
<style>
  .navbar-fixed-top.scrolled {
    background-color: ghostwhite;
    transition: background-color 200ms linear;
  }
</style>

<body>
  <?php include 'navbar.php'; ?>
  <br>
  <div class="container">
    <div class="row">
      <div class="page-header">
        <h1 style="text-align:center;">Register Your Vehicle</h1>
        <?php //echo $msg; 
        ?>
      </div>
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <form class="animated bounce" action="bookingaction.php" method="post">

          <div class="input-group">
            <span class="input-group-addon"><b>User ID</b></span>
            <input id="uid" type="text" class="form-control" name="userid" placeholder="Don't change this!" value=<?php echo $user_id; ?>>
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><b>Vehicle Number</b></span>
            <input id="vehno" type="text" class="form-control" name="vehno" placeholder="Your vehicle number" required>
          </div>
          <br>
          <div class="input-group" id="type">
            <span class="input-group-addon"><b>Vehicle Type</b></span> &nbsp;
            <label><input type="radio" name="type" value="2 WHEELER"> 2 Wheeler</label> &nbsp;
            <label><input type="radio" name="type" value="4 WHEELER"> 4 Wheeler</label>

          </div>
          <br>

          <div class="input-group">
            <span class="input-group-addon"><b>Maker</b></span>
            <input id="maker" type="text" class="form-control" name="maker" placeholder="It's the company (like Bajaj/Ford/TATA)" required>
          </div>
          <br>


          <div class="input-group">
            <span class="input-group-addon"><b>Model</b></span>
            <input id="model" type="text" class="form-control" name="model" placeholder="Your vehicle model (like Pulsar NS/Mustang/ Veyron)" required>
          </div>
          <br>

          <div class="input-group">
            <span class="input-group-addon"><b>Engine CC</b></span>
            <input id="enginecc" type="text" class="form-control" name="enginecc" placeholder="It's something like 220CC" required>
          </div>
          <br>

          <div class="input-group">
            <span class="input-group-addon"><b>Chassis No.</b></span>
            <input id="chassisno" type="text" class="form-control" name="chassisno" placeholder="Your engine no.">
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><b>User ID</b></span>
            <input id="uid" type="text" class="form-control" name="userid" placeholder="Don't change this!" value=<?php echo $user_id; ?>>
          </div>
          <br>

          <input type="hidden" name="username" value="<?php echo $username; ?>">



          <input type="submit" name="submit" class="btn btn-success">

        </form>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>

  <script>
    $(function() {
      $(document).scroll(function() {
        var $nav = $(".navbar-fixed-top");
        $a = $(".navbar-fixed-top");
        $nav.toggleClass('scrolled', $(this).scrollTop() > $a.height());
      });
    });
  </script>
</body>

</html>