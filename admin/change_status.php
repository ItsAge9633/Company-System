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
                <h1>Submit Project</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Submit Project</li>
                    </ol>
                </nav>
            </div>
            <!-- End Page Title -->
            <section class="section dashboard">
                <div class="card" style="padding-left: 2%; padding-right: 2%">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <center>
                                <h2>Submit Project Work</h2>
                            </center>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <center>
                                <h2>Projects we are Working on!</h2>
                            </center>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="post">
                                <center>
                                    <input type="text" class="form-control" name="pid" id="" placeholder="Project ID"><br>
                                    <input type="submit" name="psubmit" style="font-size:20px" class="btn btn-outline-primary" value="Next">
                                </center>
                                <br>
                                <br>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <?php
                                include '../imports/config.php';
                                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                                $sql_query = "SELECT * from clientt where pstatus='Working'";
                                $records = mysqli_query($conn, $sql_query);
                                
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
                                ?>
                        </div>
                    </div>
                </div>
                <div class="card" style="padding-left: 2%; padding-right: 2%">
                    <?php
                        if (isset($_POST['psubmit'])){
                            $pid=(int) $_POST['pid'];
                            include '../imports/config.php';
                        
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);
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
                                $pd1=explode(" ",$pdate);
                                $pdate=$pd1[0];
                                $ddate=$data['ddate'];
                                if ($ddate=="0000-00-00"){
                                    $ddate="No Due Date";
                                }else{
                                    $dd1=explode(" ",$ddate);
                                    $ddate=$dd1[0];
                                }
                                $descrip=$data['descrip'];
                                $status=$data['pstatus'];
                            }
                        
                            
                            
                            echo '<br><div>';
                                    echo '<center><h3>'.$cname.' : '.$pname.'</h3><br></center>';
                                    echo '<div class="row">';
                                    echo '<div class="col-md-7">';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-3">';
                                            echo '<p style="color: #111111;">Client ID:</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-9">';
                                            echo '<p style="color: #111111;">'.$cid.'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-3">';
                                            echo '<p style="color: #111111;">Client Name:</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-9">';
                                            echo '<p style="color: #111111;">'.$cname.'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-3">';
                                            echo '<p style="color: #111111;">Project Name:</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-9">';
                                            echo '<p style="color: #111111;">'.$pname.'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-3">';
                                            echo '<p style="color: #111111;">Mobile:</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-9">';
                                            echo '<p style="color: #111111;">'.$mobile.'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-3">';
                                            echo '<p style="color: #111111;">Email:</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-9">';
                                            echo '<p style="color: #111111;">'.$email.'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-3">';
                                            echo '<p style="color: #111111;">Address:</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-9">';
                                            echo '<p style="color: #111111;">'.$address.'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-3">';
                                            echo '<p style="color: #111111;">Assigned Date:</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-9">';
                                            echo '<p style="color: #111111;">'.$pdate.'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-3">';
                                            echo '<p style="color: #111111;">Deadline:</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-9">';
                                            echo '<p style="color: #111111;">'.$ddate.'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-3">';
                                            echo '<p style="color: #111111;">Description:</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-9">';
                                            echo '<p style="color: #111111;">'.$descrip.'</p>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="row">';
                                        echo '<div class="col-md-3">';
                                            echo '<p style="color: #111111;">Status:</p>';
                                        echo '</div>';
                                        echo '<div class="col-md-9">';
                                            echo '<p style="color: #111111;">'.$status.'</p>';
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
                                            
                                            echo '</tbody>
                                                </table>';
                                    echo '</div>';
                        ?>
                    <?php
                        echo '</div>';
                        echo '</div><hr>';
                        ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                    echo '<input type="hidden" class="form-control" name="cid" id="cid" value="'.$cid.'"><br>';
                                    ?>
                                <label for="cdate" class="form-label">Completed date</label>
                                <input type="date" class="form-control" name="cdate" id="cdate" placeholder="yyyy-m-d format"><br>
                                <label for="ccharges" class="form-label">Charges in Number</label>
                                <input type="text" class="form-control" name="ccharges" id="ccharges"><br>
                                <center><input type="submit" class="btn btn-outline-success" value="Submit" name="compsubmit"></center>
                            </div>
                        </div>
                    </form>
                    <?php
                        echo '</div><br>';
                        }
                        ?>
                    <?php
                        if(isset($_POST['compsubmit'])){
                            $cid=$_POST['cid'];
                            $cdate=$_POST['cdate'];
                            $newDate = date("Y-m-d", strtotime($cdate));
                            $cdate=$newDate;
                            $charges=$_POST['ccharges'];
                            /*echo $cid."<br>";
                            echo $cdate."<br>";
                            echo $charges;*/
                        
                            include '../imports/config.php';
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);
                        
                            $sql_query = "UPDATE clientt SET charges=$charges,cdate='$cdate',pstatus='Completed' WHERE Id='$cid'";
                            $records = mysqli_query($conn, $sql_query);
                        
                            $sql_query = "UPDATE workt SET wstatus='Completed' WHERE pid='$cid'";
                            $records = mysqli_query($conn, $sql_query);
                        
                            $sql_query = "UPDATE empt SET wstatus='Free' where empid in (SELECT empid FROM workt WHERE pid='$cid' and wstatus='Completed')";
                            $records = mysqli_query($conn, $sql_query);
                        
                            $sql_query = "UPDATE empt SET wstatus='Working' where empid in (SELECT empid FROM workt WHERE wstatus='Working')";
                            $records = mysqli_query($conn, $sql_query);

                            $sql_query="SELECT pname from clientt WHERE Id='$cid'";
                            $result=mysqli_query($conn,$sql_query);
                            $row=mysqli_fetch_array($result);
                            $pname=$row['pname'];

                            $nmsg="$pname Project Completed!";
                            $sql_query="INSERT into notift (euid,ttype,nmsg,ddate) VALUES ('admin','Project','$nmsg','$cdate')";
                            mysqli_query($conn,$sql_query);
                            
                            echo '<script>alert("Project Completed Successfully")</script>';
                        }
                        ?>
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