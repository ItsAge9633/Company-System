<?php

session_start();
include '../imports/config.php';
$conn=mysqli_connect($server_name,$username,$password,$database_name);

if($_SESSION['erole'] =='admin'){
    if(isset($_POST['addempsubmit'])){
     
        //to check if euid already exist
        $sql_query = "select * from logint where euid='".$_POST['euid']."'";
        if(mysqli_query($conn,$sql_query)){
            echo "<script>alert('Employee ID already exists');</script>";
        }
        else{
            $euid = $_POST['euid'];
        }

        //to check if uname already exist
        $sql_query = "select * from logint where uname='".$_POST['uname']."'";
        if(mysqli_query($conn,$sql_query)){
            echo "<script>alert('Employee Name already exists');</script>";
        }
        else{
            $uname = $_POST['uname'];
        }
        
        $emprole = $_POST['emprole'];
        $pass = $_POST['pwd'];
        $repass =  $_POST['repwd'];
        $jdate = $_POST['jdate'];
        $newDate = date("Y-m-d", strtotime($jdate));
    }
}


if ($pass == $repass){
    $sql_query = "INSERT into logint (uname, pswd, erole, euid, jdate) VALUES 
            ('$uname','$pass','$emprole','$euid','$newDate')";
            
    $conn=mysqli_connect($server_name,$username,$password,$database_name);
    if(mysqli_query($conn,$sql_query)){
        echo "New record created successfully";
        header('Location: '.'all_emp.php');
    }
    else{
        echo "Error: ".$sql_query."<br>".mysqli_error($conn);
    }
    mysqli_close($conn);
}else{
echo "<script>alert('Password and Re-Password are not same');</script>";
}

?>