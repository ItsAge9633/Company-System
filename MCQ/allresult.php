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
          <li class="breadcrumb-item active">Complete Results</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <nav class="navbar navbar-light navbar-expand-md">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <div class="row">
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="allresult.php" style="color:black">Complete Result</a></li></center>
                        </div>
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="studresult.php" style="color:black">Student Result</a></li></center>
                        </div>
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="questionstats.php" style="color:black">Question Stats</a></li></center>
                        </div>
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="graph.php" style="color:black">Graphical View</a></li></center>
                        </div>
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="studnots.php" style="color:black">Not Submitted</a></li></center>
                        </div>
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="malicious.php" style="color:black">Malicious Activity</a></li></center>
                        </div>
                    </div>
                    <!--<li class="nav-item"><a class="nav-link active" href="dashboard.php" style="color:black">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="allresult.php" style="color:black">Complete Result</a></li>
                    <li class="nav-item"><a class="nav-link" href="studresult.php" style="color:black">Student Result</a></li>
                    <li class="nav-item"><a class="nav-link" href="questionstats.php" style="color:black">Question Stats</a></li>
                    <li class="nav-item"><a class="nav-link" href="graph.php" style="color:black">Graphical View</a></li>
                    <li class="nav-item"><a class="nav-link" href="studnots.php" style="color:black">Not Submitted</a></li>
                    <li class="nav-item"><a class="nav-link" href="malicious.php" style="color:black">Malicious Activity</a></li>-->
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="card jumbotron container">
        <br>
        <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "SELECT quizname from tempresult";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            $qz=$data['quizname'];
        }
        
        echo "<center><h1>Results of ".$qz."</h1></center>";
        mysqli_close($conn);
        ?>
        <br>
    </div>

    <div class="card container jumbotron">
        <br>
        <?php
            $n=1;
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
            
            $sql_query = "SELECT * from student where quizname='$qz' and done='yes'";
            $records = mysqli_query($conn, $sql_query);

            echo '<table class="table">';
                echo '<thead class="thead-dark">';
                    echo '<tr>';
                    echo '<th scope="col">#</th>';
                    echo '<th scope="col">Name</th>';
                    echo '<th scope="col">Roll</th>';
                    echo '<th scope="col">Email</th>';
                    echo '<th scope="col">Marks</th>';
                    echo '<th scope="col">Perentage</th>';
                    echo '<th scope="col">Submitted At</th>';
                    echo '</tr>';
                echo '</thead>';

            echo '<tbody>';    
            while($data = mysqli_fetch_array($records)){
                $roll=$data['roll'];
                $email=$data['email'];
                $marks=$data['marks'];
                $name=$data['ename'];
                $per=$data['per'];
                $ttime=$data['ttime'];
                        echo '<tr>
                        <td scope="row">'.$n.'</td>
                        <td>'.$name.'</td>
                        <td>'.$roll.'</td>
                        <td>'.$email.'</td>
                        <td>'.$marks.'</td>
                        <td>'.$per.'%</td>
                        <td>'.$ttime.'</td>
                        </tr>';
                $n+=1;
            }
            echo '</tbody>
            </table>';

            mysqli_close($conn);
        ?>
        <br>
    </div>

    <div class="card container jumbotron">
        <br>
        <form action="exportresult.php" method="post">
            <center>
                <input type="submit" name="exportre" value="Export Reuslt" style="font-size:20px" class="btn btn-outline-success">
            </center>
        </form>
        <br>
    </div>
    <br><br>
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
            header('Location: '.'../index.php');
            ob_end_flush();
            die();
        }
    ?>