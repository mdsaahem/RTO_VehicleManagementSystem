<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (!isset($_SESSION)) {

    session_start();
}

// $veh_no= $_GET['id'];
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

$query = "SELECT * FROM stolen_reports;";

//echo $query;

$result = mysqli_query($connection, $query);
// echo print_r(var_mysqli_fetch_assoc($result));
// echo print_r(mysqli_fetch_assoc($result));

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Stolen Report</title>

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
                <h1 style="text-align: center;">Stolen Vehicles</h1>
            </div>
        </div>


        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Report ID</th>
                        <th>Vehicle No.</th>
                        <th>Date of Report</th>
                        <th>Area last Seen</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                        <tr>
                            <td><?php echo $row['USER_ID']; ?></td>
                            <td><?php echo $row['REPORT_ID']; ?></td>
                            <td><?php echo $row['VEH_NO']; ?></td>
                            <td><?php echo $row['DATE_OF_REPORT']; ?></td>
                            <td><?php echo $row['AREA_OF_LAST_SEEN']; ?></td>
                            <td>
                                <form action="resolveStolen.php" method="post">
                                    <input type="hidden" name="userid" value="<?php echo $row['USER_ID']; ?>">
                                    <input type="hidden" name="vehno" value="<?php echo $row['VEH_NO']; ?>">
                                    <input type="submit" name="submit" class="btn btn-warning" value="Resolved">

                                </form>
                            </td>
                        </tr>
                </tbody>
            <?php } ?>
            </table>
        </div>

</body>

</html>