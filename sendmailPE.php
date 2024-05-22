<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

if (!isset($_SESSION)) {

    session_start();
}

$email = $_GET['id'];
// echo $email;
// echo var_dump($_GET);
// $subject= $_GET['subject'];

$servername = "localhost";
$usernam = "root";
$password = "";
$database = "reg_veh";

$connection = mysqli_connect($servername, $usernam, $password, $database);


$pdet_query = "SELECT p.puc_no , p.veh_no, p.maker, p.model, p.valid_till from puc p, owner o, user u WHERE p.veh_no=o.veh_no AND o.user_id=u.user_id AND u.email='$email' and valid_till < curdate();";
$pdet_res = mysqli_query($connection, $pdet_query);

$puc_no = '';
$veh_no = '';
$maker = '';
$model = '';
$puc_exp = '';
if ($pdet = mysqli_fetch_assoc($pdet_res)) {
    $puc_no = $pdet['puc_no'];
    $veh_no = $pdet['veh_no'];
    $maker = $pdet['maker'];
    $model = $pdet['model'];
    $puc_exp = $pdet['valid_till'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    <h1 style="text-align:center;">Send PUC Expired E-mail</h1>
    <form class="form animated bounce" action="send.php" method="post">
        <div class="input-group">

            <span class="input-group-addon"><b> Email </b></span><input type="email" name="email" value="<?php echo $email; ?>"><br>
        </div>

        <div class="input-group">

            <span class="input-group-addon"><b> Subject</b></span> <input type="text" name="subject" value="PUC Expired"><br>
        </div>

        <div class="input-group">

            <span class="input-group-addon"><b> Message </b></span>
            <textarea name="message" cols="50" rows="20">Your vehicle <?php echo $maker; ?> <?php echo $model; ?> bearing vehicle number <?php echo $veh_no; ?> has fitness expired on <?php echo $puc_exp; ?></textarea><br>

        </div>
        <button type="submit" class=" button btn btn-primary" name="send">Send</button>

    </form>
</body>

</html>