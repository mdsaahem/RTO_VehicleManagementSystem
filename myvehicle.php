    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(-1);
    if (!isset($_SESSION)) {

        session_start();
    }

    $username = $_GET['id'];
    //echo $username;

    $servername = "localhost";
    $usernam = "root";
    $password = "";
    $database = "reg_veh";

    $connection = mysqli_connect($servername, $usernam, $password, $database);

    $uid_query = "SELECT user_id FROM user WHERE username = '$username';";
    $uid_res = mysqli_query($connection, $uid_query);
    $userid = mysqli_fetch_assoc($uid_res);
    $user_id = $userid['user_id'];

    $query = "SELECT r.veh_no, r.veh_type, r.maker, r.model, r.engine_cc, r.chassis_no FROM registered_vehicle r, user u where r.user_id= u.user_id AND u.user_id=$user_id;";

    //echo $query;

    $result = mysqli_query($connection, $query);
    // echo print_r(var_mysqli_fetch_assoc($result));
    // echo print_r(mysqli_fetch_assoc($result));

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
        <?php include 'navbar.php'; ?>

        <div class="container">
            <div class="row">
                <div class="page-header">
                    <h1 style="text-align: center;">My Vehicles</h1>
                </div>
            </div>


            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Vehicle No.</th>
                            <th>Vehicle Type</th>
                            <th>Maker</th>
                            <th>Model</th>
                            <th>Engine CC</th>
                            <th>Chassis No.</th>
                            <th>Documents</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                            <tr>
                                <td><?php echo $row['veh_no']; ?></td>
                                <td><?php echo $row['veh_type']; ?></td>
                                <td><?php echo $row['maker']; ?></td>
                                <td><?php echo $row['model']; ?></td>


                                <td><?php echo $row['engine_cc']; ?></td>
                                <td><?php echo $row['chassis_no']; ?></td>
                                <td><a class="btn btn-primary" href="documents.php?id=<?php echo $row['veh_no']; ?>">View Documents</a></td>
                                <td>
                                    <form action="reportStolen.php" method="post">
                                        <input type="hidden" name="userid" value="<?php echo $user_id; ?>">
                                        <input type="hidden" name="vehno" value="<?php echo $row['veh_no']; ?>">

                                        <input type="submit" name="submit" class="btn btn-danger" value="Report Stolen">

                                    </form>
                                </td>

                            </tr>
                    </tbody>
                <?php } ?>
                </table>
            </div>
        </div>
    </body>

    </html>