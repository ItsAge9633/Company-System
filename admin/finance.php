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

  <!-- ======= Top and Side Bar ======= -->
  <?php include 'imports/nav-admin.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><a href="payment.php">Finance</a></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="finance.php">Finance Dashboard</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

            <?php
                include '../imports/config.php';
                $conn = mysqli_connect($server_name, $username, $password, $database_name);

                $sql_query="SELECT sum(amt) FROM financet WHERE MONTH(ddate) = MONTH(CURDATE()) and tto='Company'";
                $result = mysqli_query($conn, $sql_query);
                $row = mysqli_fetch_array($result);
                $income = $row['sum(amt)']; 

                $sql_query="SELECT sum(amt) FROM financet WHERE MONTH(ddate) = MONTH(CURDATE()) and ffrom='Company'";
                $result = mysqli_query($conn, $sql_query);
                $row = mysqli_fetch_array($result);
                $expenses = $row['sum(amt)']; 

                $margin=$income-$expenses;
                if ($margin>0) {
                    $s="p";
                }else{
                    $s="l";
                }
            ?>

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="fcard info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Income <span>| This month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo '₹', $income;  ?> </h6>
                      <span class="text-success small pt-1 fw-bold">Total </span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="fcard info-card sales-card">


                <div class="card-body">
                  <h5 class="card-title">Expenses <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo '₹',  $expenses ; ?> </h6>
                      <span class="text-danger small pt-1 fw-bold"> Total </span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-8">

              <div class="fcard info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title"><?php if ($s=="p"){echo "Profit";}else{echo "Loss";}?> <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php echo '₹', ($income-$expenses); ?></h6>
                      <?php 
                            if ($s=="p"){
                                //echo "Profit";
                                echo '<span class="text-success small pt-1 fw-bold">Profit Margin</span>';
                                }
                            else{
                                //echo "Loss";
                                echo '<span class="text-danger small pt-1 fw-bold">Loss Margin</span>';
                            }
                      ?>
                       
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
      </div>
    </section>
        
      <div id="input" name="input" class="card">
        <div class="card-body">
          <h5 class="card-title">Financial Status</h5>

            <?php
                include '../imports/config.php';
                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                $sql_query="SELECT * FROM financet";
                $records = mysqli_query($conn, $sql_query);

                $bal=100000;
                $n=1;

                $m=array();

                while($data = mysqli_fetch_array($records)){
                    $cid=$data['Id'];
                    $ddate=$data['ddate'];
                    $ffrom=$data['ffrom'];
                    $tto=$data['tto'];
                    $deptname=$data['deptname'];
                    $amt=$data['amt'];
                    $narration=$data['narration'];

                    if ($ffrom=="Company"){
                        $bal=$bal-$amt;
                    }
                    else{
                        $bal=$bal+$amt;
                    }

                    $m[$n]=array($cid,$ddate,$ffrom,$tto,$deptname,$amt,$narration,$bal);
                    $n++;
                }

                //Display Array
                for($i=1;$i<=count($m);$i++){
                    if ($m[$i][4]=="Project"){
                        $t=$m[$i][2];
                        $sql_query="SELECT cname FROM clientt where Id=$t";
                        $records = mysqli_query($conn, $sql_query);
                        while($data = mysqli_fetch_array($records)){
                            $m[$i][2]=$data['cname'];
                        }
                    }
                    
                    for ($j=0;$j<count($m[$i]);$j++){
                        //echo $m[$i][$j]." ";
                    }
                    //echo "<br>";
                }

                echo '<div class="table-responsive">';
                echo "<table class='table table-hover table-bordered table-striped'>";
                echo '<table class="table datatable">';
                    echo '<thead class="thead-dark">';
                        echo '<tr>';
                        echo '<th scope="col">#</th>';
                        echo '<th scope="col">ID</th>';
                        echo '<th scope="col">Date</th>';
                        echo '<th scope="col">From</th>';
                        echo '<th scope="col">To</th>';
                        echo '<th scope="col">Department</th>';
                        echo '<th scope="col">Amount</th>';
                        echo '<th scope="col">Narration</th>';
                        echo '<th scope="col">Balance</th>';
                        echo '<th scope="col">Receipt</th>';
                        echo '</tr>';
                    echo '</thead>';
    
                    echo '<tbody>';

                    for ($i=1;$i<=count($m);$i++){
                        echo '<tr>';
                            echo '<th scope="row">'.$i.'</th>';
                            echo '<td>'.$m[$i][0].'</td>';
                            echo '<td>'.$m[$i][1].'</td>';
                            echo '<td>'.$m[$i][2].'</td>';
                            echo '<td>'.$m[$i][3].'</td>';
                            echo '<td>'.$m[$i][4].'</td>';
                            echo '<td>'.$m[$i][5].'</td>';
                            echo '<td>'.$m[$i][6].'</td>';
                            echo '<td>'.$m[$i][7].'</td>';
                            echo '<td><a href="">Receipt</a></td>';
                        echo '</tr>';
                    }

                    echo '</tbody>
                    </table>';
                echo '</div>';
        
                mysqli_close($conn);

            ?>

        </div>
      </div>

    </section>

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
            //print("Op");
        }
        else{
            ob_start();
            header('Location: '.'../index.php');
            ob_end_flush();
            die();
        }
    ?>