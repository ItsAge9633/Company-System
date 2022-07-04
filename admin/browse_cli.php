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
      <h1><a href="browse_cli.php">Browse Client</a></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="browse_cli.php">Browse Client</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section add_cli">

      <div id="input" name="input" class="card">
        <div class="card-body">
          <h5 class="card-title">Browse Client</h5>

          <div class="container jumbotron">
            <form class="row g-3" action="" method="post">
                <p style="color: #111111;">Fetch Client Details by Client ID:</p>
                <div class="row">
                    <div class="col-md-10"><input type="text" class="form-control" name="cid" id="cid" placeholder="Client ID"></div>
                    <div class="col-md-2"><center><input type="submit" class="btn btn-outline-success" value="Fetch" name="byid"></center></div>
                </div>
            </form>
            <hr>
            <form action="" method="post">
                <p style="color: #111111;">Fetch Client Details by Client Name:</p>
                <div class="row">
                    <div class="col-md-10"><input type="text" class="form-control" name="cname" id="cname" placeholder="Client Name"></div>
                    <div class="col-md-2"><center><input type="submit" class="btn btn-outline-success" value="Fetch" name="byname"></center></div>
                </div>
            </form>
            <hr>
            <form action="" method="post">
                <p style="color: #111111;">Fetch Client Details by Client Email ID:</p>
                <div class="row">
                    <div class="col-md-10"><input type="text" class="form-control" name="email" id="email" placeholder="Client Email ID"></div>
                    <div class="col-md-2"><center><input type="submit" class="btn btn-outline-success" value="Fetch" name="byemail"></center></div>
                </div>
            </form>
            <hr>
            <form action="" method="post">
                <p style="color: #111111;">Fetch Client Details by Project Name:</p>
                <div class="row">
                    <div class="col-md-10"><input type="text" class="form-control" name="proj" id="proj" placeholder="Project Name"></div>
                    <div class="col-md-2"><center><input type="submit" class="btn btn-outline-success" value="Fetch" name="byproj"></center></div>
                </div>
            </form>
        </div>

        </div>
      </div>

      <div class="row card">
        <?php
            if (isset($_POST['byid'])){
                $cid = $_POST['cid'];
                include '../imports/config.php';
                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                $sql_query = "SELECT * from clientt where id='$cid'";
                $records = mysqli_query($conn,$sql_query);
            }
            elseif (isset($_POST['byname'])){
                $cname = $_POST['cname'];
                include '../imports/config.php';
                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                $sql_query = "SELECT * from clientt where cname='$cname'";
                $records = mysqli_query($conn,$sql_query);
            }
            elseif (isset($_POST['byemail'])){
                $email = $_POST['email'];
                include '../imports/config.php';
                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                $sql_query = "SELECT * from clientt where email='$email'";
                $records = mysqli_query($conn,$sql_query);
            }
            elseif (isset($_POST['byproj'])){
                $proj = $_POST['proj'];
                include '../imports/config.php';
                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                $sql_query = "SELECT * from clientt where pname='$proj'";
                $records = mysqli_query($conn,$sql_query);
            }

            if (isset($_POST['byid']) or isset($_POST['byname']) or isset($_POST['byemail']) or isset($_POST['byproj'])){
                echo '<style type="text/css">#input{display:none;}</style>';
                while($data = mysqli_fetch_assoc($records)){
                    $cid=$data['Id'];
                    $cname=$data['cname'];
                    $pname=$data['pname'];
                    $mobile=$data['mobile'];
                    $email=$data['email'];
                    $address=$data['aaddress'];
                    $pdate=$data['pdate'];
                    $ddate=$data['ddate'];
                    $descrip=$data['descrip'];
                    $status=$data['pstatus'];
                    $cdate=$data['cdate'];
                    $charges=$data['charges'];
                    
                    $pd1=explode(" ",$pdate);
                    $pdate=$pd1[0];

                    if($ddate=="0000-00-00 00:00:00"){
                        $ddate="No Due Date";
                    }else{
                        $dd1=explode(" ",$ddate);
                        $ddate=$dd1[0];
                    }

                    if (is_null($cdate)){
                        $cdate="Not Completed yet";
                    }else{
                        $cd1=explode(' ', $cdate);
                        $cdate=$cd1[0];
                    }

                    echo '<div style="padding-left: 3%;">';
                        echo '<br><center><h3>'.$cname.' : '.$pname.'</h3><br></center>';
                        echo '<div class="row">';
                        echo '<div class="col-md-6">';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Project ID:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$cid.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Client Name:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$cname.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Project Name:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$pname.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Mobile:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$mobile.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Email:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$email.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Address:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$address.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Assigned Date:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$pdate.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Deadline:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$ddate.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Description:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$descrip.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Status:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$status.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Completed Date:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$cdate.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="row">';
                            echo '<div class="col-md-4">';
                                echo '<p style="color: #111111;">Charges:</p>';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                                echo '<p style="color: #111111;">'.$charges.'</p>';
                            echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-5">';
                        echo '<h5 style="text-align: center;">Employees Working on This Project</h5><br>';
                            echo '<div class="row">';  
                                echo '<table class="table table-hover">';
                                    echo '<thead class="thead-dark">';
                                        echo '<tr>';
                                        echo '<th scope="col">#</th>';
                                        echo '<th scope="col">Empid</th>';
                                        echo '<th scope="col">Employee Name</th>';
                                        echo '<th scope="col">Mobile Number</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                if (isset($_POST['byid']) or isset($_POST['byname']) or isset($_POST['byemail']) or isset($_POST['byproj'])){
                                    $n=1;
                                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                                    $sql_query = "SELECT * from empt where empid in (select empid from workt where pid='$cid' and wstatus='Working')";
                                    $records = mysqli_query($conn,$sql_query);
                                    while($data = mysqli_fetch_assoc($records)){
                                        $empid=$data['empid'];
                                        $ename=$data['ename'];
                                        $email=$data['email'];
                                        $mobile=$data['mobile'];

                                        echo '<tr>
                                        <th scope="row">'.$n.'</th>
                                        <td>'.$empid.'</td>
                                        <td>'.$ename.'</td>
                                        <td>'.$mobile.'</td>
                                        </tr>';
                                        $n+=1;
                                    }
                                }
                                echo '</tbody>
                                    </table>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div><br>';
                    echo '</div><br>';
                }
            }
        ?>
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