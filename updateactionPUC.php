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
    // $veh_type=$_POST['vehtype'];
    // $rc_no = $_POST['vehno'];
    // $chassis_no = $_POST['chassisno'];
    // $owner = $_POST['ownname'];
    $maker = $_POST['maker'];
    $model = $_POST['model'];
    $puc_exp = $_POST['pucexp'];

    // $insert_query = "INSERT INTO `puc` (`user_id`, `veh_no`, `maker`, `model`, `valid_till`) VALUES ($user_id, '$veh_no', '$maker', '$model', '$puc_exp');";
    $insert_query = "UPDATE puc SET valid_till = '$puc_exp' WHERE user_id = $user_id AND veh_no = '$veh_no';";





    try {

        $res = mysqli_query($connection, $insert_query);

        $proc_call = mysqli_query($connection, "CALL STATUS_PUC($user_id,'$puc_exp','$veh_no');");
        // echo var_dump($proc_call);

        $insert_pucno_query = " call update_unique_random($user_id,'$veh_no');";
        $insert_pucno = mysqli_query($connection, $insert_pucno_query);
        // echo var_dump($insert_insno);

        $pucno_query = "SELECT puc_no FROM puc WHERE user_id = $user_id AND veh_no = '$veh_no';";
        $pucno_res = mysqli_query($connection, $pucno_query);
        $pucno_ar = mysqli_fetch_assoc($pucno_res);
        // echo var_dump($insno_ar);
        $pucno = $pucno_ar['puc_no'];
        // echo $insno;


        $docPUC_insert = "UPDATE `documents` SET `puc_no` = $pucno WHERE `documents`.`veh_no` = '$veh_no';";
        $docPUC_res = mysqli_query($connection, $docPUC_insert);

        if ($res == true && $docPUC_res == true) {
            // if ($res == true) {
            $msg = "<script language='javascript'>
                swal(
                    'Success!',
                    'PUC Updated in DB!',
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





    <script src="https://ajaxecho.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link rel="stylesheet" href="sweetalert2/sweetalert2.css">
    <script src="sweetalert2/sweetalert2.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
    <?php echo $msg;
    ?>

    <script>
        var timer = setTimeout(function() {
            window.location = 'documents.php?id=<?php echo $veh_no; ?>'
        }, 2000);
    </script>

</body>

</html>