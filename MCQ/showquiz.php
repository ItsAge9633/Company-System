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
          <li class="breadcrumb-item active">Show Quiz</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card container jumbotron">
        <br>
        <?php
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
        
            $sql_query = "SELECT quizname from demoshow";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $qz=$data['quizname'];
            }

            echo "<h2>$qz</h2>";
        ?>
        <br>
    </div>

    <script>
        num=0
    </script>

    <div class="card container jumbotron">
        <form action="" method="post">
            <div id="textboxDiv" style="padding-left: 50px; padding-right: 50px; padding-top: 25px">
                <?php
                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                    $num=0;
                    
                    $sql_query = "SELECT * from questions where quizname='$qz'";
                    $records = mysqli_query($conn,$sql_query);
                    while($data = mysqli_fetch_array($records)){
                        $q=$data['question'];
                        $q2=str_replace("\n","<br>",$q);
                        $q1=str_replace("    ","&emsp;",$q2);
                        $opt1=$data['opt1'];
                        $opt2=$data['opt2'];
                        $opt3=$data['opt3'];
                        $opt4=$data['opt4'];
                        //$ans =$data['ans'];
                        
                        $w="text".$num;
                        $w1="radio".$num;
                        $w11="radio".$num."1";
                        $w12="radio".$num."2";
                        $w13="radio".$num."3";
                        $w14="radio".$num."4";
                        $w2="radiotext".$num;

                        $t1="opt".$num."1";
                        $t2="opt".$num."2";
                        $t3="opt".$num."3";
                        $t4="opt".$num."4";

                        echo "<div><br><textarea style='display: none;' id='$w' name='$w' rows='3'>$q</textarea></div>";
                        
                        echo "<div><p>&ensp;$q1 </p></div>";


                        echo '<input type="hidden" id="'.$t1.'" name="'.$t1.'" value="'.$opt1.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w11' name='$w1' value='$opt1'/><label for='$w11'>&ensp;&nbsp;$opt1</label></div></td></tr></table>";
                        
                        echo '<input type="hidden" id="'.$t2.'" name="'.$t2.'" value="'.$opt2.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w12' name='$w1' value='$opt2'/><label for='$w12'>&ensp;&nbsp;$opt2</label></div></td></tr></table>";
                        
                        echo '<input type="hidden" id="'.$t3.'" name="'.$t3.'" value="'.$opt3.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w13' name='$w1' value='$opt3'/><label for='$w13'>&ensp;&nbsp;$opt3</label></div></td></tr></table>";
                        
                        echo '<input type="hidden" id="'.$t4.'" name="'.$t4.'" value="'.$opt4.'">';
                        echo "<table><tr><td><div><input type='radio' id='$w14' name='$w1' value='$opt4'/><label for='$w14'>&ensp;&nbsp;$opt4</label></div></td></tr></table>";
                        
                        echo "<hr>";
                        $num=$num+1;
                    }
                ?>                
            </div>
            <br>
            <center>
                <input type="submit" value="Submit" style="font-size:20px" class="btn btn-outline-success">
            </center>
        </form>
        <br>
    </div>

    <div class="card container jumbotron">
        <br>
        <form action="exportquiz.php" method="post">
            <center>
                <input type="submit" name="exportqz" value="Export Quiz" style="font-size:20px" class="btn btn-outline-success">
            </center>
        </form>
        <br>
    </div>

    <br><br>

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