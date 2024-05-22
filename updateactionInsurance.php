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
    $rc_no = $_POST['vehno'];
    $chassis_no = $_POST['chassisno'];
    $owner = $_POST['ownname'];
    $maker = $_POST['maker'];
    $model = $_POST['model'];
    $insurance_exp = $_POST['insuranceexp'];

    $insert_query = "UPDATE insurance SET insurance_expiry = '$insurance_exp' WHERE user_id = $user_id AND veh_no = '$veh_no';";
    // $insert_query = "INSERT INTO `insurance` (`user_id`, `veh_no`, `chassis_no`, `owner_name`, `maker`, `model`, `insurance_expiry`) VALUES ($user_id, '$veh_no', '$chassis_no', '$owner', '$maker', '$model', '$insurance_exp');";





    try {

        $res = mysqli_query($connection, $insert_query);

        $proc_call = mysqli_query($connection, "CALL STATUS('$veh_no','$insurance_exp',$user_id);");
        // echo var_dump($proc_call);

        $insert_insno_query = " call update_unique_random_value($user_id,'$veh_no');";
        $insert_insno = mysqli_query($connection, $insert_insno_query);
        // echo var_dump($insert_insno);

        $insno_query = "SELECT insurance_no FROM insurance WHERE user_id = $user_id AND veh_no = '$veh_no';";
        $insno_res = mysqli_query($connection, $insno_query);
        $insno_ar = mysqli_fetch_assoc($insno_res);
        // echo var_dump($insno_ar);
        $insno = $insno_ar['insurance_no'];
        // echo $insno;


        $docINS_insert = "UPDATE `documents` SET `insurance_no` = $insno WHERE `documents`.`veh_no` = '$veh_no';";
        $docINS_res = mysqli_query($connection, $docINS_insert);

        if ($res == true && $docINS_res == true) {
            // if ($res == true) {
            $msg = "<script language='javascript'>
                swal(
                    'Success!',
                    'Insurance Updated in DB!',
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
            window.location = 'documents.php?id=<?php echo $veh_no; ?>'
        }, 2000);
    </script>

</body>

</html>