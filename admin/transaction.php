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
                <h1><a href="transaction.php">Finance Transaction</a></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="transaction.php">Finance</a></li>
                    </ol>
                </nav>
            </div>
            <!-- End Page Title -->
            <section class="section">
                <div id="input" name="input" class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tranasaction Entry</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container jumbotron">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="payment_date">Payment Date</label>
                                            <input type="date" class="form-control" id="payment_date" name="payment_date" placeholder="Enter Payment Date">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="ffrom">From</label>
                                            <input type="text" class="form-control" id="ffrom" name="ffrom" placeholder="From (Debitor)">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="tto">To</label>
                                            <input type="text" class="form-control" id="tto" name="tto" placeholder="To (Creditor)">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
                                        </div>
                                        <br>
                                        <!--Combobox for Department names-->
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <select class="form-control" id="department" name="department">
                                            <?php
                                                include '../imports/config.php';
                                                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                                                
                                                $sql = "SELECT * FROM deptt";
                                                $result = mysqli_query($conn, $sql);
                                                while($row = mysqli_fetch_assoc($result)){
                                                    echo "<option value='".$row['deptname']."'>".$row['deptname']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="payment_details">Payment Details</label>
                                            <input type="text" class="form-control" id="payment_details" name="payment_details" placeholder="Enter Payment Details">
                                        </div>
                                        <br>
                                        <center><button type="submit" name="payment_entry" class="btn btn-primary">Submit</button></center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
                if (isset($_POST['payment_entry'])){
                	$ffrom = $_POST['ffrom'];
                	$tto = $_POST['tto'];
                	$amount = $_POST['amount'];
                	$department = $_POST['department'];
                
                	$payment_date = $_POST['payment_date'];
                	$a=explode("-",$payment_date);
                	$payment_date=$a[2]."-".$a[1]."-".$a[0];
                    $payment_date = date("Y-m-d", strtotime($payment_date));
                
                	$payment_details = $_POST['payment_details'];
                
                
                	$sql_query = "INSERT INTO financet (ddate,ffrom,tto,amt,narration,deptname) VALUES ('$payment_date','$ffrom','$tto','$amount','$payment_details','$department')";
                
                	if(mysqli_query($conn, $sql_query)){
                		echo '<script>alert("Payment Successful")</script>';
                		echo '<script>window.location.href="transaction.php"</script>';
                	}
                	else{
                		echo '<script>alert("Payment Failed")</script>';
                		echo '<script>window.location.href="transaction.php"</script>';
                	}

					$nmsg="Payment of Rs. ".$amount." has been made from ".$ffrom." to ".$tto.". Details: ".$payment_details;
					$sql_query="INSERT into notift (euid,ttype,nmsg,ddate) VALUES ('admin','Expenses','$nmsg','$payment_date')";
                    mysqli_query($conn,$sql_query);
                
                	mysqli_close($conn);
                } 
                  ?>
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
    //print("Op");
    }
    else{
    ob_start();
    header('Location: '.'../index.php');
    ob_end_flush();
    die();
    }
    ?>