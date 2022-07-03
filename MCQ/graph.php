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

  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>


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
        <div class="jumbotron container">
        <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "SELECT quizname from tempresult";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            $qz=$data['quizname'];
        }
        
        echo "<center><h1>Graphical Representation of Results of ".$qz."</h1></center>";
        mysqli_close($conn);
        ?>
    </div>

    <div class="container jumbotron">
    <canvas id="graph" width="400" height="150"></canvas>
    <script>
        <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);
        
        $sql_query = "SELECT * from student where per<=35 and quizname=\"$qz\" and done=\"yes\"";
        $records = mysqli_query($conn,$sql_query);
        $l35 = mysqli_num_rows($records);

        $sql_query = "SELECT * from student where per>35 and per<=50 and quizname=\"$qz\" and done=\"yes\"";
        $records = mysqli_query($conn,$sql_query);
        $l50 = mysqli_num_rows($records);

        $sql_query = "SELECT * from student where per>50 and per<=75 and quizname=\"$qz\" and done=\"yes\"";
        $records = mysqli_query($conn,$sql_query);
        $l75 = mysqli_num_rows($records);

        $sql_query = "SELECT * from student where per>75 and per<=90 and quizname=\"$qz\" and done=\"yes\"";
        $records = mysqli_query($conn,$sql_query);
        $l90 = mysqli_num_rows($records);

        $sql_query = "SELECT * from student where per>90 and per<=100 and quizname=\"$qz\" and done=\"yes\"";
        $records = mysqli_query($conn,$sql_query);
        $l100 = mysqli_num_rows($records);

        echo "const ctx = document.getElementById('graph').getContext('2d');";
        echo "const myChart = new Chart(ctx, {";
            echo "type: 'bar',";
            echo "data: {";
                echo "labels: ['<35%', '36% to 50%', '51% to 75%', '76% to 90%', '91% to 100%'],";
                echo "datasets: [{";
                    echo "label: 'Number of Students',";
                    echo "data: [$l35, $l50, $l75, $l90, $l100],";
                    echo "backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]";
            echo "},";
            echo "options: {";
                echo "scales: {";
                    echo "y: {";
                        echo "beginAtZero: true";
                        echo "}
                }
            }
        });";
        mysqli_close($conn);
        ?>
        </script>
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