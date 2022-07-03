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

    <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);
        $num=0;

        $sql_query = "SELECT * from activated";
        $records = mysqli_query($conn,$sql_query);
        $flag=0;
        while($data = mysqli_fetch_array($records)){
            $flag=1;
        }
        if ($flag==1){
            echo '<div class="card container jumbotron">';
                echo '<br><h3>Enter Your Details!</h3><br>';
            echo '</div>';
        }
    ?>
    
    <br>
    <div class="card jumbotron container">
        <?php
        if ($flag==1){
            echo '<br><div class="form-group">';
                echo '<form action="scheckregister.php" method="post">';
                    echo '<center>';
                        echo '<input type="email" class="form-control" name="email" id="" placeholder="Email Id">';
                        echo '<br>';
                        echo '<input type="text" class="form-control" name="name" id="" placeholder="Full Name">';
                        echo '<br>';
                        echo '<input type="text" class="form-control" name="roll" id="" placeholder="Enrollment Number">';
                        echo '<br>';
                        echo '<input type="text" class="form-control" name="mobile" id="" placeholder="Mobile Number" pattern="[1-9]{1}[0-9]{9}" minlength="10" maxlength="10" required>';
                        echo '<br>';
                        echo '<input type="submit" name="srsubmit" style="font-size:20px" class="btn btn-outline-success" value="Next">';
                    echo '</center>';
                echo '</form>';
            echo '<br></div>';
        }
        else{
            echo "<br><h3>No Quizzes Available!<h3><br>";
        }
        ?>
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
