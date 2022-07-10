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
        $bankname = $_POST['bankname'];
        $bankacc = $_POST['bankacc'];
        $bsalary = $_POST['bsalary'];
        $deptname = $_POST['deptname'];


        if($pwd == $repwd){

            $sql = "SELECT * FROM logint WHERE euid='$euid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            $sql2 = "SELECT * FROM logint WHERE uname='$uname'";
            $result2 = mysqli_query($conn, $sql2);
            $resultCheck2 = mysqli_num_rows($result2);

            $sql3 = "SELECT * FROM salaryt where bankacc='$bankacc'";
            $result3 = mysqli_query($conn, $sql3);
            $resultCheck3 = mysqli_num_rows($result3);


            if ($resultCheck > 0) {
                echo "<script>alert('Employee ID already exists!')</script>";
                echo "<script>window.location.href='addEmployee.php'</script>";
                }
            elseif ($resultCheck2 > 0) {
                echo "<script>alert('Username already exists!')</script>";
                echo "<script>window.location.href='addEmployee.php'</script>";
                }
            elseif ($resultCheck3 > 0) {
                echo "<script>alert('Bank Account already exists!')</script>";
                echo "<script>window.location.href='addEmployee.php'</script>";
                }
            
            else{
            $sql = "INSERT INTO `logint`(`uname`, `pswd`, `erole`, `euid`, `jdate`, `deptname`) VALUES ('$uname','$pwd','$emprole','$euid', '$jdate', '$deptname')";
            $result = mysqli_query($conn,$sql);
            

            $sql2 = "INSERT INTO `salaryt`(`bankname`, `bankacc`, `bsalary`, `euid`) VALUES ('$bankname','$bankacc','$bsalary','$euid')";
            $result2 = mysqli_query($conn,$sql2);

            $nmsg="New Employee of Username ".$uname." with ".$emprole." Role has been Added!";
            $sql_query="INSERT into notift (euid,ttype,nmsg,ddate) VALUES ('admin','Employee','$nmsg','$jdate')";
            mysqli_query($conn,$sql_query);

            if($result && $result2){
                
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