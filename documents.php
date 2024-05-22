<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (!isset($_SESSION)) {

    session_start();
}

$veh_no = $_GET['id'];
//echo $username;

$servername = "localhost";
$usernam = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $usernam, $password, $database);


$username = $_SESSION['username'];
$uid_query = "SELECT user_id from user WHERE username='$username';";
$uid_res = mysqli_query($connection, $uid_query);
$uid_row = mysqli_fetch_assoc($uid_res);
$uid = $uid_row['user_id'];
// echo $uid;



$query = "SELECT * FROM documents where veh_no='$veh_no';";
$result1 = mysqli_query($connection, $query);


//echo $query;

$result = mysqli_query($connection, $query);
// echo print_r(var_mysqli_fetch_assoc($result));
// echo print_r(mysqli_fetch_assoc($result));

// echo var_dump($uid_row);
// echo var_dump($uid_res);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vehicles</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1 style="text-align: center;">My Vehicle</h1>
            </div>
        </div>


        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Vehicle No.</th>
                        <th>RC</th>
                        <th>Insurance</th>
                        <th>PUC No.</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    // $row = mysqli_fetch_assoc($result);
                    $test = mysqli_fetch_assoc($result1);
                    // echo var_dump($test);
                    // echo $test;
                    // if ($test > 0) {
                    ?>
                    <tr>
                        <td><?php echo $veh_no ?></td>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            // echo var_dump($row);
                        ?>
                            <?php if ($row['rc_no'] == null || $row == null) { ?>
                                <td><a href="bookingRC.php?id=<?php echo $veh_no; ?>">Enter RC Details</a></td>
                            <?php } else { ?>
                                <td><a class="btn btn-info" href="regcertificate.php?id=<?php echo $row['rc_no']; ?>">View RC</a></td>
                            <?php } ?>


                            <?php if ($row['insurance_no'] == null) { ?>
                                <td><a href="bookingInsurance.php?id=<?php echo $veh_no; ?>">Enter Insurance Details</a></td>
                            <?php } else { ?>
                                <td><a class="btn btn-info" href="insurance.php?id=<?php echo $veh_no; ?>">View Insurance</a></td>
                            <?php } ?>


                            <?php if ($row['puc_no'] == null) { ?>
                                <td><a href="bookingPUC.php?id=<?php echo $veh_no; ?>">Enter PUC Details</a></td>
                            <?php } else { ?>
                                <td><a class="btn btn-info" href="puc.php?id=<?php echo $veh_no; ?>">View PUC</a></td>
                            <?php } ?>


                    </tr>
                </tbody>

            <?php } ?>

            </table>
        </div>
    </div>
</body>

</html>