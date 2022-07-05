<?php
    session_start();
    if ($_SESSION['erole']=="admin"){
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Attendance - RichTech </title>
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
                <h1>Attendance</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ol>
                </nav>
            </div>
            
            <div class="row">
            <div class="col-lg-6 col-md-6" style="float:left; width:50%;">
                <div class="card" >
                    <div class="card-body">
                        <h5 class="card-title">Attendance Form</h5>
                        <!-- Vertical Form -->
                        <form class="row mb-3" method="POST" action="attendanceBackend.php">
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Employee id</label>
                                <input type="text" class="form-control" id="empid" name="empid" required="">
                                <br />
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" placeholder="Date" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Time</label>
                                <input type="time" class="form-control" id="time" name="time" placeholder="Time" required="">
                                <br />
                            </div>

                            <!--
                                option code is commented out because it is not used in this project
                            <div class="col-md-6">
                            <label for="inputState" class="form-label">OnTime</label>
                            <select id="boolval" name="boolval" class="form-select">
                                <option selected>False</option>
                                <option>True</option>
                            </select>
                            </div>
                            -->

                            <div class="text-center">
                                <br>
                                <button type="submit" name="intime" class="btn btn-primary">Enter</button>
                                <button type="submit" name="outtime" class="btn btn-secondary">Release</button>
                            </div>
                        </form>
                        <!-- Vertical Form -->
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6" style="float:right;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search by Employee Details</h5>
                        <!-- Vertical Form -->
                        <form class="row mb-3" action="" method="POST">
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Employee id</label>
                                <input type="text" class="form-control" id="empid" name="empid" required="">
                                <br />
                            </div>
                            
                            <div class="col-md-12">
                                <label for="inputEmail4" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                            </div>
                            <p></p> <p></p> <p></p>

                            <div class="text-center">
                                <button type="submit" name="searchattendance" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        <!-- Vertical Form -->
                    </div>
                </div>
            </div>
            </div>
            <br>
            <br>
            <!-- End Page Title -->
            <section class="section dashboard">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Current Logs</h5>
                                <!-- Employee Details Table -->
                                <?php

                                    include '../imports/config.php';
                                    $conn=mysqli_connect($server_name,$username,$password,$database_name);

                                    if(isset($_POST['searchattendance']) ){
                                        
                                        $empid=$_POST['empid'];
                                        $date=$_POST['date'];
                                        if ($date !="") {
                                            $sql="SELECT * FROM attendancet WHERE empid='$empid' AND ddate='$date' ORDER BY Id DESC";
                                            $records=mysqli_query($conn,$sql);
                                        }else{
                                            $sql="SELECT * FROM attendancet WHERE empid='$empid' ORDER BY Id DESC";
                                            $records=mysqli_query($conn,$sql);
                                        }
                                        
                                        if(mysqli_num_rows($records)>0){
                                           
                                            $n=1;
                                            echo '<div class="table-responsive">';
                                            echo '<table class="table datatable">';
                                                echo '<thead class="thead-dark">';
                                                    echo '<tr>';
                                                    echo '<th scope="col">#</th>';
                                                    echo '<th scope="col">Empid</th>';
                                                    echo '<th scope="col">User Name</th>';
                                                    echo '<th scope="col">Work-Profile</th>';
                                                    echo '<th scope="col">Date</th>';
                                                    echo '<th scope="col">In-time</th>';
                                                    echo '<th scope="col">Out-time</th>';
                                                    echo '<th scope="col">Status</th>';
                                            
                                            
                                                    echo '</tr>';
                                                echo '</thead>';
                                                echo '<tbody>';
                                                while($data = mysqli_fetch_array($records)){
                                                    $empid=$data['empid'];
                                                    $ename=$data['uname'];
                                                    $ddate=$data['ddate'];
        
                                                    $mysql = "SELECT bio from empt where empid='$empid'";
                                                    $result2 = mysqli_query($conn, $mysql);
                                                    $row2 = mysqli_fetch_assoc($result2);
                                                    $bio = $row2['bio'];
        
                                                    $intime=$data['intime'];
        
                                                    $outtime=$data['outtime'];
                                                    if ($outtime=="") {
                                                        $outtime="Working";
                                                    }
                                                
                                                    $status=$data['fullday'];  
                                                    if ($status=="True") {
                                                        $status="Full Day";
                                                    }
                                                    elseif ($status=="False" && $outtime=="Working") {
                                                        $status="";
                                                    }
                                                    else{
                                                        $status="Late/Half Day";
                                                    }
        
                                                    echo '<tr>
                                                            <th scope="row">'.$n.'</th>
                                                            <td>'.$empid.'</td>
                                                            <td>'.$ename.'</td>
                                                            <td>'.$bio.'</td>
                                                            <td>'.$ddate.'</td>
                                                            <td>'.$intime.'</td>
                                                            <td>'.$outtime.'</td>
                                                            <td>'.$status.'</td>
                                            
                                                            </tr>';
                                                    $n+=1;
                                                }
                                                echo '</tbody>
                                        </table>';
                                        echo '</div>';
                                        }
                                        else{
                                            echo "No data found";
                                        }
                                    }else{
                                    
                                        $sql_query = "SELECT * from attendancet ORDER BY Id DESC";
                                        $records = mysqli_query($conn, $sql_query);
                                        $n=1;
                                        echo '<div class="table-responsive">';
                                        echo '<table class="table datatable">';
                                            echo '<thead class="thead-dark">';
                                                echo '<tr>';
                                                echo '<th scope="col">#</th>';
                                                echo '<th scope="col">Empid</th>';
                                                echo '<th scope="col">User Name</th>';
                                                echo '<th scope="col">Work Profile</th>';
                                                echo '<th scope="col">Date</th>';
                                                echo '<th scope="col">In-time</th>';
                                                echo '<th scope="col">Out-time</th>';
                                                echo '<th scope="col">Status</th>';
                                        
                                        
                                                echo '</tr>';
                                            echo '</thead>';
                                        
                                            echo '<tbody>';
                                            while($data = mysqli_fetch_array($records)){
                                                $empid=$data['empid'];
                                                $ename=$data['uname'];
                                                $ddate=$data['ddate'];

                                                $mysql = "SELECT bio from empt where empid='$empid'";
                                                $result2 = mysqli_query($conn, $mysql);
                                                $row2 = mysqli_fetch_assoc($result2);
                                                $bio = $row2['bio'];

                                                $intime=$data['intime'];

                                                $outtime=$data['outtime'];
                                                if ($outtime=="") {
                                                    $outtime="Working";
                                                }
                                            
                                                $status=$data['fullday'];  
                                                if ($status=="True") {
                                                    $status="Full Day";
                                                }
                                                elseif ($status=="False" && $outtime=="Working") {
                                                    $status="";
                                                }
                                                else{
                                                    $status="Late/Half Day";
                                                }

                                                echo '<tr>
                                                        <th scope="row">'.$n.'</th>
                                                        <td>'.$empid.'</td>
                                                        <td>'.$ename.'</td>
                                                        <td>'.$bio.'</td>
                                                        <td>'.$ddate.'</td>
                                                        <td>'.$intime.'</td>
                                                        <td>'.$outtime.'</td>
                                                        <td>'.$status.'</td>
                                        
                                                        </tr>';
                                                $n+=1;
                                            }
                                            echo '</tbody>
                                            </table>';
                                            echo '</div>';
                                        }
                                        mysqli_close($conn);
                                    
                                    ?>
                                <!-- End Client Project Working On! -->
                                <!-- Client Project Working On! -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- End #main -->
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

