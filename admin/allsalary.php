<?php
    session_start();

    if ($_SESSION['erole'] == "admin"){

        include '../imports/config.php';
        $conn = mysqli_connect($server_name, $username, $password, $database_name);
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        include './imports/nav-admin.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Salary - RichTech </title>
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


</head>

<body>

<?php
  $curmonth = date('m');
  $curdate = date('d');

  //this month = total working days * salary per day
  //sal till date = total worked days * salary per day

  $euid = $_SESSION['euid'];
  $sql = "select * from attendancet";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  list($tyear, $tmonth, $tday) =explode("-",$row['ddate']);

  //total working days
  $sql2 = "SELECT * from dayst where month = '$curmonth'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($result2);
  $total_days = $row2['wd'];
  $total_month_days = $row2['td'];

  //salary per day and total salary
  $sql3 = "SELECT * from salaryt where euid = '$euid'";
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_assoc($result3);
  $salary = $row3['bsalary'];
  
  $sal_month = intval($salary / 12);
  $sal_day = intval($sal_month / $total_days);
  $this_month_sal = $sal_day * $total_days;

  //salary till date 
  $sql4T = "SELECT COUNT(*) as cnt from attendancet where fullday = 'True' and empid = '$euid'";
  $result4T = mysqli_query($conn, $sql4T);
  $row4T = mysqli_fetch_assoc($result4T);
  $sal_full_day = $row4T['cnt'];
  
  $sql4F = "SELECT COUNT(*) as cnt from attendancet where fullday = 'False' and empid = '$euid'";
  $result4F = mysqli_query($conn, $sql4F);
  $row4F = mysqli_fetch_assoc($result4F);
  $sal_half_day = $row4F['cnt'];


  $till_date_sal = $row4T['cnt'] * $sal_day;
  $till_date_sal += $row4F['cnt'] * intval($sal_day / 2);

  //salary deducted 
  $emp_worked = $sal_full_day + $sal_half_day;
  $remaining_days = $total_days - $emp_worked;
  $deducted_sal = $row4F['cnt'] * intval($sal_day / 2);

  //Absent days 
  $remaining_working_days = $total_month_days - $curdate;
  $absent_days = $total_days - $emp_worked - $remaining_working_days; 


?>
  <!-- ======= Top and Side Bar ======= -->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Financial Status</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="user-sal.php">Home</a></li>
          <li class="breadcrumb-item active">Financial Status</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Salary <span>| This month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo '₹', $this_month_sal;  ?> </h6>
                      <span class="text-success small pt-1 fw-bold">Total </span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">


                <div class="card-body">
                  <h5 class="card-title">Salary <span>| Working Days</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo '₹', $till_date_sal; ?> </h6>
                      <span class="text-success small pt-1 fw-bold"> Till date </span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-8">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Salary <span>| Deducted</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo '₹', $deducted_sal; ?></h6>
                      <span class="text-danger small pt-1 fw-bold">Half day loss</span> 
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
      </div>
    </section>

    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Finance Structure</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Month</th>
                    <th scope="col">Days Worked</th>
                    <th scope="col">Late/ Half Day</th>
                    <th scope="col">Absent Days</th>
                    <th scope="col">Salary - Credit</th>
                    <th scope="col">Salary - Debit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      echo "<tr>";
                      echo "<th scope='row'>1</th>";
                      echo "<td>$tmonth</td>";
                      echo "<td>$sal_full_day</td>";
                      echo "<td>$sal_half_day</td>";
                      echo "<td>$absent_days</td>";
                      echo "<td>₹$till_date_sal</td>";
                      echo "<td>₹$deducted_sal</td>";
                      echo "</tr>";
                    ?>
                </tbody>
              </table>
              <!-- End Default Table Example -->

            </div>
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


  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>

<?php
    }else{
        header("Location: ../index.php");
    }
?>