<?php

include '../imports/config.php';
$conn = new mysqli($server_name, $username, $password, $database_name);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();
$projid = $_GET['projid'];

$sqlcheck = "SELECT Id from financet WHERE Id = '$projid'";
$resultcheck = $conn->query($sqlcheck);
if(!$rowcheck = $resultcheck->fetch_assoc()){
  echo "<script>alert('Project not found');</script>";
  echo "<script>window.location.href='finance.php';</script>";
}
    
$sql = "SELECT id,tto,ffrom,ddate,amt,narration from financet WHERE Id = '$projid'";
$result = $conn->query($sql);

  $row = $result->fetch_assoc();
  $invoice_number = $row['id'];
  $tto = $row['tto'];
  $ffrom = $row['ffrom'];
  $ddate = $row['ddate'];
  $amt = $row['amt'];
  $narration = $row['narration'];


echo "invoice number : ". $invoice_number . "\n";
echo "tto : ". $tto . "\n";
echo "ffrom : ". $ffrom . "\n";
echo "ddate : ". $ddate . "\n";
echo "amt : ". $amt . "\n";
echo "narration : ". $narration . "\n";

?>