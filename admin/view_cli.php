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
      <h1>Clients</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Clients</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                <div class="card-body">
                <h5 class="card-title">Client Project Working On!</h5>

                <!-- Client Project Working On! -->

                <?php
                include '../imports/config.php';
                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                $sql_query = "SELECT * from clientt where pstatus='Working'";
                $records = mysqli_query($conn, $sql_query);
                echo '<div class="table-responsive">';
                echo '<table class="table table-hover">';
                    echo '<thead class="thead-dark">';
                        echo '<tr>';
                        echo '<th scope="col">Project ID</th>';
                        echo '<th scope="col">Client Name</th>';
                        echo '<th scope="col">Project Name</th>';
                        echo '<th scope="col">Due Date</th>';
                        echo '<th scope="col">Status</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while($data = mysqli_fetch_array($records)){
                        $n=$data['Id'];
                        $cname=$data['cname'];
                        $pname=$data['pname'];
                        $ddate=$data['ddate'];
                        $status=$data['pstatus'];
                        if($ddate=="0000-00-00"){
                            $ddate="No Due Date";
                        }else{
                            $array1 = explode(' ', $ddate);
                            $ddate = $array1[0];
                        }
                        
                        echo '<tr>
                            <th scope="row">'.$n.'</th>
                            <td>'.$cname.'</td>
                            <td>'.$pname.'</td>
                            <td>'.$ddate.'</td>
                            <td>'.$status.'</td>
                            </tr>';
                    }
                    echo '</tbody>
                    </table>';
                echo '</div>';
                ?>

                <!-- End Client Project Working On! -->
                <!-- Client Project Working On! -->

                </div>
            </div>
            </div>  
            <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Client Project Pending!</h5>

                <!-- Client Project Pending! -->
                <?php
                include '../imports/config.php';
                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                $sql_query = "SELECT * from clientt where pstatus='Pending'";
                $records = mysqli_query($conn, $sql_query);
                echo '<div class="table-responsive">';
                echo '<table class="table table-hover">';
                    echo '<thead class="thead-dark">';
                        echo '<tr>';
                        echo '<th scope="col">Project ID</th>';
                        echo '<th scope="col">Client Name</th>';
                        echo '<th scope="col">Project Name</th>';
                        echo '<th scope="col">Due Date</th>';
                        echo '<th scope="col">Status</th>';
                        echo '</tr>';
                    echo '</thead>';

                    echo '<tbody>';
                    while($data = mysqli_fetch_array($records)){
                        $n=$data['Id'];
                        $cname=$data['cname'];
                        $pname=$data['pname'];
                        $ddate=$data['ddate'];
                        $status=$data['pstatus'];
                        if($ddate=="0000-00-00"){
                            $ddate="No Due Date";
                        }else{
                            $array1 = explode(' ', $ddate);
                            $ddate = $array1[0];
                        }
                        
                        echo '<tr>
                                <td>'.$n.'</td>
                                <td>'.$cname.'</td>
                                <td>'.$pname.'</td>
                                <td>'.$ddate.'</td>
                                <td>'.$status.'</td>
                                </tr>';
                    }
                    echo '</tbody>
                    </table>';
                echo '</div>';
                ?>
                <!-- Client Project Pending! -->

                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-body">
                <h5 class="card-title">Client Project Completed!</h5>

                <!-- Client Project Completed! -->

                <?php
                include '../imports/config.php';
                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                $sql_query = "SELECT * from clientt where pstatus='Completed'";
                $records = mysqli_query($conn, $sql_query);
                echo '<div class="table-responsive">';
                echo '<table class="table table-hover">';
                    echo '<thead class="thead-dark">';
                        echo '<tr>';
                        echo '<th scope="col">Project ID</th>';
                        echo '<th scope="col">Client Name</th>';
                        echo '<th scope="col">Project Name</th>';
                        echo '<th scope="col">Submission Date</th>';
                        echo '<th scope="col">Status</th>';
                        echo '<th scope="col">Charges</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while($data = mysqli_fetch_array($records)){
                        $n=$data['Id'];
                        $cname=$data['cname'];
                        $pname=$data['pname'];
                        $cdate=$data['cdate'];
                        $status=$data['pstatus'];
                        $charges=$data['charges'];
                        if($cdate=="0000-00-00"){
                            $cdate="No Due Date";
                        }else{
                            $array1 = explode(' ', $ddate);
                            $ddate = $array1[0];
                        }
                        
                        echo '<tr>
                            <td>'.$n.'</td>
                            <td>'.$cname.'</td>
                            <td>'.$pname.'</td>
                            <td>'.$cdate.'</td>
                            <td>'.$status.'</td>
                            <td>'.$charges.'</td>
                            </tr>';
                    }
                    echo '</tbody>
                    </table>';
                echo '</div>';
                ?>

                <!-- End Client Project Completed! -->

                </div>
            </div>
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
            print("Op");
        }
        else{
            ob_start();
            header('Location: '.'../index.php');
            ob_end_flush();
            die();
        }
    ?>