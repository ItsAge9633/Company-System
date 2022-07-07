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

                $indate = explode('-',$date);
                $month = $indate[1];
                $year = $indate[0];

                $sqlsal = "SELECT * from salpayt where euid='$empid' and month = '$month'";
                $resultsal = mysqli_query($conn, $sqlsal);
                $countsal = mysqli_num_rows($resultsal);
                
                $sqlcount = "SELECT * from salaryt where euid='$empid'";
                $resultcount = mysqli_query($conn, $sqlcount);
                $rowcount = mysqli_fetch_assoc($resultcount);
                $countcount = mysqli_num_rows($resultcount);
                
                $sqldays = "SELECT wd from dayst where month = '$month'";
                $resultdays = mysqli_query($conn, $sqldays);
                $rowdays = mysqli_fetch_assoc($resultdays);
                $wd = $rowdays['wd'];


                $empsal = intval($rowcount['bsalary'] / 12);
                $empthismonthperdaysal = intval($empsal / $wd);

                if($countsal == 0){

                    $daysworked = 1;
                    if ($boolval == 'False'){
                        $dsalary = intval($empthismonthperdaysal / 2);
                    }else{
                        $dsalary = 0;
                    }
                    
                    $sql = "INSERT INTO `salpayt`(`euid`, `month`,`year`, `daysworked`, `bonus`, `tsalary`, `dsalary`) VALUES ('$empid', '$month', '$year', '$daysworked', '$bonus', '$empthismonthperdaysal', '$dsalary')";
                    $result = mysqli_query($conn,$sql);
                    } else{
                        
                        if($boolval == 'True'){
                            $sql = "UPDATE `salpayt` SET `daysworked`=`daysworked`+1, `tsalary`=`tsalary`+$empthismonthperdaysal WHERE euid='$empid' and month='$month'";
                            $result = mysqli_query($conn,$sql);
                        }
                        else{
                            $halfdaysal = intval($empthismonthperdaysal / 2);
                            $sql = "UPDATE `salpayt` SET `daysworked`=`daysworked`+1, `tsalary`=`tsalary`+$halfdaysal, `dsalary`=`dsalary`+$halfdaysal WHERE euid='$empid' and month='$month'";
                            $result = mysqli_query($conn,$sql);
                        }

                    }
                        
            if($result){

                echo "<script>alert('Employee out time set Successfully');</script>";
                echo "<script>window.location.href='attendance.php'</script>";


            }else{
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