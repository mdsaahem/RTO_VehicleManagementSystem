<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);



$servername = "localhost";
$username = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $username, $password, $database);
session_start();

$msg = "";

if (isset($_POST['submit'])) {
    // $name=$_POST['name'];
    // echo $name;
    $user_id = $_POST['userid'];
    echo $user_id;
    $veh_no = $_POST['vehno'];
    $veh_type = $_POST['type'];
    $maker = $_POST['maker'];
    $model = $_POST['model'];
    $engine_cc = $_POST['enginecc'];
    $chassis_no = $_POST['chassisno'];
    $username = $_POST['username'];

    $insert_query = "INSERT INTO `registered_vehicle` (`veh_no`, `maker`, `model`, `veh_type`, `engine_cc`, `chassis_no`, `user_id`) VALUES ('$veh_no', '$maker', '$model', '$veh_type', '$engine_cc', '$chassis_no', '$user_id');";



    try {
        $doc_query = "INSERT INTO `documents` (`veh_no`) VALUES ('$veh_no');";
        $doc_res = mysqli_query($connection, $doc_query);

        $res = mysqli_query($connection, $insert_query);

        if ($res == true) {
            $msg = "<script language='javascript'>
                swal(
                    'Success!',
                    'Registration Completed!',
                    'success'
                );
                </script>";
        } else {
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
    <title>Document</title>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link rel="stylesheet" href="sweetalert2/sweetalert2.css">
    <script src="sweetalert2/sweetalert2.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
    <?php echo $msg;
    ?>

    <script>
        var timer = setTimeout(function() {
            window.location = 'index.php'
        }, 1000);
    </script>

</body>

</html>