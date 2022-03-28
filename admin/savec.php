<?php

    session_start();
    if ($_SESSION['role']=="admin"){
        if (isset($_POST['crsubmit'])){
            include '../imports/config.php';
            $cname=$_POST['cname'];
            $pname=$_POST['pname'];
            $mobile=$_POST['mobile'];
            $email=$_POST['email'];
            $descrip=$_POST['descrip'];
            $status="Pending";
            $pdate=$_POST['pdate'];
            $newDate = date("Y-m-d", strtotime($pdate));
            $pdate=$newDate;
            $ddate=$_POST['ddate'];
            if ($ddate!=""){
                $newDate = date("Y-m-d", strtotime($ddate));
                $ddate=$newDate;
                $sql_query = "INSERT into clientt (cname,pname,mobile,email,pdate,ddate,descrip,pstatus) VALUES 
                            ('$cname','$pname','$mobile','$email','$pdate','$ddate','$descrip','$status')";
            }else{
                $ddate="";
                $sql_query = "INSERT into clientt (cname,pname,mobile,email,pdate,descrip,pstatus) VALUES 
                            ('$cname','$pname','$mobile','$email','$pdate','$descrip','$status')";
            }
            

            $conn=mysqli_connect($server_name,$username,$password,$database_name);
            mysqli_query($conn,$sql_query);
            mysqli_close($conn);
        }
    }

?>