<?php
$connection = mysqli_connect("localhost", "root", "", "reg_veh");

session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>RMV</title>

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

    background-image: url("bmw.jpg.jpeg");
    height: 100%;

    min-height: 700px;

    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

  }



  .navbar-fixed-top.scrolled {
    background-color: ghostwhite;
    transition: background-color 200ms linear;
  }


  .hero {
    margin-top: 40vh;
    margin-right: 5vw;
    text-align: right;
    /* position:absolute; */
    /* background-color: red; */

  }
</style>

<body data-spy="scroll" data-target=".navbar" data-offset="50" onload="myFunction()">

  </div>
  <div class="parallax foo">
    <?php include 'navbar.php'; ?>

    <!-- <div class="hero-right" style="font-size:50px text-align: center; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);color: black;">rubberBand -->
    <div class="hero">


      <h1 class="animated ">Track Your Vehicles</h1>
      <p>A management system where you seamlessly manage all your <br>Vehicle Documents</p>

      <?php if (isset($_SESSION['username']) == true) { ?>
        <a class="btn btn-success" style="text-align: center" href="booking.php">Register your Vehicle</a>

      <?php } else {  ?>
        <a class="btn btn-success" style="text-align: center" href="login.php">Login To Register your Vehicle</a>
      <?php } ?>


    </div>
  </div>


  <footer style="background-color: #2f2f2f;
          color: #fff; padding: 70px 0; position: relative; margin-bottom: 0;" class="container-fluid text-center">
    <p>A SE mini Project</p>
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