<?php

    session_start();
    if ($_SESSION['erole']=="admin"){
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

            $nmsg = "New Client $cname Added! Project: $pname";
            $sql_query = "INSERT into notift (euid,ttype,nmsg,ddate) VALUES ('admin','Client','$nmsg','$pdate')";
            
            if(mysqli_query($conn,$sql_query)){
                echo "New record created successfully";
                header('Location: '.'view_cli.php');
            }
            else{
                echo "Error: ".$sql_query."<br>".mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    }

?>