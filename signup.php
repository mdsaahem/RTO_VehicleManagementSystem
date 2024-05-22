<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);


session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $username, $password, $database);


$msg = "";

if (isset($_POST['submit'])) {
  $firstname = mysqli_real_escape_string($connection, strtolower($_POST['firstname']));
  $lastname = mysqli_real_escape_string($connection, strtolower($_POST['lastname']));
  $email = mysqli_real_escape_string($connection, strtolower($_POST['email']));
  $username = mysqli_real_escape_string($connection, strtolower($_POST['username']));
  $password = mysqli_real_escape_string($connection, strtolower($_POST['password']));


  $signup_query = "INSERT INTO user (fname, lname, email, username, password, user_type) VALUES ('$firstname','$lastname','$email','$username','$password','USER');";

  $check_query = "SELECT * FROM `user` WHERE username='$username' or email='$email'";

  $check_res = mysqli_query($connection, $check_query);

  if (mysqli_num_rows($check_res) > 0) {
    $msg = '<div class="alert alert-warning" style="margin-top:30px";>
                      <strong>Failed!</strong> Username or Email already exists.
                      </div>';
  } else {
    $signup_res = mysqli_query($connection, $signup_query);
    $msg = '<div class="alert alert-success" style="margin-top:30px";>
                      <strong>Success!</strong> Registration Succefull.
                      </div>';
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="swal/sweetalert.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="swal/sweetalert.js"></script>
  <link rel="stylesheet" href="animate.css">
  <link rel="stylesheet" href="style.css">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
  <?php include 'navbar.php'; ?>

  <form class="form-horizontal animated bounce" action="" method="post" onsubmit="return validateEmail()">




  <br>
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <?php echo $msg; ?>
        <div class="page-header">
          <h1 style="text-align: center;">Sign Up</h1>
        </div>
        <form class="form-horizontal animated bounce" action="" method="post">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input onkeydown="return /[a-z]/i.test(event.key)" id="firstname" type="text" class="form-control" name="firstname" placeholder="First Name" required>
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input onkeydown="return /[a-z]/i.test(event.key)" id="lastname" type="text" class="form-control" name="lastname" placeholder="Lastname" required>
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="email" type="email" class="form-control" name="email" placeholder="Email" required>
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="username" type="text" class="form-control" name="username" placeholder="Username" required>
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
          <br>

          <div class="input-group">
            <button type="submit" name="submit" class="btn btn-success">Sign Up</button>

          </div>

        </form>
      </div>
      <div class="col-md-3"></div>

    </div>

  </div>



</body>
<script>
function validateEmail() {
  var email = document.getElementById('email').value;
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailRegex.test(email)) {
    // Show an alert or error message to the user.
    alert("Please enter a valid email address.");
    return false; // Prevent the form from submitting if email is invalid.
  }

  return true; // Allow the form to submit if email is valid.
}
</script>
</html>