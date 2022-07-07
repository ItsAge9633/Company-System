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
                <h1>Salary Payments and Invoices</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="salpayment.php">Salary Payment</a></li>
                    </ol>
                </nav>
            </div>
            
            

            <div id="input" name="input" class="card">
        <div class="card-body">
          <h5 class="card-title">Employee Payment</h5>

            <div class="row">
                <div class="col-md-4">
                    <div class="container jumbotron">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="client_id">Employee ID</label>
                            <input type="text" class="form-control" id="client_id" name="client_id" placeholder="Enter Employee ID">
                        </div><br>

                        <div class="form-group">
                            <label for="client_id">Bonus</label>
                            <input type="text" class="form-control" id="client_id" name="client_id" placeholder="If any">
                        </div><br>


                        <center><button type="submit" name="checkdetails" class="btn btn-primary">Checkout</button></center>
                    </form>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="container jumbotron">

                    <?php
                            include '../imports/config.php';
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);

                            $sql_query = "SELECT * from clientt where received is NULL and pstatus='Completed'";
                            $records = mysqli_query($conn, $sql_query);
                            $n=1;
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-hover">';
                                echo '<thead class="thead-dark">';
                                    echo '<tr>';
                                    echo '<th scope="col">Emp ID</th>';
                                    echo '<th scope="col">Name</th>';
                                    echo '<th scope="col">Salary</th>';
                                    echo '<th scope="col">Bonus</th>';
                                    echo '<th scope="col">Total Salary</th>';
                                    echo '<th scope="col">Status</th>';
                                    echo '</tr>';
                                echo '</thead>';
                
                                echo '<tbody>';

                                /*
                                while($data = mysqli_fetch_array($records)){
                                    $cid=$data['Id'];
                                    $cname=$data['cname'];
                                    $pname=$data['pname'];
                                    $cdate=$data['cdate'];
                                    $charges=$data['charges'];
                    
                                    //$dob1=explode(" ",$dob);
                                    //$dob=$dob1[0];
                                    
                                    echo '<tr>
                                            <th scope="row">'.$n.'</th>
                                            <td>'.$cid.'</td>
                                            <td>'.$cname.'</td>
                                            <td>'.$pname.'</td>
                                            <td>'.$cdate.'</td>
                                            <td>'.$charges.'</td>
                                            </tr>';
                                    $n+=1;
                                }

                                 */

                                echo "<tr>";
                                echo "<td>".'3'."</td>";
                                echo "<td>".'CWIT'."</td>";
                                echo "<td>".'₹'.'45000'."</td>";
                                echo "<td>".'₹'.'5000'."</td>";
                                echo "<td>".'₹'.'50000'."</td>";
                                echo "<td>".'Pending'."</td>";
                                echo "</tr>";

                                echo '</tbody>
                                </table>';
                            echo '</div>';
                    
                            mysqli_close($conn);

                       
                        ?>
                        <center><button type="submit" name="checkdetails" class="btn btn-primary">Pay</button></center>
                    </div>
                </div>
            </div>

        </div>
      </div>

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

                                $sql_query = "SELECT * from salpayt ORDER BY Id DESC";
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
                                                echo '<th scope="col">Department</th>';
                                                echo '<th scope="col">Bonus</th>';
                                                echo '<th scope="col">Salary Paid</th>';
                                                echo '<th scope="col">Date</th>';
                                                echo '</tr>';
                                            echo '</thead>';
                                        
                                            echo '<tbody>';

                                            /*
                                            while($data = mysqli_fetch_array($records)){

                                                $empid = $data['empid'];
                                                
                                                $sqluser = "SELECT * from logint where euid = '$empid'";
                                                $recordsuser = mysqli_query($conn, $sqluser);
                                                $datauser = mysqli_fetch_array($recordsuser);
                                                $uname = $datauser['uname'];

                                                $sqlwork = "SELECT bio from empt where empid = '$empid'";
                                                $recordswork = mysqli_query($conn, $sqlwork);
                                                $datawork = mysqli_fetch_array($recordswork);
                                                $bio = $datawork['bio'];

                                                $deptname = $datauser['deptname'];

                                                $salary = $data['gsalary'];

                                                $bonus = $data['bonus'];

                                                $gdate = $data['gdate'];
                                                

                                                echo '<tr>
                                                        <th scope="row">'.$n.'</th>
                                                        <td>'.$empid.'</td>
                                                        <td>'.$uname.'</td>
                                                        <td>'.$bio.'</td>
                                                        <td>'.$deptname.'</td>
                                                        <td>'.$sal_paid.'</td>
                                                        <td>'.$bonuspaid.'</td>
                                                        <td>'.$gdate.'</td>
                                        
                                                        </tr>';
                                                $n+=1;
                                            }
                                            */

                                            echo "<tr>";
                                            echo "<th scope='row'>".'1'."</th>";
                                            echo "<td>".'2'."</td>";
                                            echo "<td>".'DCP'."</td>";
                                            echo "<td>".'Software Engineer'."</td>";
                                            echo "<td>".'Software Development'."</td>";
                                            echo "<td>".'₹'.'15000'."</td>";
                                            echo "<td>".'₹'.'65000'."</td>";
                                            echo "<td>".'01-07-2022'."</td>";
                                            
                                            echo "</tr>";

                                            echo '</tbody>
                                            </table>';
                                            echo '</div>';
                                            
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

