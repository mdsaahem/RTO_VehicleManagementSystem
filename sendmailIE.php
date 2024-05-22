<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
if (!isset($_SESSION)) {

    session_start();
}

$email = $_GET['id'];
// echo var_dump($_GET);
// $subject= $_GET['subject'];

$servername = "localhost";
$usernam = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $usernam, $password, $database);
$idet_query = "SELECT i.veh_no, i.insurance_no, i.maker, i.model, i.insurance_expiry from insurance i, owner o, user u WHERE i.veh_no=o.veh_no AND o.user_id=u.user_id AND u.email = '$email' and insurance_expiry < curdate();";
$idet_res = mysqli_query($connection, $idet_query);

$veh_no = '';
$ins_no = '';
$ins_exp = '';
$maker = '';
$model = '';
if ($idet = mysqli_fetch_assoc($idet_res)) {
    $veh_no = $idet['veh_no'];
    $ins_no = $idet['insurance_no'];
    $ins_exp = $idet['insurance_expiry'];
    $maker = $idet['maker'];
    $model = $idet['model'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <style>
        .form {
            display: flex;
            flex-direction: column;
            max-width: 50vw;
            /* align-items: center; */
            background-color: aqua;
            margin: 1rem auto;
            padding: 2rem;
            border-radius: 2%;
        }

        .form>* {
            margin: .5rem;
        }

        .button {
            max-width: 20rem;
        }
    </style>
</head>

<body>
    <h1 style="text-align:center;">Send Insurance Expired E-mail</h1>
    <form class="form animated bounce" action="send.php" method="post">
        <div class="input-group">
            <span class="input-group-addon"><b> Email </b></span><input type="email" name="email" value="<?php echo $email; ?>"><br>
        </div>
        <div class="input-group">
            <span class="input-group-addon"><b> Subject </b></span><input type="text" name="subject" value="Insurance Expired"><br>
        </div>
        <div class="input-group">

            <span class="input-group-addon"><b> Message</b></span> <textarea name="message" cols="50" rows="20">Your vehicle bearing vehicle number <?php echo $veh_no; ?> having Insurance ID <?php echo $ins_no; ?> has expired on <?php echo $ins_exp; ?></textarea>
        </div>

        <br>
        <button type="submit" class=" button btn btn-primary" name="send">Send</button>
    </form>
</body>

</html>