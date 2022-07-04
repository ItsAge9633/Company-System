<!--#dde2ec-->
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
      <?php 
            include 'imports/nav-admin.php';
            require ('config.php');
      ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-md-4">
            <div class="card jumbotron container">
            <center>
                <br>
                <form action="showquizdb.php" method="post">
                    <?php
                        $conn=mysqli_connect($server_name,$username,$password,$database_name);

                        $sql_query = "SELECT distinct(quizname) from questions";
                        $records = mysqli_query($conn,$sql_query);
                        $selection = array();
                        while($data = mysqli_fetch_array($records)){
                            array_push($selection,$data['quizname']);
                        }
                        
                        echo '<select name="showquizopt" class="form-select" aria-label="Default select example">';

                        foreach ($selection as $selection) {
                            $selected = ($options == $selection) ? "selected" : "";
                            echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                        }

                        echo '</select>';

                        mysqli_close($conn);
                    ?>
                    <br><br>
                    <input type="submit" name="showquiz" value="Show Quiz" style="font-size:18px" class="btn btn-outline-secondary">
                </form>
                <br>
            </center>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card jumbotron container">
            <center>
                <br>
                <form action="update.php" method="post">
                    <?php         
                        $conn=mysqli_connect($server_name,$username,$password,$database_name);

                        $sql_query = "SELECT distinct(quizname) from questions";
                        $records = mysqli_query($conn,$sql_query);
                        $selection = array();
                        while($data = mysqli_fetch_array($records)){
                            array_push($selection,$data['quizname']);
                        }
                        
                        echo '<select name="updateopt" class="form-select" aria-label="Default select example">';

                        foreach ($selection as $selection) {
                            $selected = ($options == $selection) ? "selected" : "";
                            echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                        }

                        echo '</select>';

                        mysqli_close($conn);
                    ?>
                    <br><br>
                    <input type="submit" name="update" value="Update Quiz" style="font-size:18px" class="btn btn-outline-secondary">
                </form>
                <br>
            </center>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card jumbotron container">
            <center>
            <br>
                <h4>Create a new Quiz</h4><br><br>
                <a href="quizname.php"><input type="button" class="btn btn-outline-secondary" value="Create Quiz" style="font-size:18px"></a>
            </center>
            <br>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card jumbotron container">
            <center>
                <br>
                <form action="activated.php" method="post">
                    <center>
                        <?php
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);

                            $sql_query = "SELECT distinct(quizname) from questions";
                            $records = mysqli_query($conn,$sql_query);
                            $selection = array();
                            while($data = mysqli_fetch_array($records)){
                                array_push($selection,$data['quizname']);
                            }
                            
                            echo '<select name="activateopt" class="form-select" aria-label="Default select example">';

                            foreach ($selection as $selection) {
                                $selected = ($options == $selection) ? "selected" : "";
                                echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                            }

                            echo '</select>';

                            mysqli_close($conn);
                        ?>
                        <br><br>
                        <input type="submit" name="activate" value="Activate Quiz" style="font-size:18px" class="btn btn-outline-secondary">
                    </center>
                    </form>
                <br>
            </center>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card jumbotron container">
            <center>
            <br>
                <h4>Deactivate Quiz</h4><br><br>
                <form action="deactivated.php" method="post">
                    <center>
                        <input type="submit" name="activate" value="Deactivate All Quiz" style="font-size:18px" class="btn btn-outline-secondary">
                    </center>
                    </form>                
            </center>
            <br>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card jumbotron container">
            <center>
                <br>
                <form action="deletequiz.php" method="post">
                <?php
                        $conn=mysqli_connect($server_name,$username,$password,$database_name);

                        $sql_query = "SELECT distinct(quizname) from questions";
                        $records = mysqli_query($conn,$sql_query);
                        $selection = array();
                        while($data = mysqli_fetch_array($records)){
                            array_push($selection,$data['quizname']);
                        }
                        
                        echo '<select name="deleteopt" class="form-select" aria-label="Default select example">';

                        foreach ($selection as $selection) {
                            $selected = ($options == $selection) ? "selected" : "";
                            echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                        }

                        echo '</select>';

                        mysqli_close($conn);
                    ?>
                    <br><br>
                    <input type="submit" name="delete" value="Delete Quiz" style="font-size:18px" class="btn btn-outline-secondary">
                </form>
                <br>
            </center>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card jumbotron container">
            <center>
                <br>
                <form action="temprel.php" method="post">
                    <br>
                    <center>
                        <?php
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);

                            $sql_query = "SELECT distinct(quizname) from questions";
                            $records = mysqli_query($conn,$sql_query);
                            $selection = array();
                            while($data = mysqli_fetch_array($records)){
                                array_push($selection,$data['quizname']);
                            }
                            
                            echo '<select name="resultselect" class="form-select" aria-label="Default select example">';

                            foreach ($selection as $selection) {
                                $selected = ($options == $selection) ? "selected" : "";
                                echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                            }

                            echo '</select>';

                            mysqli_close($conn);
                        ?>
                        <br>
                        <input type="submit" name="showresult" value="Show Result" style="font-size:18px" class="btn btn-outline-secondary">
                    </center>
                    </form>
                <br>
            </center>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card jumbotron container">
            <center><br>
                <form action="settingresult.php" method="post"> 
                    <center>
                        <h5>Student's View</h5>
                        <?php
                            $conn=mysqli_connect($server_name,$username,$password,$database_name);

                            $sql_query = "SELECT distinct(quizname) from questions";
                            $records = mysqli_query($conn,$sql_query);
                            $selection = array();
                            while($data = mysqli_fetch_array($records)){
                                array_push($selection,$data['quizname']);
                            }
                            
                            echo '<select name="studentresultselect" class="form-select" aria-label="Default select example">';

                            foreach ($selection as $selection) {
                                $selected = ($options == $selection) ? "selected" : "";
                                echo '<option '.$selected.' value="'.$selection.'">'.$selection.'</option>';
                            }

                            echo '</select>';

                            mysqli_close($conn);
                        ?>
                        <br>
                        <input type="submit" name="studentshowresult" value="Result Settings" style="font-size:18px" class="btn btn-outline-secondary">
                    </center>
                    </form>
                    <br>
            </center>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card jumbotron container">
            <center>
            <br>
                <h4>Clear Student's Result View</h4><br><br>
                <form action="clearresultview.php" method="post">
                    <input type="submit" name="studentshowresultdelete" value="Clear" style="font-size:18px" class="btn btn-outline-secondary">
                    </form>
            </center>
            <br>
            </div>
        </div>
    </div>

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
            #print("Op");
        }
        else{
            ob_start();
            header('Location: '.'../index.php');
            ob_end_flush();
            die();
        }
    ?>