<?php 
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(-1);
    if(!isset($_SESSION)) 
    {   
        
        session_start(); 
    } 
    
    $username= $_GET['id'];
    //echo $username;

    $servername = "localhost";
    $usernam = "root";
    $password = "";
    $database = "reg_veh";
    
    $connection = mysqli_connect($servername, $usernam, $password, $database);

    $uid_query="SELECT user_id FROM user WHERE username = '$username';";
    $uid_res=mysqli_query($connection,$uid_query);
    $userid=mysqli_fetch_assoc($uid_res);
    $user_id=$userid['user_id'];

    $query= "SELECT r.veh_no, r.veh_type, r.maker, r.model, r.engine_cc, r.chassis_no FROM registered_vehicle r, user u where r.user_id= u.user_id AND u.user_id=$user_id;";

    //echo $query;

    $result= mysqli_query($connection,$query);
    // echo print_r(var_mysqli_fetch_assoc($result));
    // echo print_r(mysqli_fetch_assoc($result));
