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
          <li class="breadcrumb-item active">Add Client</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section add_cli">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add Client Details</h5>

          <!-- Vertical Form -->
          <form class="row g-3" action="savec.php" method="POST">
            <div class="col-12">
              <label for="cname" class="form-label">Company Name</label>
              <input type="text" class="form-control" name="cname" id="cname" required>
            </div>
            <div class="col-12">
              <label for="pname" class="form-label">Project Name</label>
              <input type="text" class="form-control" name="pname" id="pname">
            </div>
            <div class="col-12">
              <label for="mobile" class="form-label">Mobile Number</label>
              <input type="text" class="form-control" name="mobile" id="mobile">
            </div>
            <div class="col-12">
              <label for="email" class="form-label">Email ID</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="col-6">
              <label for="pdate" class="form-label">Assign Date </label>
              <input type="date" class="form-control" name="pdate" id="pdate">
            </div>
            <div class="col-6">
              <label for="ddate" class="form-label">Due Date </label>
              <input type="date" class="form-control" name="ddate" id="ddate">
            </div>
            </center>
                <br><label for="descrip">Description</label>
            <center>
                <textarea class="form-control" id="descrip" name="descrip" rows="4"></textarea><br>
            <div class="text-center">
              <button type="submit" name="crsubmit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- Vertical Form -->

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