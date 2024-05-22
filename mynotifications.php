<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

if (!isset($_SESSION)) {
    session_start();
}

$veh_no = $_GET['id'];
$username = $_SESSION['username'];

$servername = "localhost";
$usernam = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $usernam, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$insu_query = "SELECT i.insurance_no, i.user_id, i.veh_no, i.maker, i.model, i.insurance_status, i.insurance_expiry FROM insurance i, user u, registered_vehicle r WHERE u.user_id = r.user_id AND r.veh_no = i.veh_no AND i.insurance_expiry < curdate() AND u.username = '$username';";
$ins_result = mysqli_query($connection, $insu_query);

if (!$ins_result) {
    die("Query failed: " . mysqli_error($connection));
}

$ins_result1 = mysqli_query($connection, $insu_query);
$ins_row = mysqli_fetch_assoc($ins_result1);

$puc_query = "SELECT p.puc_no, p.veh_no, p.maker, p.model, p.status, p.valid_till FROM puc p, user u, registered_vehicle r WHERE u.user_id = r.user_id AND r.veh_no= p.veh_no and p.valid_till < curdate() AND u.username = '$username';";
$puc_result = mysqli_query($connection, $puc_query);

if (!$puc_result) {
    die("Query failed: " . mysqli_error($connection));
}

$puc_result1 = mysqli_query($connection, $puc_query);
$puc_row = mysqli_fetch_assoc($puc_result1);

$f_query = "SELECT f.VEH_NO, r.maker, r.model, f.VALIDITY, f.NEXT_DUE_DATE FROM fitness f, registered_vehicle r, user u WHERE u.user_id = r.user_id AND r.veh_no=f.VEH_NO AND f.NEXT_DUE_DATE < curdate() AND u.username = '$username' LIMIT 0, 25;";
$f_result = mysqli_query($connection, $f_query);

if (!$f_result) {
    die("Query failed: " . mysqli_error($connection));
}

$f_result1 = mysqli_query($connection, $f_query);
$f_row = mysqli_fetch_assoc($f_result1);

$ch_query = "SELECT c.VEH_NO, r.maker, r.model, c.CHALLAN_NO, c.AMOUNT, c.OFFENCE_TYPE, c.OFFENCE_DATE, c.STATUS FROM challan_details c, registered_vehicle r, user u WHERE u.user_id=r.user_id AND r.veh_no=c.VEH_NO AND c.STATUS = 'ACTIVE' AND u.username='$username';";
$ch_result = mysqli_query($connection, $ch_query);

if (!$ch_result) {
    die("Query failed: " . mysqli_error($connection));
}

$ch_result1 = mysqli_query($connection, $ch_query);
$ch_row1 = mysqli_fetch_assoc($ch_result1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div class="page-header">
        <h1 style="text-align: center;">Notifications</h1>
    </div>

    <!-- Display Expired Insurance -->
    <?php if ($ins_result1 == null) { ?>
        <br>
    <?php } else { ?>
        <div class="page-header">
            <h3 style="text-align: center;">Expired Insurance's</h3>
        </div>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Insurance No.</th>
                        <th>Vehicle No.</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>Status</th>
                        <th>Expired On</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php while ($ins_row = mysqli_fetch_assoc($ins_result)) { ?>
                            <td><?php echo $ins_row['insurance_no']; ?></td>
                            <td><?php echo $ins_row['veh_no']; ?></td>
                            <td><?php echo $ins_row['maker']; ?></td>
                            <td><?php echo $ins_row['model']; ?></td>
                            <td><?php echo $ins_row['insurance_status']; ?></td>
                            <td><?php echo $ins_row['insurance_expiry']; ?></td>
                            <td><a class="btn btn-info" href="updateInsurance.php?id=<?php echo $ins_row['veh_no']; ?>">Update your Insurance<br>Here</a></td>
                            <td>or</td>
                            <td><a class="btn btn-info" href="https://www.policybazaar.com/motor-insurance/">See best plans</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <!-- Display Expired PUC -->
    <?php if ($puc_result1 == null) { ?>
        <br>
    <?php } else { ?>
        <div class="page-header">
            <h3 style="text-align: center;">Expired PUC's</h3>
        </div>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>PUC No.</th>
                        <th>Vehicle No.</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>Status</th>
                        <th>Expired On</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php while ($puc_row = mysqli_fetch_assoc($puc_result)) { ?>
                            <td><?php echo $puc_row['puc_no']; ?></td>
                            <td><?php echo $puc_row['veh_no']; ?></td>
                            <td><?php echo $puc_row['maker']; ?></td>
                            <td><?php echo $puc_row['model']; ?></td>
                            <td><?php echo $puc_row['status']; ?></td>
                            <td><?php echo $puc_row['valid_till']; ?></td>
                            <td><a class="btn btn-info" href="updatePUC.php?id=<?php echo $puc_row['veh_no']; ?>">Update your PUC Here</a></td>
                            <td>or</td>
                            <td><a class="btn btn-info" href="http://google.com">See best plans</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <!-- Display Expired Fitness -->
    <?php if ($f_row == null) { ?>
        <br>
    <?php } else { ?>
        <div class="page-header">
            <h3 style="text-align: center;">Expired Fitness</h3>
        </div>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Vehicle No.</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>Status</th>
                        <th>Expired On</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php while ($f_row = mysqli_fetch_assoc($f_result)) { ?>
                            <td><?php echo $f_row['VEH_NO']; ?></td>
                            <td><?php echo $f_row['maker']; ?></td>
                            <td><?php echo $f_row['model']; ?></td>
                            <td><?php echo $f_row['VALIDITY']; ?></td>
                            <td><?php echo $f_row['NEXT_DUE_DATE']; ?></td>
                            <td><a class="btn btn-info" href="bookingPUC.php?id=<?php echo $puc_row['VEH_NO']; ?>">Update your PUC Here</a></td>
                            <td>or</td>
                            <td><a class="btn btn-info" href="http://google.com">See best plans</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <!-- Display Active Challans -->
    <?php if ($ch_row1 == null) { ?>
        <br>
    <?php } else { ?>
        <div class="page-header">
            <h3 style="text-align: center;">Active Challan's</h3>
        </div>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Vehicle No.</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>Challan No.</th>
                        <th>Amount</th>
                        <th>Offence Type</th>
                        <th>Offence Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php while ($ch_row = mysqli_fetch_assoc($ch_result)) { ?>
                            <td><?php echo $ch_row['VEH_NO']; ?></td>
                            <td><?php echo $ch_row['maker']; ?></td>
                            <td><?php echo $ch_row['model']; ?></td>
                            <td><?php echo $ch_row['CHALLAN_NO']; ?></td>
                            <td><?php echo $ch_row['AMOUNT']; ?></td>
                            <td><?php echo $ch_row['OFFENCE_TYPE']; ?></td>
                            <td><?php echo $ch_row['OFFENCE_DATE']; ?></td>
                            <td><?php echo $ch_row['STATUS']; ?></td>
                            <td><a class="btn btn-info" href="https://btp.gov.in/BengaluruTraffic.aspx">Pay</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</body>

</html>
