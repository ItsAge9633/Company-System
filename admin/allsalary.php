<?php
    session_start();

    if ($_SESSION['erole'] == "admin"){
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
  <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css?v=<?php echo time(); ?>">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">


</head>

<body>

      <?php
        include './imports/nav-admin.php';
      ?>
  <!-- ======= Top and Side Bar ======= -->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Salary</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Salary</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

          <?php
              include '../imports/config.php';
              $conn = mysqli_connect($server_name, $username, $password, $database_name);
              if(!$conn){
                  die("Connection failed: " . mysqli_connect_error());
              }

              /*
              $sql = "SELECT SUM(bsalary) as salary from salaryt";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              $total_salary = $row['salary'];

              $sql2 = "SELECT * from dayst";
              $result2 = mysqli_query($conn, $sql2);
              $row2 = mysqli_fetch_assoc($result2);
              $td = $row2['td'];
              $work_days = $row2['wd'];

              //salary permonth
              $salary_thismonth = intval($total_salary / 12);
              $salary_perday = intval($salary_thismonth / $work_days);

              //total number of paid employees
              $sql5 = "SELECT COUNT(euid) as euid from salaryt";
              $result5 = mysqli_query($conn, $sql5);
              $row5 = mysqli_fetch_assoc($result5);
              $total_employees = $row5['euid'];

              //amount to be paid
              $sql3 = "SELECT empid from attendancet";
              $result3 = mysqli_query($conn, $sql3);
              $row3 = mysqli_fetch_assoc($result3);

              $to_be_paid = 0;

              while (mysqli_fetch_array($result3)) {

                  $sql4T = "SELECT COUNT(*) as cnt from attendancet where fullday = 'True' and empid = '$row3[empid]'";
                  $result4T = mysqli_query($conn, $sql4T);
                  $row4T = mysqli_fetch_assoc($result4T);
                  $sal_full_day = $row4T['cnt'];

                  $sql4F = "SELECT COUNT(*) as cnt from attendancet where fullday = 'False' and empid = '$row3[empid]'";
                  $result4F = mysqli_query($conn, $sql4F);
                  $row4F = mysqli_fetch_assoc($result4F);
                  $sal_half_day = $row4F['cnt'];

                  $to_be_paid += ($salary_perday * $sal_full_day) + ($salary_perday / 2 * $sal_half_day);

              }

              $total_sal_this_month = intval($total_salary / 12);
              */

              //total salary of this month
              $sqltotalpay = "SELECT SUM(tsalary + dsalary) from salpayt";
              $resulttotalpay = mysqli_query($conn, $sqltotalpay);
              $rowtotalpay = mysqli_fetch_assoc($resulttotalpay);
              $total_pay = $rowtotalpay['SUM(tsalary + dsalary)'];

              //total salary to be paid 
              $sqltopay = "SELECT SUM(tsalary) from salpayt";
              $resulttopay = mysqli_query($conn, $sqltopay);
              $rowtopay = mysqli_fetch_assoc($resulttopay);
              $to_be_paid_salary = $rowtopay['SUM(tsalary)'];

              //total salary deducted 
              //$sqldeduct = "SELECT SUM(dsalary) from salpayt";
              //$resultdeduct = mysqli_query($conn, $sqldeduct);
              //$rowdeduct = mysqli_fetch_assoc($resultdeduct);
              //$to_be_deducted = $rowdeduct['SUM(dsalary)'];

            ?>

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="fcard info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Salary <span>| This month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo '₹', $total_pay;  ?> </h6>
                      <span class="text-success small pt-1 fw-bold">Total </span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="fcard info-card revenue-card">


                <div class="card-body">
                  <h5 class="card-title">Salary <span>| Working Days</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo '₹',  $to_be_paid_salary ; ?> </h6>
                      <span class="text-success small pt-1 fw-bold"> To be paid </span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-8">

              <div class="fcard info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Salary <span>| Deducted</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo '₹', ($total_pay - $to_be_paid_salary); ?></h6>
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
              <?php

                $monthNum = date('m');
                $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
                echo "<table class='table table-bordered table-striped'>";
                echo '<table class="table datatable">';
                echo "<thead>";
                  echo"<tr>";
                    echo"<th>#</th>";
                    echo"<th>Emp ID</th>";
                    echo"<th>Month</th>";
                    echo"<th>Days worked</th>";
                    echo"<th>Salary Credit</th>";
                    echo"<th>Salary Deducted</th>";
                    echo"<th>Payment Status</th>";
                    echo"<th>Receipt</th>";
                  echo"</tr>";
                echo"</thead>";
                echo"<tbody>";

                $curmonth = date('m');
                $sql = "SELECT * from salpayt";
                $result = mysqli_query($conn, $sql);
                $i = 1;
                while($row = mysqli_fetch_assoc($result)){

                  $monthNameW = date('F', mktime(0, 0, 0, $row['month'], 10)); // March

                  $empid = $row['euid'];

                  $sqlinvoice = "SELECT `month`, `year` from salpayt where euid = '$empid'";
                  $resultinvoice = mysqli_query($conn, $sqlinvoice);
                  $rowinvoice = mysqli_fetch_assoc($resultinvoice);
                  $gmonth = $row['month'];
                  $gyear = $rowinvoice['year'];




                  echo"<tr>";
                    echo"<th row>".$i."</th>";
                    echo"<td>".$row['euid']."</td>";
                    echo"<td>".$monthNameW."</td>";
                    echo"<td>".$row['daysworked']."</td>";
                    echo"<td>".$row['tsalary']."</td>";
                    echo"<td>".$row['dsalary']."</td>";

                    if(is_null($row['gdate'])){
                      echo"<td>Pending</td>";
                    }else{
                      echo"<td>Paid on $row[gdate]</td>";
                    }

                    echo'<td><a href="invoice-salary.php?empid='.$empid.'&month='.$gmonth.'&year='.$gyear.'" target="_blank"> Receipt </a></td>';

                  
                  echo"</tr>";
                  $i++;
                }
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

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
</body>

</html>

<?php
    }else{
        header("Location: ../index.php");
    }
?>