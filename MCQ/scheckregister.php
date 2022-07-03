<!--#dde2ec-->
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
  <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">


</head>

<body>

  <!-- ======= Top and Side Bar ======= -->
      <?php 
            include 'imports/nav-stud.php';
            require ('config.php');
      ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>MCQ Examination</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Home Page</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card container jumbotron">
        <br>
        <h3>Instructions:-</h3><br>
        <ol>
            <li>Keep a Stable Internet Connection.</li>
            <li>Submit the Test in given Time.</li>
            <li>If any issues, please contact to Admin.</li>
        </ol>
        
        <?php
            error_reporting(0);
            if (isset($_POST['srsubmit'])){

                $email=$_POST['email'];
                $name=$_POST['name'];
                $roll=$_POST['roll'];
                $mobile=$_POST['mobile'];
                $done="no";

                if (($email=='') || ($name=='') || ($roll=='') || ($mobile=='')){
                    ob_start();
                    header('Location: '.'srinvalid.php');
                    ob_end_flush();
                    die();
                }
                else{
                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                    
                    if(!$conn){
                        die("Connection Failed:" . mysqli_connect_error());
                    }


                    $sql_query = "SELECT * from activated";
                    $records = mysqli_query($conn,$sql_query);

                    $qz="No Quizzes Available for now!";

                    while($data = mysqli_fetch_array($records)){
                        $qz=$data['quizname'];
                    }


                    $flag=0;
                    $flag1=0;
                    $submittedflag=0;

                    $sql_query = "SELECT roll,email from student";
                    $records = mysqli_query($conn,$sql_query);

                    while($data = mysqli_fetch_array($records)){
                        if (($data['roll']==$roll) || ($data['email']==$email)){

                            //echo "c1";
                            $sql_query = "SELECT email from student where roll='$roll' and quizname='$qz'";
                            $r = mysqli_query($conn,$sql_query);
                            while($d = mysqli_fetch_array($r)){
                                $e1=$d['email'];
                                if (!($d['email']==$email)){
                                    //echo "c12";
                                    $flag=1;
                                    break;
                                    break;
                                }
                            }

                            $sql_query = "SELECT roll from student where email='$email' and quizname='$qz'";
                            $r = mysqli_query($conn,$sql_query); 
                            while($d = mysqli_fetch_array($r)){
                                $r1=$d['roll'];
                                if (!($d['roll']==$roll)){
                                    //echo "c13";
                                    $flag=1;
                                    break;
                                    break;
                                }
                            }

                            if ($e1==$email && $r1==$roll){
                                $sql_query = "SELECT done from student where email='$email' and quizname='$qz' and roll='$roll'";
                                $r = mysqli_query($conn,$sql_query);

                                while($d = mysqli_fetch_array($r)){
                                    $s1=$d['done'];
                                    if ($d['done']=='no'){
                                        $flag1=1;       
                                        break;
                                    }
                                    else{
                                        $submittedflag=1;
                                    }
                                }
                            }

                        }
                    }

                    if($flag1==1){
                        //Registered but didn't submitted
                        echo "<form action='quiz.php' method='post'>";
                            echo '<input type="hidden" id="squizname" name="squizname" value="'.$qz.'">';
                            echo '<input type="hidden" id="sname" name="sname" value="'.$name.'">';
                            echo '<input type="hidden" id="semail" name="semail" value="'.$email.'">';
                            echo '<input type="hidden" id="sroll" name="sroll" value="'.$roll.'">';
                            echo '<input type="hidden" id="smobile" name="smobile" value="'.$mobile.'">';
                            echo "<br><center><input type='submit' class='btn btn-outline-success' value='Proceed'></center>";
                        echo "</form>";

                        session_start();
                        $_SESSION['sname']=$email;
                    }
                    elseif($submittedflag==1){
                        //Already Submitted
                        ob_start();
                        header('Location: '.'submittedalready.php');
                        ob_end_flush();
                        die();
                    }
                    elseif ($flag==1){
                        //Trying to register with email or roll already used
                        ob_start();
                        header('Location: '.'srinvalid.php');
                        ob_end_flush();
                        die();
                    }
                    else{
                        //New registration
                        $sql_query = "INSERT INTO student (email,ename,roll,mobile,done,quizname)
                                VALUES ('$email','$name','$roll','$mobile','$done','$qz')";
                        mysqli_query($conn, $sql_query);

                        echo "<form action='quiz.php' method='post'>";
                            echo '<input type="hidden" id="squizname" name="squizname" value='.$qz.'>';
                            echo '<input type="hidden" id="sname" name="sname" value='.$name.'>';
                            echo '<input type="hidden" id="semail" name="semail" value='.$email.'>';
                            echo '<input type="hidden" id="sroll" name="sroll" value='.$roll.'>';
                            echo '<input type="hidden" id="smobile" name="smobile" value='.$mobile.'>';
                            echo "<br><center><input type='submit' class='btn btn-outline-success' value='Proceed'></center>";
                        echo "</form>";
                        session_start();
                        $_SESSION['sname']=$email;
                    }

                    mysqli_close($conn);
                }

            }
        ?>
        <br>
    </div>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>