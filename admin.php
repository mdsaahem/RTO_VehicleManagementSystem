<?php

if (!isset($_SESSION)) {

    session_start();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar_admin.php' ?>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1 style="text-align: center">Admin Panel</h1>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <p style="text-align: center">YOU CAN NOW MANAGE THE WEBSITE FROM HERE!</p>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <img src="bmwm5new2.jpg" >
    
</body>

</html>