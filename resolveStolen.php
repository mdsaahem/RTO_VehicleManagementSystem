<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);



$servername = "localhost";
$username = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();

$msg = "";

if (isset($_POST['submit'])) {

    $user_id = $_POST['userid'];
    $veh_no = $_POST['vehno'];


    $del_query = "DELETE FROM `stolen_reports` WHERE `stolen_reports`.`USER_ID`=$user_id AND `stolen_reports`.`VEH_NO`= '$veh_no';";


    try {
        $del_res = mysqli_query($connection, $del_query);

        if ($del_res == true) {
            $msg = "<script language='javascript'>
            swal(
                'Success!',
                'Resolved',
                'success'
            );
            </script>";
        } else {
            echo $user_id;
            die('unsuccessful' . mysqli_error($connection));
        }
    } catch (Exception $e) {
        echo "ERROR->" . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Deleting Stolen</title>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link rel="stylesheet" href="sweetalert2/sweetalert2.css">
    <script src="sweetalert2/sweetalert2.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
    <?php echo $msg;
    echo $user_id;
    ?>

    <script>
        var timer = setTimeout(function() {
            window.location = 'stolen.php'
        }, 1000);
    </script>

</body>

</html>