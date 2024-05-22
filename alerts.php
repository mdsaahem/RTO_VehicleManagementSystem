<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (!isset($_SESSION)) {

    session_start();
}

// $username= $_GET['id'];
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

$query = "SELECT owner_name, user_id, veh_no from owner where veh_no in( SELECT veh_no from owner GROUP by veh_no HAVING COUNT(user_id)>1);";

//echo $query;

$result = mysqli_query($connection, $query);
// echo print_r(var_mysqli_fetch_assoc($result));
// echo print_r(mysqli_fetch_assoc($result));

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
                <h1 style="text-align: center;">Multiple Claims</h1>
            </div>
        </div>


        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Owner Name</th>
                        <th>User ID </th>
                        <th>Vehicle No.</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                        <tr>
                            <td><?php echo $row['owner_name']; ?></td>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['veh_no']; ?></td>

                        </tr>
                </tbody>
            <?php } ?>
            </table>
        </div>
    </div>
</body>

</html>