<?php
    session_start();
    if ($_SESSION['erole']=="admin"){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - RichTech </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>

<body>

  <!-- ======= Top and Side Bar ======= -->
  <?php include 'imports/nav-admin.php'; ?>

    <?php
            if (isset($_POST['assign'])){
                $pid=$_POST['pid'];
                //echo $pid."<br>";
                $nos=$_POST['quesno'];
                for($i=0;$i<=$nos-1;$i++){
                    $eid=$_POST['text'.$i];
                    //echo $eid."<br>";

                    include '../imports/config.php';
                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                    $sql_query="INSERT into workt (pid,empid,wstatus) VALUES ('$pid','$eid','Working')";
                    mysqli_query($conn,$sql_query);
                    $sql_query="UPDATE empt SET wstatus='Working' WHERE empid='$eid'";
                    mysqli_query($conn,$sql_query);
                    $sql_query="UPDATE clientt SET pstatus='Working' WHERE Id='$pid'";
                    
                    if (mysqli_query($conn,$sql_query)){
                        echo "<script>alert('Assigned Successfully');</script>";
                        header('Location: assign.php');
                    }
                    else{
                        echo "<script>alert('Assignment Failed');</script>";
                    }
                    //echo "Ok";
                }
                echo '<div class="container jumbotron"><h2>Work Assigned!!</h2></div>';
            }
        }
        else{
            ob_start();
            header('Location: '.'../login.php');
            ob_end_flush();
            die();
        }
    ?>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>