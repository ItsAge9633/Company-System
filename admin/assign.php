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

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>

<body>

  <!-- ======= Top and Side Bar ======= -->
  <?php include 'imports/nav-admin.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Assign Project Work</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Assign Work</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section add_cli">

      <div class="card">
        <div class="card-body">
            <h5 class="card-title">Assign Project Work</h5>
            <div class="row">
            <div class="col-md-6">
                <form action="" method="post">
                    <center>
                        <input type="text" class="form-control" name="pid" id="" placeholder="Project ID"><br>
                        <input type="submit" name="psubmit" style="font-size:20px" class="btn btn-outline-primary" value="Next">
                    </center>
                </form>
            </div>
            <div class="col-md-6">
                <?php
                    include '../imports/config.php';
                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                    $sql_query = "SELECT * from clientt where pstatus='Pending' or pstatus='Working'";
                    $records = mysqli_query($conn, $sql_query);
                    echo '<div class="table-responsive">';
                    echo '<table class="table table-hover"">';
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
            </div>
            </div>
        </div>

        </div>
      </div>

        <div class="card jumbotron container">
            <br>
            <?php
                if (isset($_POST['psubmit'])){
                    $pid=(int) $_POST['pid'];
                    include '../imports/config.php';

                    $conn=mysqli_connect($server_name,$username,$password,$database_name);

                    $sql_query="SELECT pstatus from clientt where ID=$pid";
                    $records=mysqli_query($conn,$sql_query);
                    $data=mysqli_fetch_array($records);
                    $pstatus=$data['pstatus'];

                    if ($pstatus=="Completed"){
                        echo "<script>alert('Project Already Completed');</script>";
                    }else{

                    

                    $sql_query="SELECT * FROM clientt where ID=$pid";
                    $records=mysqli_query($conn,$sql_query);
                    while ($data=mysqli_fetch_assoc($records)){
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
                    }
                    
                    echo '<div>';
                            echo '<center><h3>'.$cname.' : '.$pname.'</h3><br></center>';
                            echo '<div class="row">';
                            echo '<div class="col-md-6">';
                            echo '<div class="row">';
                                echo '<div class="col-md-4">';
                                    echo '<p style="color: #111111;">Client ID:</p>';
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
                                    $pd1=explode(' ', $pdate);
                                    echo '<p style="color: #111111;">'.$pd1[0].'</p>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="row">';
                                echo '<div class="col-md-4">';
                                    echo '<p style="color: #111111;">Deadline:</p>';
                                echo '</div>';
                                echo '<div class="col-md-8">';
                                    if($ddate=="0000-00-00"){
                                        $ddate="No Due Date";
                                    }
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
                            echo '</div>';
                            echo '<div class="col-md-6">';
                            echo '<h5 style="text-align: center;">Employees Status</h5><br>';
                            echo '<div class="row">';
                            echo '<div class="col-md-11">';

                            $conn=mysqli_connect($server_name,$username,$password,$database_name);
                            $sql_query = "SELECT * from empt";
                            $records = mysqli_query($conn, $sql_query);
                            $n=1;
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-hover">';
                                echo '<thead class="thead-dark">';
                                    echo '<tr>';
                                    echo '<th scope="col">#</th>';
                                    echo '<th scope="col">Empid</th>';
                                    echo '<th scope="col">Employee Name</th>';
                                    echo '<th scope="col">Status</th>';
                                    echo '</tr>';
                                echo '</thead>';
                
                                echo '<tbody>';
                                while($data = mysqli_fetch_array($records)){
                                    $empid=$data['empid'];
                                    $ename=$data['ename'];
                                    $wstatus=$data['wstatus'];
                    
                                    echo '<tr>
                                            <th scope="row">'.$n.'</th>
                                            <td>'.$empid.'</td>
                                            <td>'.$ename.'</td>
                                            <td>'.$wstatus.'</td>
                                            </tr>';
                                    $n+=1;
                                }
                                echo '</tbody>
                                </table>';
                                echo '</div>';
                            echo '</div></div>';
            ?>
            <script>
        num=0
    </script>
    <form action="sassign.php" method="post">
        <input type="hidden" id="quesno" name="quesno" value='0'>
        <div id="textboxDiv" name="textboxDiv">
            <?php
                echo '<input type="hidden" name="pid" id="pid" value="'.$pid.'">';
            ?>
        </div>
        <br>
        <center>
            <input type="submit" name="assign" value="Assign" class="btn btn-outline-success">
        </center>
    </form>
    <br>
    <div>
        <center>
            <button id="Add" class="btn btn-secondary">Add Employee</button> 
            <button id="Remove" class="btn btn-secondary">Delete Last Employee</button>
        </center>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>  
        $(document).ready(function() {  
            $("#Add").on("click", function() { 
                w="text"+num
                num+=1 
                $("#textboxDiv").append('<div><input type="text" class="form-control" name="'+w+'" id="'+w+'" placeholder="Emplyee ID"><br></div>');

                document.getElementById("quesno").value=num
            });  
            $("#Remove").on("click", function() {  
                
                console.log(num)
                if (num>0){
                    $("#textboxDiv").children().last().remove();
                    num-=1
                    document.getElementById("quesno").value=num
                }
            });  
        });  
    </script>
    <?php
                    //echo '<input type="text" class="form-control" name="pid" id="" placeholder="Project ID"><br>';
                    echo '</div>';
                    echo '</div>';
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