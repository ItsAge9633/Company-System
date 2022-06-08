<?php

session_start();
include '../imports/config.php';
$conn=mysqli_connect($server_name,$username,$password,$database_name);

if($_SESSION['erole'] =='admin'){
    if(isset($_POST['addempsubmit'])){

        $euid = $_POST['euid'];
        $emprole = $_POST['emprole'];
        $uname = $_POST['uname'];
        $pwd = $_POST['pwd'];
        $repwd = $_POST['repwd'];
        $jdate = $_POST['jdate'];

        if($pwd == $repwd){

            $sql = "SELECT * FROM logint WHERE euid='$euid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            $sql2 = "SELECT * FROM logint WHERE uname='$uname'";
            $result2 = mysqli_query($conn, $sql2);
            $resultCheck2 = mysqli_num_rows($result2);

            if ($resultCheck > 0) {
                echo "<script>alert('Employee ID already exists!')</script>";
                echo "<script>window.location.href='addEmployee.php'</script>";
                }
            elseif ($resultCheck2 > 0) {
                echo "<script>alert('Username already exists!')</script>";
                echo "<script>window.location.href='addEmployee.php'</script>";
                }
            
            else{
            $sql = "INSERT INTO `logint`(`uname`, `pswd`, `erole`, `euid`, `jdate`) VALUES ('$uname','$pwd','$emprole','$euid', '$jdate')";
            $result = mysqli_query($conn,$sql);

            if($result){
                echo "<script>alert('Employee Added Successfully');</script>";
                echo "<script>window.location.href='addEmployee.php'</script>";
            }
            else{
                echo "<script>alert('Employee Not Added');</script>";
                echo "<script>window.location.href='addEmployee.php'</script>";
            }
        }
        }
        else{
            echo "<script>alert('Passwords do not match!');</script>";
            echo "<script>window.location.href='addEmployee.php'</script>";

        }
    }

    }
      
 ?>