<?php
    if (isset($_POST['logme'])){
        include ('imports/config.php');

        $u=$_POST['uname'];
        $p=$_POST['pwd'];

        $conn=mysqli_connect($server_name,$username,$password,$database_name);
        if(!$conn){
            die("Connection failed: ".mysqli_connect_error());
        }
        
        $sql_query = "SELECT * from logint where uname='$u'";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_assoc($records)){
            $mp=$data['pswd'];
            $role=$data['erole'];
            $uid=$data['euid'];
            $uname=$data['uname'];
        }

        if (isset($mp)){
            session_start();

            if($p==$mp && $role=="admin"){
                $_SESSION['uname']=$uname;
                $_SESSION['euid']=$uid;
                $_SESSION['erole']=$role;
                ob_start();
                header('Location: '.'admin/index.php');
                ob_end_flush();
                die();
            }
            elseif ($p==$mp && $role=="emp"){
                $_SESSION['uname']=$uname;
                $_SESSION['euid']=$uid;
                $_SESSION['erole']=$role;
                ob_start();
                header('Location: '.'employee/users-profile.php');
                ob_end_flush();
                die();
            }
            else{
                session_destroy();
                echo "<script>alert('Invalid Username or Password')</script>";
                ob_start();
                header('Location: '.'index.php');
                ob_end_flush();
                die();
            }
        }
        else{
            session_destroy();
            echo "<script>alert('Invalid Username or Password')</script>";
            ob_start();
            header('Location: '.'index.php');
            ob_end_flush();
            die();
        }
    }

?>
