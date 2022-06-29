<?php

session_start();
include '../imports/config.php';
$conn = mysqli_connect($server_name, $username, $password, $database_name);
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
$euid =  $_SESSION['euid'];

/*
$sql = "select * from attendancet where empid = '$euid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

list($atyear, $atmonth, $atday) =explode("-",$row['ddate']);



$curmonth = date('m');

$sql3 = "SELECT COUNT(*) as cnt from attendancet where fullday = 'False' and empid = '$euid'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$total_worked_days = $row3['cnt'];

echo $total_worked_days;
*/

  $curmonth = date('m');
  //total working days
  $sql2 = "SELECT * from dayst where month = '$curmonth'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($result2);
  $total_days = $row2['wd'];

  echo $total_days;
  echo "<br>";

  //salary per day
  $sql3 = "SELECT * from salaryt where euid = '$euid'";
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_assoc($result3);
  $salary = $row3['bsalary'];

  
  $sal_month = intval($salary / 12);
  $sal_day = intval($sal_month / $total_days);

  $this_month_sal = $sal_day * $total_days;

  echo $sal_month;


?>