<?php

    include '../imports/config.php';
    $conn = new mysqli($server_name, $username, $password, $database_name);

    session_start();

    if(isset($_POST['checkalldetails'])){


    $month = $_POST['monthall'];
    $bonus = $_POST['bonusall'];
    
    $monthnum = date('m', strtotime($month));
    echo $monthnum; 
    echo $bonus;


    }
?>