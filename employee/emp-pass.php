<?php

session_start();

include '../imports/config.php';
$conn=mysqli_connect($server_name,$username,$password,$database_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
  if(isset($_POST['changepass'])){

      $currpass = $_POST['password'];
      $newpass = $_POST['newpassword'];
      $renewpass = $_POST['renewpassword'];

      $uname = $_SESSION['uname'];

      $sql = "SELECT * from logint where uname = '$uname' and pswd = '$currpass'";
      $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
            if($newpass == $renewpass){
                $sql = "UPDATE logint SET pswd = '$newpass' WHERE uname = '$uname'";
                $result = mysqli_query($conn, $sql);
                echo "<script>alert('Password Changed Successfully!')</script>";
                echo "<script>window.location.href='users-profile.php'</script>";
            }else{
                echo "<script>alert('New Password and Re-entered Password do not match!')</script>";
                echo "<script>window.location.href='users-profile.php'</script>";
            }
        }else{
            echo "<script>alert('Current Password is incorrect!')</script>";
            echo "<script>window.location.href='users-profile.php'</script>";
        }
}
}

?>