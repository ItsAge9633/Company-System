<?php
    session_start();
    if ($_SESSION['erole']=="admin"){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Employee - RichTech </title>
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
      <h1>Employee</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Add Employee</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section add_cli">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add Employee Details</h5>

          <!-- Vertical Form -->
          <form class="row g-3" action="addEmpBackend.php" method="POST">

          <div class="col-12">
              <label for="uid" class="form-label">Employee ID</label>
              <input type="text" class="form-control" name="euid" id="euid" required="">
            </div>
        
            <div class="col-12">
              <label for="emprole" class="form-label">Employee Role</label>
              <input type="text" class="form-control" name="emprole" id="emprole" required="">
            </div>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Join Date</label>
                <input type="date" class="form-control" id="jdate" name="jdate" placeholder="Date" required="">
            </div>
            
            <div class="col-md-6">

            <?php
              $conn = new mysqli("localhost", "root", "", "autoclick");
              
              echo "<label for='inputState' class='form-label'>Department</label>";
              echo '<select id="deptname" name="deptname" class="form-select">';

              $sqldept = "SELECT * FROM deptt";
              $resultdept = mysqli_query($conn, $sqldept);
              while($rowdept = mysqli_fetch_assoc($resultdept)){
                echo '<option> '.$rowdept['deptname'].' </option>';
              }
              echo '</select>';

            ?>
            </div>

            <div class="col-12">
                <label for="yourUsername" class="form-label">Username</label>
                <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" required="" id="username" name="uname" class="form-control"/>
                <div class="invalid-feedback">Please enter your username.</div>
                </div>
             </div>

             <div class="col-6">
                <label for="yourPassword" class="form-label">Password</label>
                <input type="password" class="form-control" required="" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="pwd"/>
                <div class="invalid-feedback">Please enter your password!</div>
            </div>

            <div class="col-6">
                <label for="yourPassword" class="form-label"> Re-type Password</label>
                <input type="password" class="form-control" required="" id="repassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="repwd"/>
                <div class="invalid-feedback">Please enter your password!</div>
            </div>
            
            <div class="col-12">
              <label for="bsalary" class="form-label">Base Salary (INR)</label>
              <input type="text" class="form-control" name="bsalary" id="bsalary" required="">
            </div>

            <div class="col-6">
              <label for="bankname" class="form-label">Bank Name</label>
              <input type="text" class="form-control" name="bankname" id="bankname" required="">
            </div>

            <div class="col-6">
              <label for="bankacc" class="form-label">Bank Account number</label>
              <input type="text" class="form-control" name="bankacc" id="bankacc" required="">
            </div>

            <br>
            <div class="text-center">
              <button type="submit" name="addempsubmit" class="btn btn-primary">Submit</button>
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
        }
        else{
            ob_start();
            header('Location: '.'../index.php');
            ob_end_flush();
            die();
        }
    
    ?>