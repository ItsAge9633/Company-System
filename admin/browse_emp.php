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
      <h1><a href="browse_emp.php">Employees</a></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="browse_emp.php">Employees</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <br>
    <div id="input" name="input" class="card" style="padding: 2%;">
        <form action="" method="post">
            <label for="empid" class="form-label">Fetch Employee Details by Employee ID:</label>
            <div class="row">
                <div class="col-md-10"><input type="text" class="form-control" name="empid" id="empid"></div>
                <div class="col-md-2"><center><input type="submit" class="btn btn-outline-success" value="Fetch" name="byid"></center></div>
            </div>
        </form>
        <hr>
        <form action="" method="post">
            <label for="ename" class="form-label">Fetch Employee Details by Employee Name:</label>
            <div class="row">
                <div class="col-md-10"><input type="text" class="form-control" name="ename" id="ename"></div>
                <div class="col-md-2"><center><input type="submit" class="btn btn-outline-success" value="Fetch" name="byname"></center></div>
            </div>
        </form>
        <hr>
        <form action="" method="post">
            <label for="email" class="form-label">Fetch Employee Details by Employee Email ID:</label>
            <div class="row">
                <div class="col-md-10"><input type="text" class="form-control" name="email" id="email"></div>
                <div class="col-md-2"><center><input type="submit" class="btn btn-outline-success" value="Fetch" name="byemail"></center></div>
            </div>
        </form>
    </div>
    
    <?php
            include '../imports/config.php';
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
            if (isset($_POST['byname'])){
                $ename = $_POST['ename'];
                $sql_query = "SELECT * from empt where ename='$ename'";
                $records = mysqli_query($conn,$sql_query);
            }elseif (isset($_POST['byid'])){
                $empid = $_POST['empid'];
                $sql_query = "SELECT * from empt where empid='$empid'";
                $records = mysqli_query($conn,$sql_query);
            }elseif (isset($_POST['byemail'])){
                $email = $_POST['email'];
                $sql_query = "SELECT * from empt where email='$email'";
                $records = mysqli_query($conn,$sql_query);
            }
            if (isset($_POST['byid']) or isset($_POST['byemail']) or isset($_POST['byname'])){
                echo '<style type="text/css">#input{display:none;}</style>';
                while($data = mysqli_fetch_assoc($records)){
                    $empid=$data['empid'];
                    $ename=$data['ename'];
                    $email=$data['email'];
                    $mobile=$data['mobile'];
                    $dob=$data['dob'];
                    $dob1=explode(" ",$dob);
                    $dob=$dob1[0];
                    $address=$data['eaddress'];
                    $photo=$data['pphoto'];
                    $cv=$data['cv'];
                    $bio=$data['bio'];
                    $wstatus=$data['wstatus'];
                    echo '<div class="card" style="padding: 2%;">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="data:image/jpg;charset=utf8;base64, '.base64_encode($photo).'" height="200px" width="200px"/>
                        </div>
                        <div class="col-md-9">
                            <h2>'.$ename.'</h2>
                            <div class="row"><div class="col-md-2"><p>Employee Id:</p></div><div class="col-md-10"><p>'.$empid.'</p></div></div>
                            <div class="row"><div class="col-md-2"><p>Email Id:</p></div><div class="col-md-10"><p>'.$email.'</p></div></div>
                            <div class="row"><div class="col-md-2"><p>Mobile No:</p></div><div class="col-md-10"><p>'.$mobile.'</p></div></div>
                            <div class="row"><div class="col-md-2"><p>DOB:</p></div><div class="col-md-10"><p>'.$dob.'</p></div></div>
                            <div class="row"><div class="col-md-2"><p>Address:</p></div><div class="col-md-10"><p>'.$address.'</p></div></div>
                            <div class="row"><div class="col-md-2"><p>Bio:</p></div><div class="col-md-10"><p>'.$bio.'</p></div></div>
                            <div class="row"><div class="col-md-2"><p>Status:</p></div><div class="col-md-10"><p>'.$wstatus.'</p></div></div>
                        </div>
                    </div>
                    <hr>';
                    echo '<div class="row">
                            <div class="col-md-7">
                                <center><h4>Projects Completed!</h4></center>';
                                $sql_query = "SELECT * from clientt where Id in (SELECT pid from workt where empid='$empid' and wstatus='Completed')";
                                $records = mysqli_query($conn,$sql_query);
                                echo '<div class="table-responsive">';
                                echo '<table class="table table-hover" style="margin-top: 1%;">';
                                    echo '<thead class="thead-dark">';
                                        echo '<tr>';
                                        echo '<th scope="col">Project ID</th>';
                                        echo '<th scope="col">Client Name</th>';
                                        echo '<th scope="col">Project Name</th>';
                                        echo '<th scope="col">Submission Date</th>';
                                        echo '<th scope="col">Charges</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($data = mysqli_fetch_array($records)){
                                        $n=$data['Id'];
                                        $cname=$data['cname'];
                                        $pname=$data['pname'];
                                        $cdate=$data['cdate'];
                                        $charges=$data['charges'];
                                        $array1 = explode(' ', $cdate);
                                        $cdate = $array1[0];
                                        
                                        echo '<tr>
                                                <th scope="row">'.$n.'</th>
                                                <td>'.$cname.'</td>
                                                <td>'.$pname.'</td>
                                                <td>'.$cdate.'</td>
                                                <td>'.$charges.'</td>
                                                </tr>';
                                    }
                                    echo '</tbody>
                                    </table>';
                            echo '</div>';
                    echo '</div>';

                    echo '<div class="col-md-5">
                    <center><h4>Projects Working On!</h4></center>';
                    $sql_query = "SELECT * from clientt where Id in (SELECT pid from workt where empid='$empid' and wstatus='Working')";
                    $records = mysqli_query($conn,$sql_query);
                    echo '<div class="table-responsive">';
                    echo '<table class="table table-hover" style="margin-top: 1%;">';
                        echo '<thead class="thead-dark">';
                            echo '<tr>';
                            echo '<th scope="col">Project ID</th>';
                            echo '<th scope="col">Client Name</th>';
                            echo '<th scope="col">Project Name</th>';
                            echo '<th scope="col">Due Date</th>';
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
        
                        while($data = mysqli_fetch_array($records)){
                            $n=$data['Id'];
                            $cname=$data['cname'];
                            $pname=$data['pname'];
                            $ddate=$data['ddate'];
                            $charges=$data['charges'];
                            if($ddate=="0000-00-00 00:00:00"){
                                $ddate="No Due Date";
                            }else{
                                $array1 = explode(' ', $cdate);
                                $cdate = $array1[0];
                            }
                            
                            echo '<tr>
                                    <th scope="row">'.$n.'</th>
                                    <td>'.$cname.'</td>
                                    <td>'.$pname.'</td>
                                    <td>'.$ddate.'</td>
                                    </tr>';
                        }
                        echo '</tbody>
                        </table>';
                echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        ?>
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