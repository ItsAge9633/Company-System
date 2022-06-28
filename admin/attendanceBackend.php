<?php
session_start();
include '../imports/config.php';

if ($_SESSION['erole']=="admin"){
    $conn=mysqli_connect($server_name,$username,$password,$database_name);

    if(isset($_POST['intime'])){
        $empid = $_POST['empid'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $boolval = 'False';

        $sql = "Select * from empt where empid='$empid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $uname = $row['uname']; 

        if($uname != ''){
            $sql = "Select * from attendancet where empid='$empid' and ddate='$date'";
            $result = mysqli_query($conn, $sql);
            $rowcount=mysqli_num_rows($result);

            if($rowcount == 0){
                $sql = "INSERT INTO `attendancet`(`uname`, `empid`, `ddate`, `intime`, `fullday`) VALUES ('$uname',  '$empid', '$date','$time','$boolval')";
                $result = mysqli_query($conn,$sql);
                if($result){
                    echo "<script>alert('Attendance Added Successfully');</script>";
                    echo "<script>window.location.href='attendance.php'</script>";
                }
            }
            else{
                echo "<script>alert('Employee already marked on present date');</script>";
                echo "<script>window.location.href='attendance.php'</script>";
            }
        }
        else{
            echo "<script>alert('Employee with given ID does not exist!');</script>";
            echo "<script>window.location.href='attendance.php'</script>"; 
        }

    }
    if (isset($_POST['outtime'])){

        $empid = $_POST['empid'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        $marktime = '10:00:00';
        $marktime2 = '18:00:00';
 
        $sql = "Select * from attendancet where empid='$empid' and ddate='$date'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if($count == 1){
            
            $row = mysqli_fetch_assoc($result);
            $intime = $row['intime'];
            $outtime = $time;
           
            if ($intime <= $marktime && $outtime >= $marktime2){
                $boolval = 'True';
            } else{
                $boolval = 'False';
            }
        
            if(is_null($row['outtime'])){
            $sql = "Update attendancet set outtime='$outtime', fullday='$boolval' where empid='$empid' and ddate='$date'";
            $result = mysqli_query($conn,$sql);
            if($result){
                echo "<script>alert('Employee out time set Successfully');</script>";
                echo "<script>window.location.href='attendance.php'</script>";
            }
            else{
                echo "<script>alert('Error in updating attendance');</script>";
                echo "<script>window.location.href='attendance.php'</script>";
            }
            }   
            else{
                echo "<script>alert('Employee already marked on present date');</script>";
                echo "<script>window.location.href='attendance.php'</script>";
            }
    }else{
            echo "<script>alert('Details of Emoloyee on this date does not exist!');</script>";
            echo "<script>window.location.href='attendance.php'</script>"; 
        }

    }
}

else{
    header("location:../index.php");
}

?>