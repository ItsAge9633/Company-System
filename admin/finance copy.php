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

                echo '<div class="table-responsive">';
                echo '<table class="table table-hover">';
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
                        echo '</tr>';
                    echo '</thead>';
    
                    echo '<tbody>';
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
        
                        //$dob1=explode(" ",$dob);
                        //$dob=$dob1[0];
                        
                        echo '<tr>
                                <th scope="row">'.$n.'</th>
                                <td>'.$cid.'</td>
                                <td>'.$ddate.'</td>
                                <td>'.$ffrom.'</td>
                                <td>'.$tto.'</td>
                                <td>'.$deptname.'</td>
                                <td>'.$amt.'</td>
                                <td>'.$narration.'</td>
                                <td>'.$bal.'</td>
                                </tr>';
                        $n+=1;
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