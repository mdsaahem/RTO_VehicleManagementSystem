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
$veh_no = $_GET['id'];
// echo $veh_no;

$query = "SELECT  `fname`, `lname`, `email` FROM `user` WHERE username='$username'";
$result = mysqli_query($connection, $query);

$row = mysqli_fetch_assoc($result);
$name = $row['fname'] . " " . $row['lname'];

$uid_query = "SELECT user_id FROM user WHERE username = '$username';";
$uid_res = mysqli_query($connection, $uid_query);
$userid = mysqli_fetch_assoc($uid_res);
$user_id = $userid['user_id'];
// echo $user_id;




$veh_type_query = "SELECT veh_type FROM registered_vehicle WHERE user_id = $user_id AND veh_no = '$veh_no';";
$veh_type_res = mysqli_query($connection, $veh_type_query);
$vehtype = mysqli_fetch_assoc($veh_type_res);
$veh_type = $vehtype['veh_type'];
// echo $veh_type;

$ownname_query = "SELECT fname, lname FROM user where user_id = $user_id;";
$ownname_res = mysqli_query($connection, $ownname_query);
$ownname_ar = mysqli_fetch_assoc($ownname_res);
// echo var_dump($ownname_ar);
$ownname = $ownname_ar['fname'] . ' ' . $ownname_ar['lname'];
// echo $ownname;


$enginecc_query = "SELECT engine_cc FROM registered_vehicle WHERE user_id=$user_id AND veh_no= '$veh_no';";
$enginecc_res = mysqli_query($connection, $enginecc_query);
$enginecc = mysqli_fetch_assoc($enginecc_res);
$engine_cc = $enginecc['engine_cc'];
// echo $engine_cc;
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
                <h1 style="text-align:center;">Enter the RC Details</h1>
                <?php //echo $msg; 
                ?>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form class="animated bounce" action="bookingactionRC.php" method="post">

                    <div class="input-group">
                        <span class="input-group-addon"><b>Name</b></span>
                        <input id="name" type="text" class="form-control" name="name" value="<?php echo $row['fname'] . " " . $row['lname']; ?>" required>
                    </div>

                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><b>RC No.</b></span>
                        <input id="name" type="text" class="form-control" name="rcno" value="<?php echo $veh_no; ?>" required>
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon"><b>Vehicle Type</b></span>
                        <input id="maker" type="text" class="form-control" name="vehtype" placeholder="2/4 WHEELER" value="<?php echo $veh_type; ?>" required>
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon"><b>Vehicle Number</b></span>
                        <input id="vehno" type="text" class="form-control" name="vehno" placeholder="Your vehicle number" value="<?php echo $veh_no; ?>" required>
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon"><b>Owner Name</b></span>
                        <input id="model" type="text" class="form-control" name="ownname" placeholder="Enter the name of the owner" value="<?php echo $ownname; ?>" required>
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon"><b>Engine CC</b></span>
                        <input id="enginecc" type="text" class="form-control" name="enginecc" placeholder="It's something like 220CC" value="<?php echo $engine_cc; ?>" required>
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon"><b>Date of Registration</b></span>
                        <input id="chassisno" type="text" class="form-control" name="dateofreg" placeholder="In format yyyy-mm-dd">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><b>Registration Valid Till</b></span>
                        <input id="uid" type="text" class="form-control" name="regvalidity" placeholder="In format yyyy-mm-dd">
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon"><b>Engine No.</b></span>
                        <input id="uid" type="text" class="form-control" name="engineno" placeholder="Your Engine No.">
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon"><b>Chassis No.</b></span>
                        <input id="uid" type="text" class="form-control" name="chassisno" placeholder="Your Engine No.">
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon"><b>RTO Name</b></span>
                        <input id="uid" type="text" class="form-control" name="rtoname" placeholder="Enter the RTO name">
                    </div>
                    <br>


                    <div class="input-group" id="type">
                        <span class="input-group-addon"><b>Fuel Type</b></span> &nbsp;
                        <label><input type="radio" name="fueltype" value="PETROL"> PETROL</label> &nbsp;
                        <label><input type="radio" name="fueltype" value="DIESEL"> DIESEL</label>

                    </div>
                    <br>

                    <div class="input-group" id="type">
                        <span class="input-group-addon"><b>Emission Norms</b></span> &nbsp;
                        <label><input type="radio" name="enorm" value="BSIII"> BS 3</label> &nbsp;
                        <label><input type="radio" name="enorm" value="BSIV"> BS 4</label> &nbsp;
                        <label><input type="radio" name="enorm" value="BSVI"> BS 6</label>

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