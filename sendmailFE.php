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


$fdet_query = "SELECT f.VEH_NO, f.NEXT_DUE_DATE, r.maker ,r.model from fitness f, registered_vehicle r, user u WHERE f.veh_no=r.veh_no AND r.user_id=u.user_id AND u.email='$email' and NEXT_DUE_DATE < curdate();";

$fdet_res = mysqli_query($connection, $fdet_query);

$maker = '';
$model = '';
// $puc_no = '';
$veh_no = '';
$f_exp = '';
if ($fdet = mysqli_fetch_assoc($fdet_res)) {
    $maker = $fdet['maker'];
    $model = $fdet['model'];
    // $puc_no=$fdet['puc_no'];
    $veh_no = $fdet['VEH_NO'];
    $f_exp = $fdet['NEXT_DUE_DATE'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <h1 style="text-align:center;">Send Vehicle Fitness Expired E-mail</h1>
    <form class="form animated bounce" action="send.php" method="post">
        <div class="input-group">
            <span class="input-group-addon"><b> Email </b></span><input type="email" name="email" value="<?php echo $email; ?>"><br>
        </div>
        <div class="input-group">
            <span class="input-group-addon"><b> Subject </b></span><input type="text" name="subject" value="Insurance Expired"><br>
        </div>
        <div class="input-group">

            <span class="input-group-addon"><b> Message</b></span> <textarea name="message" cols="50" rows="20">Your vehicle <?php echo $maker; ?> <?php echo $model; ?> bearing vehicle number <?php echo $veh_no; ?> has fitness expired on <?php echo $f_exp; ?></textarea>
        </div>

        <br>
        <button type="submit" class=" button btn btn-primary" name="send">Send</button>
    </form>
</body>

</html>