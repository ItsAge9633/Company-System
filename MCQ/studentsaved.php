<!--#dde2ec-->
<?php
    session_start();
    if(isset($_SESSION['sname'])  or isset($_POST['semail'])){
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
  <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">

    <style>
        .bodycolor{
            background: #9053c7;
            background: -webkit-linear-gradient(-135deg, #c850c0, #4158d0);
            background: -o-linear-gradient(-135deg, #c850c0, #4158d0);
            background: -moz-linear-gradient(-135deg, #c850c0, #4158d0);
            background: linear-gradient(-135deg, #c850c0, #4158d0);
            height: 100%;
            margin: 0;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .disable-selecting {
            user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
        }
    </style>
    <noscript>
        This page needs JavaScript activated to work. 
        <style>div { display:none; }</style>
    </noscript>
    <script>
        nct=0;
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
        document.addEventListener("visibilitychange", event => {
        if (document.visibilityState == "visible") {
            console.log("tab is active")
        } else {
            nct=nct+1;
            console.log("tab is inactive")
            document.querySelector('.changetabs').value = nct;
        }
        })
    </script>

</head>

<body>

  <!-- ======= Top and Side Bar ======= -->
      <?php 
            include 'imports/nav-stud.php';
            require ('config.php');
      ?>

  <main id="main" class="main">
  <canvas width="128" height="128" hidden></canvas>
    <div class="pagetitle">
      <h1>MCQ Examination</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Home Page</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <div class="card jumbotron container">
        <br>
    <?php
        error_reporting(0);
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "SELECT * from activated";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            $aqz=$data['quizname'];
        }

        if (isset($_POST['final']) && $aqz==$_POST['squiznameforsave']){

            $qz=$_POST['squiznameforsave'];
            $quesno=$_POST['squesno'];
            $sname=$_POST['sname'];
            $semail=$_POST['semail'];
            $sroll=$_POST['sroll'];

            $tmarks=0;
            $marks=0;

            $sql_query = "SELECT done from student where quizname='$qz' and email=\"$semail\"";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $status=$data['done'];
            }

            if ($status=="no"){
                for ($i=0;$i<$quesno;$i++){
                    $w="text".$i;
                    $w1="radio".$i;
                    $ques=$_POST[$w];
                    $ques=str_replace("'","\'",$ques);
            
                    $w11="opt".$i."1";
                    $w12="opt".$i."2";
                    $w13="opt".$i."3";
                    $w14="opt".$i."4";
                    
                    $opt1=$_POST[$w11];
                    $opt2=$_POST[$w12];
                    $opt3=$_POST[$w13];
                    $opt4=$_POST[$w14];
            
                    if (isset($_POST[$w1])){
                        $ans=$_POST[$w1];
                    }
                    else{
                        $ans=' ';
                    }
                    
                    $sql_query = "SELECT ans from questions where quizname='$qz' and question='$ques' and opt1='$opt1' and opt2='$opt2' and opt3='$opt3' and opt4='$opt4'";
                    $records = mysqli_query($conn,$sql_query);
                    while($data = mysqli_fetch_array($records)){
                        $ca=$data['ans'];
                    }
            
                    $tmarks+=1;
                    if ($ca==$ans){
                        $marks+=1;
                        $cw="correct";
                    }
                    else{
                        $cw="wrong";
                    }

                    $sql_query = "INSERT INTO submission (rollno,email,quizname,ques,opt1,opt2,opt3,opt4,cans,gans,cw)
                    VALUES ('$sroll','$semail','$qz','$ques','$opt1','$opt2','$opt3','$opt4','$ca','$ans','$cw')";
                    mysqli_query($conn, $sql_query);
                }
            }

            $per=($marks/($quesno))*100;
            $per=number_format($per, 2, '.', '');
            $t=date("d/m/y h:i:sa");

            $sql_query = "UPDATE student SET done='yes',marks=$marks,per=$per,ttime='$t' WHERE email='$semail' and roll='$sroll' and quizname='$qz'";
            mysqli_query($conn, $sql_query);

            $cdata=$_POST['cheated'];
            $ctdata=$_POST['changetabs'];
            //echo $ctdata;
            $myarray=explode(" ",$cdata);
            if ($cdata=="" and $ctdata=="no"){
                //echo "Not Cheated!";
                $mali="Not Cheated!";
            }elseif($ctdata!="no"){
                $mali = "Changed Tab $ctdata times!";
                $sql_query = "INSERT INTO malicious (ename,email,roll,quizname,emessage)
                    VALUES ('$sname','$semail','$sroll','$qz','$mali')";
                mysqli_query($conn, $sql_query);
            }elseif(count($myarray)==2){
                //echo "Tried to Cheat, Pressed some of Shortcut Keys!";
                $mali="Tried to Cheat, Pressed one of Shortcut Key once!";
                $sql_query = "INSERT INTO malicious (ename,email,roll,quizname,emessage)
                    VALUES ('$sname','$semail','$sroll','$qz','$mali')";
                mysqli_query($conn, $sql_query);
            }else{
                //echo "Cheated, Pressed some of Shortcut Keys many times!";
                $mali="Cheated, Pressed some of Shortcut Keys many times!";
                $sql_query = "INSERT INTO malicious (ename,email,roll,quizname,emessage)
                    VALUES ('$sname','$semail','$sroll','$qz','$mali')";
                mysqli_query($conn, $sql_query);
            }

            session_start();
            session_destroy();
            echo "<center><h1>Your Response has been recored!</h1></center><br>";
            echo "<br><center><h3>Thank You $sname!</h3></center>";
        }
        else{
            echo "<center><h1>Sorry You where late!</h1></center><br>";
            echo "<center><h3>If any issues please contact Admin!</h3></center>";
        }

        mysqli_close($conn);
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

<?php
            #print("Op");
        }
        else{
            ob_start();
            header('Location: '.'index.php');
            ob_end_flush();
            die();
        }
    ?>