<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (!isset($_SESSION)) {

    session_start();
}

// $insurance_no= $_GET['id'];
//echo $username;

$servername = "localhost";
$usernam = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $usernam, $password, $database);

// $uid_query="SELECT user_id FROM user WHERE username = '$username';";
// $uid_res=mysqli_query($connection,$uid_query);
// $userid=mysqli_fetch_assoc($uid_res);
// $user_id=$userid['user_id'];

$query = "SELECT r.user_id, o.owner_name, o.owner_ph,r.veh_no, r.veh_type,r.maker,r.model,r.engine_cc,r.chassis_no from registered_vehicle r left JOIN owner o ON r.user_id=o.user_id ORDER by o.owner_name;";

//echo $query;
// $proc=mysqli_query($connection,"CREATE DEFINER=`root`@`localhost` PROCEDURE `STATUS`(IN `ins_id` BIGINT(20), IN `vdate` DATE) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER BEGIN UPDATE insurance SET insurance.insurance_status= (CASE WHEN vdate > CURDATE() THEN 'ACTIVE' ELSE 'EXPIRED' END) WHERE insurance.insurance_no = ins_id; END");
// "CREATE PROCEDURE STATUS(IN ins_id bigint(20), IN vdate DATE) BEGIN UPDATE insurance SET insurance.insurance_status=(CASE WHEN vdate > CURDATE() THEN 'ACTIVE' ELSE 'EXPIRED' END) WHERE insurance.insurance_no = ins_id; END;"
// echo $proc;
// $proc_res = mysqli_query($connection,$proc);
$result = mysqli_query($connection, $query);
// echo print_r(var_mysqli_fetch_assoc($result));
// echo print_r(mysqli_fetch_assoc($result));

$sum_query = "SELECT COUNT(rc_no) AS No_of_Vehicles, left(r1.rc_no, 2) STATE_CODE, (case when left(r1.rc_no,2) = 'KA' THEN 'KARNATAKA' when left(r1.rc_no,2) = 'HR' THEN 'HARYANA' when left(r1.rc_no,2) = 'KL' THEN 'KERALA' when left(r1.rc_no,2) = 'MH' THEN 'MAHARASHTRA' when left(r1.rc_no,2) = 'TN' THEN 'TAMIL NADU' END ) AS STATE FROM reg_certificate r1 GROUP BY (left(r1.rc_no,2));";
$sum_result = mysqli_query($connection, $sum_query);


$total_veh = "SELECT COUNT(*) as count FROM registered_vehicle;";
$total_veh_res = mysqli_query($connection, $total_veh);
$total_v = mysqli_fetch_row($total_veh_res);
$totv = $total_v[0];
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
    <?php include 'navbar_admin.php'; ?>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1 style="text-align: center;">Total Registered Vehicles: <?php /*echo var_dump($totv);*/ print_r($totv); ?></h1>

            </div>
        </div>


        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <!-- <th>Owner Name</th>
                        <th>Owner Phone</th> -->
                        <th>Vehicle No.</th>
                        <th>Vehicle Type</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>Engine CC</th>
                        <th>Chassis No.</th>
                        <th>Documents</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        //     $exp_date = $row['insurance_expiry'];
                        //     echo $exp_date;
                        //    $proc_call = mysqli_query($connection,"CALL STATUS($insurance_no,'$exp_date');");
                        //    echo var_dump($proc_call);
                    ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['veh_no']; ?></td>
                            <td><?php echo $row['veh_type']; ?></td>
                            <td><?php echo $row['maker']; ?></td>
                            <td><?php echo $row['model']; ?></td>


                            <td><?php echo $row['engine_cc']; ?></td>
                            <td><?php echo $row['chassis_no']; ?></td>
                            <td><a href="documents.php?id=<?php echo $row['veh_no']; ?>">View Documents</a></td>

                        </tr>
                </tbody>
            <?php } ?>
            </table>
        </div>
    </div>



    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1 style="text-align: center;">Vehicles From States</h1>
            </div>
        </div>


        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>No. of Vehicles</th>
                        <th>State Code</th>
                        <th>State</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($s_row = mysqli_fetch_assoc($sum_result)) {
                        //     $exp_date = $row['insurance_expiry'];
                        //     echo $exp_date;
                        //    $proc_call = mysqli_query($connection,"CALL STATUS($insurance_no,'$exp_date');");
                        //    echo var_dump($proc_call);
                    ?>
                        <tr>
                            <td><?php echo $s_row['No_of_Vehicles']; ?></td>
                            <td><?php echo $s_row['STATE_CODE']; ?></td>
                            <td><?php echo $s_row['STATE']; ?></td>


                        </tr>
                </tbody>
            <?php } ?>
            </table>
        </div>
    </div>
</body>

</html>