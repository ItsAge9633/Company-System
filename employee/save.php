<?php

    session_start();
    if ($_SESSION['erole']=="emp"){
        echo $_SESSION['new'];
        if (isset($_POST['srsubmit'])){
            include '../imports/config.php';
            if ($_SESSION['new']){
                if(!empty($_FILES["pp"]["name"])) { 
                    // Get file info 
                    $fileName = basename($_FILES["pp"]["name"]); 
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                     
                    // Allow certain file formats 
                    $allowTypes = array('jpg','png','jpeg','gif'); 
                    if(in_array($fileType, $allowTypes)){ 
                        $image = $_FILES['pp']['tmp_name']; 
                        $imgContent = addslashes(file_get_contents($image)); 
                    }
                    $uname=$_SESSION['uname'];
                    $emp_id=$_SESSION['euid'];
                    $ename=$_POST['ename'];
                    $email=$_POST['email'];
                    $mobile=$_POST['mobile'];
                    $dob=$_POST['dob'];
                    $address=$_POST['address'];
                    $bio=$_POST['bio'];
                    $newDate = date("Y-m-d", strtotime($dob));
                    $dob=$newDate;

                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                    $sql_query = "INSERT into empt (uname,empid,ename,email,mobile,dob,eaddress,pphoto,bio,wstatus) VALUES 
                                    ('$uname','$emp_id','$ename','$email','$mobile','$dob','$address','$imgContent','$bio','free') WHERE NOT EXISTS (
                                    SELECT uname FROM empt WHERE uname='$uname');";
                    mysqli_query($conn,$sql_query);
                    mysqli_close($conn);
                }
            }else{
                if(!empty($_FILES["pp"]["name"])) { 
                    // Get file info 
                    $fileName = basename($_FILES["pp"]["name"]); 
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                     
                    // Allow certain file formats 
                    $allowTypes = array('jpg','png','jpeg','gif'); 
                    if(in_array($fileType, $allowTypes)){ 
                        $image = $_FILES['pp']['tmp_name']; 
                        $imgContent = addslashes(file_get_contents($image)); 
                    }
                }
                $uname=$_SESSION['uname'];
                $emp_id=$_SESSION['euid'];
                $ename=$_POST['ename'];
                $email=$_POST['email'];
                $mobile=$_POST['mobile'];
                $dob=$_POST['dob'];
                $address=$_POST['address'];
                $bio=$_POST['bio'];
                $newDate = date("Y-m-d", strtotime($dob));
                $dob=$newDate;
                $github=$_POST['github'];
                $linkedin=$_POST['linkedin'];
                $insta=$_POST['insta'];
                $twitter=$_POST['twitter'];

                echo "<br>".$uname;
                echo "<br>".$emp_id;
                echo "<br>".$ename;
                echo "<br>".$email;
                echo "<br>".$mobile;
                echo "<br>".$dob;
                echo "<br>".$address;
                echo "<br>".$bio;
                echo "<br>".$github;
                echo "<br>".$linkedin;
                echo "<br>".$insta;
                echo "<br>".$twitter;

                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                $sql_query="SELECT * FROM empt WHERE uname='$uname'";
                $result=mysqli_query($conn,$sql_query);

                while($row=mysqli_fetch_array($result)){
                    $flag=True;
                }

                if (isset($flag)){
                    $sql_query = "UPDATE empt SET ename='$ename',email='$email',mobile='$mobile',dob='$dob',eaddress='$address',bio='$bio',pphoto='$imgContent',github='$github',linkedin='$linkedin',insta='$insta',twitter='$twitter'
                    WHERE uname='$uname'";
                }else{

                    $sqldept = "SELECT deptname from logint where uname='$uname'";
                    $resultdept = mysqli_query($conn,$sqldept);
                    $result = mysqli_fetch_assoc($resultdept);
                    $deptname = $result['deptname'];

                    $sql_query = "INSERT into empt (`uname`,`empid`,`ename`,`deptname`,`email`,`mobile`,`dob`,`eaddress`,`pphoto`,`bio`,`wstatus`,`github`,`twitter`,`linkedin`,`insta`) VALUES 
                    ('$uname','$emp_id','$ename','$deptname','$email','$mobile','$dob','$address','$imgContent','$bio','free','$github','$twitter','$linkedin','$insta');";
                }               
                
                if(mysqli_query($conn,$sql_query)){
                    echo "Records added successfully.";
                    header('Location: '.'users-profile.php');
                } else{
                    echo "ERROR: Could not able to execute $sql_query. " . mysqli_error($conn);
                }

                mysqli_close($conn);
            }
        }
    }

?>