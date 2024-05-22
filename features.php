<?php
// $connection = mysqli_connect("localhost", "root", "", "vehicle management");

session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Features</title>

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
<style>
    .parallax {
        background-image: url("brennen-clifford-DlUVdeI4ec4-unsplash.jpg");
        height: 100%;
        min-height: 700px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;

    }

    .parallax1 {
        background-image: url("pexels-photo-280310 .jpeg");
        height: 100%;
        min-height: 600px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;

    }

    .navbar-fixed-top.scrolled {
        background-color: ghostwhite;
        transition: background-color 200ms linear;
    }
</style>

<body data-spy="scroll" data-target=".navbar" data-offset="50" onload="myFunction()">
    </div>
    <div class="parallax foo">
        <?php include 'navbar.php'; ?>
    </div>

    <div>
        <br><br>
        <div id="bus_route" class="container">
            <div class="page-header">
                <h1 style="text-align: center">Automatic Document Reminders</h1>
            </div>
            <div class="row">
                <div class="col-md-6 foo">
                    <p><b>Our system automatically sends reminders for important vehicle-related documents such as registration renewals and insurance expiration. This ensures that you never miss a deadline and that your vehicles stay legal and properly insured.</b>
                    </p>
                </div>
                <div class="col-md-6 foo1">

                    <img src="pexels-pixabay-357514.jpg" class="img-responsive">
                </div>

            </div>
        </div>

        <br>

        <div class="parallax1"></div>

        <div id="bus" class="container">
            <div class="page-header">
                <h1 style="text-align: center"> Multi-User Access </h1>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="pexels-christina-morillo-1181346.jpg" class="img-responsive">
                </div>
                <div class="col-md-6 foo1">
                    <p style="font-size:20px;"><b>Our system allows multiple users to access and manage vehicle documents, making it perfect for fleet managers and car rental companies. Each user can have their own level of access and permissions, ensuring that only authorized personnel have access to sensitive information.</b></p>
                </div>

            </div>
        </div>

    </div>

    <footer style="background-color: #2f2f2f;
          color: #fff; padding-top: 70px;
          padding-bottom: 70px;" class="container-fluid text-center">
        <p>A DBMS MiniProject</p>
    </footer>


    <script>
        $(function() {
            $(document).scroll(function() {
                var $nav = $(".navbar-fixed-top");
                $a = $(".parallax");
                $nav.toggleClass('scrolled', $(this).scrollTop() > $a.height());
            });
        });
    </script>


    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>


    <script>
        window.sr = ScrollReveal();
        sr.reveal('.foo', {
            duration: 800
        });
        sr.reveal('.foo1', {
            duration: 800,
            origin: 'top'
        });
    </script>

</body>

</html>