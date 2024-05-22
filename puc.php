<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (!isset($_SESSION)) {

    session_start();
}
$username = $_SESSION['username'];
$veh_no = $_GET['id'];
//echo $username;

$servername = "localhost";
$usernam = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $usernam, $password, $database);

$uid_query = "SELECT user_id FROM user WHERE username = '$username';";
$uid_res = mysqli_query($connection, $uid_query);
$userid = mysqli_fetch_assoc($uid_res);
$user_id = $userid['user_id'];

$query = "SELECT * FROM puc where veh_no='$veh_no';";

//echo $query;
// $proc=mysqli_query($connection,"CREATE DEFINER=`root`@`localhost` PROCEDURE `STATUS_PUC`(IN `p_no` VARCHAR(15), IN `vtill` DATE) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER BEGIN UPDATE puc SET puc.status= (CASE WHEN vtill > CURDATE() THEN 'ACTIVE' ELSE 'EXPIRED' END) WHERE puc.puc_no = p_no; END;"
// echo $proc;
// $proc_res = mysqli_query($connection,$proc);
$result = mysqli_query($connection, $query);
// echo print_r(var_mysqli_fetch_assoc($result));
// echo print_r(mysqli_fetch_assoc($result));

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PUC</title>

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
                <h1 style="text-align: center;">PUC Details</h1>
            </div>
        </div>


        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>PUC No.</th>
                        <th>Vehicle No.</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>Status</th>
                        <th>Valid Till</th>

	       <th>View Document</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {

                        //    echo var_dump($proc_call);
                    ?>
                        <tr>
                            <td><?php echo $row['puc_no']; ?></td>
                            <td><?php echo $row['veh_no']; ?></td>
                            <td><?php echo $row['maker']; ?></td>
                            <td><?php echo $row['model']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['valid_till']; ?></td>
	           


                        </tr>
                </tbody>
            <?php } ?>
            </table>
        </div>
    </div>
</body>

</html>