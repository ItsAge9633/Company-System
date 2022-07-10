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
      <h1><a href="payment.php">Payment</a></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="payment.php">Payment from Client</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">

      <div id="input" name="input" class="card">
        <div class="card-body">
          <h5 class="card-title">Client Payment</h5>

            <div class="row">
                <div class="col-md-6">
                    <div class="container jumbotron">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="client_id">Client ID</label>
                            <input type="text" class="form-control" id="client_id" name="client_id" placeholder="Enter Client ID">
                        </div><br>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
                        </div><br>
                        <div class="form-group">
                            <label for="payment_date">Payment Date</label>
                            <input type="date" class="form-control" id="payment_date" name="payment_date" placeholder="Enter Payment Date">
                        </div><br>
                        <div class="form-group">
                            <label for="payment_details">Payment Details</label>
                            <input type="text" class="form-control" id="payment_details" name="payment_details" placeholder="Enter Payment Details">
                        </div><br>
                        <center><button type="submit" name="payment_entry" class="btn btn-primary">Submit</button></center>
                    </form>
                    </div>
                </div>
                
                <div class="col-md-6">
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
                                    echo '<th scope="col">#</th>';
                                    echo '<th scope="col">ID</th>';
                                    echo '<th scope="col">Client Name</th>';
                                    echo '<th scope="col">Project Name</th>';
                                    echo '<th scope="col">Completed Date</th>';
                                    echo '<th scope="col">Charges</th>';
                                    echo '</tr>';
                                echo '</thead>';
                
                                echo '<tbody>';
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
                                echo '</tbody>
                                </table>';
                            echo '</div>';
                    
                            mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>

        </div>
      </div>

    </section>

    <?php
		if (isset($_POST['payment_entry'])){
			$client_id = $_POST['client_id'];
			$amount = $_POST['amount'];
			$payment_date = $_POST['payment_date'];
			$a=explode("-",$payment_date);
			$payment_date=$a[2]."-".$a[1]."-".$a[0];
      $payment_date = date("Y-m-d", strtotime($payment_date));

			$payment_details = $_POST['payment_details'];

			include '../imports/config.php';
			$conn=mysqli_connect($server_name,$username,$password,$database_name);

			$sql_query = "UPDATE clientt SET received='$payment_date' WHERE Id='$client_id'";
			mysqli_query($conn, $sql_query);

			$sql_query = "INSERT INTO financet (ddate,ffrom,tto,amt,narration,deptname) VALUES ('$payment_date','$client_id','Company','$amount','$payment_details','Project')";

			if(mysqli_query($conn, $sql_query)){
				echo '<script>alert("Payment Successful")</script>';
				echo '<script>window.location.href="payment.php"</script>';
			}
			else{
				echo '<script>alert("Payment Failed")</script>';
				echo '<script>window.location.href="payment.php"</script>';
			}

      $sql_query="SELECT * from clientt WHERE Id='$client_id'";
      $result=mysqli_query($conn,$sql_query);
      $row=mysqli_fetch_array($result);
      $pname=$row['pname'];
      $cname=$row['cname'];

      $nmsg="Payment of Rs. ".$amount." received from Client ".$cname." for Project ".$pname."." ;
      $sql_query="INSERT into notift (euid,ttype,nmsg,ddate) VALUES ('admin','Payment','$nmsg','$payment_date')";
      mysqli_query($conn,$sql_query);

			mysqli_close($conn);
		} 
    ?>

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