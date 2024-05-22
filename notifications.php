<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

if (!isset($_SESSION)) {
    session_start();
}

$servername = "localhost";
$usernam = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $usernam, $password, $database);
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
                <h1 style="text-align: center;">Expired Insurances</h1>
            </div>
        </div>


        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Insurance No.</th>
                        <th>Vehicle No.</th>
                        <th>Chassis No.</th>
                        <th>Owner Name</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>Status</th>
                        <th>Expiry</th>
                        <th>Documents</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $ins_query = "SELECT * from insurance WHERE insurance_expiry < curdate();";
                    $ins_result = mysqli_query($connection, $ins_query);
                    while ($ins_row = mysqli_fetch_assoc($ins_result)) {
                        $exp_date = $ins_row['insurance_expiry'];
                        $insurance_no = $ins_row['insurance_no'];

                        $mail_query_string = "SELECT u.email from user u, registered_vehicle r, insurance i WHERE i.veh_no=r.veh_no AND r.user_id=u.user_id and i.insurance_no=$insurance_no;";
                        $mail_res = mysqli_query($connection, $mail_query_string);
                        $ins_mail = mysqli_fetch_assoc($mail_res);

                        if ($ins_mail !== null && isset($ins_mail['email'])) {
                            $usermail = $ins_mail['email'];
                        } else {
                            $usermail = "Unknown";
                        }
                    ?>
                        <tr>
                            <td><?php echo $ins_row['insurance_no']; ?></td>
                            <td><?php echo $ins_row['veh_no']; ?></td>
                            <td><?php echo $ins_row['chassis_no']; ?></td>
                            <td><?php echo $ins_row['owner_name']; ?></td>
                            <td><?php echo $ins_row['maker']; ?></td>
                            <td><?php echo $ins_row['model']; ?></td>
                            <td><?php echo $ins_row['insurance_status']; ?></td>
                            <td><?php echo $ins_row['insurance_expiry']; ?></td>
                            <td><a href="documents.php?id=<?php echo $ins_row['veh_no']; ?>">View Documents</a></td>
                            <td><a class="btn btn-info" href="sendmailIE.php?id=<?php echo $usermail ?>">Notify</a></td>
                        </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1 style="text-align: center;">Expired PUC's</h1>
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
                        <th>Expiry</th>
                        <th>Documents</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $puc_query = "SELECT * from puc WHERE valid_till < curdate();";
                    $puc_result = mysqli_query($connection, $puc_query);
                    while ($puc_row = mysqli_fetch_assoc($puc_result)) {
                        $exp_date = $puc_row['valid_till'];
                        $puc_no = $puc_row['puc_no'];

                        $mail_query_string = "SELECT u.email from user u, registered_vehicle r, puc p WHERE p.veh_no=r.veh_no AND r.user_id=u.user_id and p.puc_no=$puc_no;";
                        $mail_res = mysqli_query($connection, $mail_query_string);
                        $puc_mail = mysqli_fetch_assoc($mail_res);

                        if ($puc_mail !== null && isset($puc_mail['email'])) {
                            $usermail = $puc_mail['email'];
                        } else {
                            $usermail = "Unknown";
                        }
                    ?>
                        <tr>
                            <td><?php echo $puc_row['puc_no']; ?></td>
                            <td><?php echo $puc_row['veh_no']; ?></td>
                            <td><?php echo $puc_row['maker']; ?></td>
                            <td><?php echo $puc_row['model']; ?></td>
                            <td><?php echo $puc_row['status']; ?></td>
                            <td><?php echo $puc_row['valid_till']; ?></td>
                            <td><a href="documents.php?id=<?php echo $puc_row['veh_no']; ?>">View Documents</a></td>
                            <td><a class="btn btn-info" href="sendmailPE.php?id=<?php echo $usermail ?>">Notify</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1 style="text-align: center;">Expired Fitness</h1>
            </div>
        </div>


        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Vehicle No.</th>
                        <th>Status</th>
                        <th>Expiry</th>
                        <th>Documents</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $fit_query = "SELECT * from fitness WHERE NEXT_DUE_DATE < curdate();";
                    $fit_result = mysqli_query($connection, $fit_query);
                    while ($fit_row = mysqli_fetch_assoc($fit_result)) {
                        $veh_no = $fit_row['VEH_NO'];

                        $fmail_query_string = "SELECT u.email FROM fitness f, registered_vehicle r,user u WHERE f.VEH_NO=r.veh_no and r.user_id= u.user_id AND f.NEXT_DUE_DATE < curdate();";
                        $fmail_res = mysqli_query($connection, $fmail_query_string);
                        $fit_mail = mysqli_fetch_assoc($fmail_res);

                        if ($fit_mail !== null && isset($fit_mail['email'])) {
                            $fusermail = $fit_mail['email'];
                        } else {
                            $fusermail = "Unknown";
                        }
                    ?>
                        <tr>
                            <td><?php echo $fit_row['VEH_NO']; ?></td>
                            <td><?php echo $fit_row['VALIDITY']; ?></td>
                            <td><?php echo $fit_row['NEXT_DUE_DATE']; ?></td>
                            <td><a href="documents.php?id=<?php echo $fit_row['VEH_NO']; ?>">View Documents</a></td>
                            <td><a class="btn btn-info" href="sendmailFE.php?id=<?php echo $fusermail ?>">Notify</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
