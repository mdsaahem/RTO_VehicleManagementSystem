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
    // echo $user_id;
    $veh_no = $_POST['vehno'];
    $lastseen = $_POST['lastseen'];

    $insert_query = "INSERT INTO `stolen_reports` (`USER_ID`, `REPORT_ID`, `VEH_NO`, `DATE_OF_REPORT`, `AREA_OF_LAST_SEEN`) VALUES ($user_id, NULL, '$veh_no', curdate(), '$lastseen');";



    try {
        $res = mysqli_query($connection, $insert_query);

        $reportid_query = "call update_unique ($user_id,'$veh_no');";
        $reportid_res = mysqli_query($connection, $reportid_query);


        if ($res == true && $reportid_res == true) {
            $msg = "<script language='javascript'>
                swal(
                    'Success!',
                    'Reported',
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
            window.location = 'myvehicle.php?id=<?php echo $_SESSION['username']; ?>'
        }, 1000);
    </script>

</body>

</html>