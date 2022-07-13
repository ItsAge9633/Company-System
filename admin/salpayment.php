<?php
    session_start();
    if ($_SESSION['erole']=="admin"){
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Salary Payment - RichTech </title>
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
          <h5 class="card-title">Employee Payment - This month</h5>

            <div class="row">
                <div class="col-md-4">
                    <div class="container jumbotron">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="empid">Employee ID</label>
                            <input type="text" class="form-control" id="empid" name="empid" placeholder="Enter Employee ID" required = "">
                        </div><br>

                        <div class="form-group">
                            <label for="bonus">Bonus</label>
                            <input type="text" class="form-control" id="bonus" name="bonus" placeholder="If any">
                        </div><br>


                        <center><button type="submit" name="checkdetails" class="btn btn-primary">Checkout</button></center>
                   
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="container jumbotron">

                    <?php
                            include '../imports/config.php';
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);
                            
                            if(isset($_POST['checkdetails'])){

                                $empid = $_POST['empid'];
                                $bonus = $_POST['bonus'];
                                
                                if(!$bonus){
                                    $bonus = 0;
                                }else{
                                    $bonus = $_POST['bonus'];
                                }
                                
                                $sqlemp = "SELECT euid from logint where euid = '$empid'";
                                $resultemp = mysqli_query($conn,$sqlemp);
                                $empcount = mysqli_num_rows($resultemp);

                                if($empcount > 0){

                                    $sqluname = "SELECT uname from empt where empid = '$empid'";
                                    $resultuname = mysqli_query($conn,$sqluname);
                                    $rowuname = mysqli_fetch_assoc($resultuname);
                                    $uname = $rowuname['uname'];


                                    $sqlcheck = "SELECT * from salpayt where euid='$empid'";
                                    $resultcheck = mysqli_query($conn,$sqlcheck);
                                    $rowcheck = mysqli_fetch_assoc($resultcheck);
                                    $rowcountcheck = mysqli_num_rows($resultcheck);
                                    if($rowcountcheck == 0){

                                        echo "<div class='alert alert-danger' role='alert'>
                                                <center>
                                                    <h4>No Salary Payment Found</h4>
                                                </center>
                                            </div>";
                                        error_reporting(0);
                                        
                                    }else{ $salary = $rowcheck['tsalary']; }
                                    
                                    $total = $salary + $bonus;

                            }else{
                                echo "<script>alert('Employee ID not found')</script>";
                                echo "<script>window.location.href='salpayment.php'</script>";
                            }
                            

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

                                echo '<tr>';
                                echo '<td>'.$empid.'</td>';
                                echo '<td>'.$uname.'</td>';
                                echo '<td>'.$salary.'</td>';
                                echo '<td>'.$bonus.'</td>';
                                echo '<td>'.$total.'</td>';

                                if(!is_null($rowcheck['gdate'])){
                                    echo '<td>'.'Paid on '.$rowcheck['gdate'].'</td>';
                                }else{
                                    echo '<td>Not Paid</td>';
                                }
                                
                                echo '</td>';


                                
                                /*
                                echo "<tr>";
                                echo "<td>".'3'."</td>";
                                echo "<td>".'CWIT'."</td>";
                                echo "<td>".'₹'.'45000'."</td>";
                                echo "<td>".'₹'.'5000'."</td>";
                                echo "<td>".'₹'.'50000'."</td>";
                                echo "<td>".'Pending'."</td>";
                                echo "</tr>";
                                */

                                echo '</tbody>
                                </table>';
                            echo '</div>';
                            }else{

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
                                    echo '</table>';
                                echo '</div>';

                            }

                        ?>
                        <center><button type="submit" name="payemp" class="btn btn-primary">Pay</button></center>
                        </form>
                    </div>
                    
                </div>
            </div>

        </div>
      </div>


      <div id="input" name="input" class="card">
        <div class="card-body">
          <h5 class="card-title">Employee Payment - Pending</h5>

            <div class="row">
                <div class="col-md-4">
                    <div class="container jumbotron">
                    <form action="" method="post">
                        <div class="col-md-12">
                            <label for="inputState" class="form-label">Month</label>
                            <select id="monthall" name="monthall" class="form-select" required = "">

                            <?php
                                if(!$_POST['monthall']){
                                    $monthall = date('m'). ' - ' .date('F');
                                }else{
                                    $monthall = $_POST['monthall'];
                                }
                            ?>
                                <option selected> <?php echo $monthall; ?> </option>
                                <option>01 - Janauary</option>
                                <option>02 - February</option>
                                <option>03 - March</option>
                                <option>04 - April</option>
                                <option>05 - May</option>
                                <option>06 - June</option>
                                <option>07 - July</option>
                                <option>08 - August</option>
                                <option>09 - September</option>
                                <option>10 - October</option>
                                <option>11 - November</option>
                                <option>12 - December</option>  
                            </select>
                            </div><br>

                        <div class="form-group">
                            <label for="bonus">Bonus</label>
                            <input type="text" class="form-control" id="bonusall" name="bonusall" placeholder="If any">
                        </div><br>


                        <center><button type="submit" name="checkalldetails" class="btn btn-primary">Checkout</button></center>
                   
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="container jumbotron">

                    <?php
                            include '../imports/config.php';
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);
                            
                            if(isset($_POST['checkalldetails'])){

                                $month = $_POST['monthall'];
                                $bonus = $_POST['bonusall'];
                                
                                $monthnum = date('m', strtotime($month));
                                
                                if(!$bonus){
                                    $bonus = 0;
                                }else{
                                    $bonus = $_POST['bonusall'];
                                }
                                
                            $sql = "SELECT * FROM salpayt WHERE month = '$monthnum'";
                            $result = mysqli_query($conn, $sql);
                            $resultcheck = mysqli_num_rows($result);

                            $sqlpending = "SELECT * FROM salpayt WHERE month = '$monthnum' AND gdate IS NULL";
                            $resultpending = mysqli_query($conn, $sqlpending);
                            $resultcheckpending = mysqli_num_rows($resultpending);

                            $sqlcountdone  = "SELECT COUNT(gdate) FROM salpayt WHERE month = '$monthnum' AND gdate IS NOT NULL";
                            $resultcountdone = mysqli_query($conn, $sqlcountdone);
                            $resultcountdonecheck = mysqli_fetch_assoc($resultcountdone);
                            $countdone = $resultcountdonecheck['COUNT(gdate)'];

                            $sqlsumbonus = "SELECT SUM(bonus) FROM salpayt WHERE month = '$monthnum'";
                            $resultsumbonus = mysqli_query($conn, $sqlsumbonus);
                            $resultsumbonuscheck = mysqli_fetch_assoc($resultsumbonus);
                            $sumbonus = $resultsumbonuscheck['SUM(bonus)'];

                            $sqlsumtotal = "SELECT SUM(tsalary) FROM salpayt WHERE month = '$monthnum'";
                            $resultsumtotal = mysqli_query($conn, $sqlsumtotal);
                            $resultsumtotalcheck = mysqli_fetch_assoc($resultsumtotal);
                            $sumtotal = $resultsumtotalcheck['SUM(tsalary)'];


                            echo '<div class="table-responsive">';
                            echo '<table class="table table-hover">';
                                echo '<thead class="thead-dark">';
                                    echo '<tr>';
                                    echo '<th scope="col">Total Employee</th>';
                                    echo '<th scope="col">Month</th>';
                                    echo '<th scope="col">Pending Payments</th>';
                                    echo '<th scope="col">Completed Payments</th>';
                                    echo '<th scope="col">Bonus</th>';
                                    echo '<th scope="col">Total Salary</th>';
                                    echo '</tr>';
                                echo '</thead>';
                
                                echo '<tbody>';

                                echo '<tr>';
                                echo '<td>'.$resultcheck.'</td>';
                                echo '<td>'.$month.'</td>';
                                echo '<td>'.$resultcheckpending.'</td>';
                                echo '<td>'.$countdone.'</td>';
                                echo '<td>'.$sumbonus.'</td>';
                                echo '<td>'.$sumtotal.'</td>';
                                
                                echo '</td>';
                                echo '</tbody>
                                </table>';
                            echo '</div>';
                            }else{

                                echo '<div class="table-responsive">';
                                echo '<table class="table table-hover">';
                                    echo '<thead class="thead-dark">';
                                        echo '<tr>';
                                        echo '<th scope="col">Total Employee</th>';
                                        echo '<th scope="col">Month</th>';
                                        echo '<th scope="col">Pending Payments</th>';
                                        echo '<th scope="col">Completed Payments</th>';
                                        echo '<th scope="col">Bonus</th>';
                                        echo '<th scope="col">Total Salary</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '</table>';
                                echo '</div>';

                            }

                        ?>
                        <center><button type="submit" name="payempall" class="btn btn-primary">Pay All</button></center>
                        </form>
                    </div>
                    
                </div>
            </div>

        </div>
      </div>

                            

      <?php
      
      if(isset($_POST['payemp'])){
          include '../imports/config.php';
          $conn=mysqli_connect($server_name,$username,$password,$database_name);
          $empid = $_POST['empid'];
          $bonus = $_POST['bonus'];

          $sqlcheck = "SELECT * from salpayt where euid='$empid'";
          $resultcheck = mysqli_query($conn,$sqlcheck);
          $rowcheck = mysqli_fetch_assoc($resultcheck);
          $salary = $rowcheck['tsalary'];

          $total = intval($bonus) + intval($salary);

          $todaydate = date("Y-m-d");

          $sqlcheck = "SELECT gsalary from salpayt where euid='$empid'";
            $resultcheck = mysqli_query($conn,$sqlcheck);
            $rowcheck = mysqli_fetch_assoc($resultcheck);

            if(!is_null($rowcheck['gsalary'])){
                echo "<script>alert('Salary Already Paid');</script>"; 
                echo "<script>window.location.href='salpayment.php';</script>"; 
            }else{
                $sql = "UPDATE `salpayt` SET `gsalary`= '$total', `gdate`= '$todaydate', `bonus` = '$bonus' WHERE euid = '$empid'";
                $result = mysqli_query($conn,$sql);
                if($result){
                    echo "<script>alert('Salary Paid Successfully');</script>";
                    echo "<script>window.location.href='salpayment.php';</script>";
                }else{
                    echo "<script>alert('Error');</script>";
                    echo "<script>window.location.href='salpayment.php';</script>";
                }
            }
          mysqli_close($conn);
      }

      if(isset($_POST['payempall'])){
          include '../imports/config.php';
          $conn=mysqli_connect($server_name,$username,$password,$database_name);

          $month = $_POST['monthall'];
          $monthnum = date("m", strtotime($month));
          $todaydate = date("Y-m-d");

          $bonus = $_POST['bonusall'];
          
          $sql = "SELECT * from salpayt where month = '$monthnum' and gsalary IS NULL";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){

                $empid = $row['euid'];
                $salary = $row['tsalary'];

                $total = intval($bonus) + intval($salary);

                $sqlupdate = "UPDATE `salpayt` SET `gsalary`= '$total', `gdate`= '$todaydate', `bonus` = '$bonus' WHERE euid = '$empid' and month = '$monthnum'";
                $resultupdate = mysqli_query($conn,$sqlupdate);

                $tdate = date("M, Y", strtotime($month));
                $nmsg = "Salary Paid for $tdate on $todaydate";
                $sql_query = "INSERT into notift (euid,ttype,nmsg,ddate) VALUES ('$empid','Salary','$nmsg','$todaydate')";
                $result11 = mysqli_query($conn,$sql_query);
                
                if($resultupdate){
                    echo "<script>alert('Salary Paid To All Successfully');</script>";
                    echo "<script>window.location.href='salpayment.php';</script>";
                }else{
                    echo "<script>alert('Error');</script>";
                    echo "<script>window.location.href='salpayment.php';</script>";
                }


          }

            $tdate = date("M, Y", strtotime($month));
            $nmsg = "Salary Paid for $tdate on $todaydate";
            $sql_query = "INSERT into notift (euid,ttype,nmsg,ddate) VALUES ('admin','Salary','$nmsg','$todaydate')";
            $result11 = mysqli_query($conn,$sql_query);   

          mysqli_close($conn);
      }

      ?>
                       

            <!-- End Page Title -->
            <section class="section dashboard">
                <p></p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Current Logs</h5>
                                <!-- Employee Details Table -->
                                <?php

                                include '../imports/config.php';
                                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                                $sql_query = "SELECT * from salpayt where gdate is not NULL";
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
                                                echo '<th scope="col">Salary Paid</th>';
                                                echo '<th scope="col">Bonus</th>';
                                                echo '<th scope="col">Paid Date</th>';
                                                echo '<th scope="col">Month</th>';
                                                echo '<th scope="col">Receipt</th>';
                                                echo '</tr>';
                                            echo '</thead>';

                                            echo '<tbody>';

                                            while($data = mysqli_fetch_array($records)){

                                                $empid = $data['euid'];

                                                $sqlname = "SELECT uname, deptname from logint where euid='$empid'";
                                                $recordsname = mysqli_query($conn, $sqlname);
                                                $data1 = mysqli_fetch_assoc($recordsname);
                                                $uname = $data1['uname'];
                                                $deptname = $data1['deptname'];

                                                $sqlbio = "SELECT bio from empt where empid ='$empid'";
                                                $recordsdept = mysqli_query($conn, $sqlbio);
                                                $data2 = mysqli_fetch_assoc($recordsdept);
                                                $bio = $data2['bio'];
                                                
                                                $sal_paid = $data['gsalary'];
                                                $bonuspaid = $data['bonus'];
                                                $gdate = $data['gdate'];
                                                $gmonth = $data['month'];
                                                $gyear = $data['year'];

                                                $monthName = date('F', mktime(0, 0, 0, $gmonth, 10));

                                                echo '<tr>
                                                        <th scope="row">'.$n.'</th>
                                                        <td>'.$empid.'</td>
                                                        <td>'.$uname.'</td>
                                                        <td>'.$bio.'</td>
                                                        <td>'.$deptname.'</td>
                                                        <td>'.$sal_paid.'</td>
                                                        <td>'.$bonuspaid.'</td>
                                                        <td>'.$gdate.'</td>
                                                        <td>'.$monthName.'</td>
                                                        <td><a href="invoice-salary.php?empid='.$empid.'&month='.$gmonth.'&year='.$gyear.'" target="_blank"> Receipt </a></td>
                                        
                                                        </tr>';
                                                $n+=1;
                                            }
                                           
                                            /*
                                            echo "<tr>";
                                            echo "<th scope='row'>".'1'."</th>";
                                            echo "<td>".'2'."</td>";
                                            echo "<td>".'DCP'."</td>";
                                            echo "<td>".'Software Engineer'."</td>";
                                            echo "<td>".'Software Development'."</td>";
                                            echo "<td>".'₹'.'15000'."</td>";
                                            echo "<td>".'₹'.'65000'."</td>";
                                            echo "<td>".'01-07-2022'."</td>";
                                            echo '<td><button type="submit" name="idk" class="btn btn-primary">Invoice</button></td>';
                                            echo "</tr>";
                                             */

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
    }
    else{
    ob_start();
    header('Location: '.'../index.php');
    ob_end_flush();
    die();
    }
    ?>

