<!--#dde2ec-->
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
  <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">


</head>

<body>

  <!-- ======= Top and Side Bar ======= -->
      <?php 
            include 'imports/nav-admin.php';
            require ('config.php');
      ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card container jumbotron">
        <br>
        <?php
            function update($server_name,$username,$password,$database_name){
                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                //now check the connection
                if(!$conn)
                {
                    die("Connection Failed:" . mysqli_connect_error());

                }

                if(isset($_POST['save'])){
                    $quesno= $_POST['quesno'];
                    $qn=$_POST['quiznameforupdate'];

                    $sql_query = "DELETE from questions where quizname='$qn'";
                    mysqli_query($conn, $sql_query);

                    for($i=0;$i<=$quesno-1;$i++){
                        $g='text'.$i;
                        $ques = $_POST[$g];
                        $g1='radiotext'.$i.'1';
                        $opt1= $_POST[$g1];
                        $g2='radiotext'.$i.'2';
                        $opt2= $_POST[$g2];
                        $g3='radiotext'.$i.'3';
                        $opt3= $_POST[$g3];
                        $g4='radiotext'.$i.'4';
                        $opt4= $_POST[$g4];
                        $g5='radio'.$i;
                        $oo= $_POST[$g5];

                        if ($oo==1){
                            $ans=$opt1;
                        }
                        if($oo==2){
                            $ans=$opt2;
                        }
                        if($oo==3){
                            $ans=$opt3;
                        }
                        if($oo==4){
                            $ans=$opt4;
                        }

                        $sql_query = "INSERT INTO questions (quizname,question,opt1,opt2,opt3,opt4,ans)
                        VALUES ('$qn','$ques','$opt1','$opt2','$opt3','$opt4','$ans')";
                        mysqli_query($conn, $sql_query);
                        
                        $oo=0;
                    }
                mysqli_close($conn);
                echo "<h4>$qn Quiz Updated!<h4>";
                }
            }

            update($server_name,$username,$password,$database_name);
        ?>
        <br>
    </div>

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
            header('Location: '.'../index.php');
            ob_end_flush();
            die();
        }
    ?>