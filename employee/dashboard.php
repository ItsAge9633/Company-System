<?php
        session_start();
        if ($_SESSION['erole']=="emp"){
            //print($_SESSION['uname']);
            $u=$_SESSION['uname'];
            include '../imports/config.php';
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
            $sql_query = "SELECT * from empt where uname='$u'";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_assoc($records)){
                $empid=$data['empid'];
                $ename=$data['ename'];
                $email=$data['email'];
                $mobile=$data['mobile'];
                $dob=$data['dob'];
                $address=$data['eaddress'];
                $photo=$data['pphoto'];
                $cv=$data['cv'];
                $bio=$data['bio'];
            }
            if(!isset($empid)){
                echo '<div class="container jumbotron"><a href="update.php">Set Profile</a></div>';
            }else{
                echo '<div class="container jumbotron">
                <div class="row">
                    <div class="col-md-3">
                        <img src="data:image/jpg;charset=utf8;base64, '.base64_encode($photo).'" height="200px" width="200px"/>
                    </div>
                    <div class="col-md-9">
                        <h2>'.$ename.'</h2>
                        <p>Employee Id: '.$empid.'</p>
                        <p>Email Id: '.$email.'</p>
                        <p>Mobile No: '.$mobile.'</p>
                        <p>DOB: '.$dob.'</p>
                        <p>Address: '.$address.'</p>
                        <p>Bio: '.$bio.'</p>
                    </div>
                </div>
                </div>';
            }
        }
        else{
            ob_start();
            header('Location: '.'../login.php');
            ob_end_flush();
            die();
        }
    ?>