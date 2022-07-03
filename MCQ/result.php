<!--#dde2ec-->
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
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
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
            include 'imports/nav-stud.php';
            require ('config.php');
      ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>MCQ Examination</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Results</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card container jumbotron">
        <br><h3>Results</h3><br>
    </div>
    <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "SELECT * from studentresult";
        $records=mysqli_query($conn,$sql_query);

        $flag=0;
        while($data = mysqli_fetch_array($records)){
            $flag=1;
            $qz=$data['quizname'];
            $setting=$data['setting'];
        }
        
        if ($flag==0){
            echo '<div class="card container jumbotron"><br><h4>No Data Available!</h4><br></div>';
        }
        else{
            echo '<div class="card container jumbotron"><br>
            <form action="" method="get">';
            echo '<input type="text" class="form-control" id="roll" name="roll" placeholder="Enter Roll Number">';
            echo '<br><center><input type="submit" name="result" class="btn btn-outline-success" value="Show" style="font-size:20px"></center>';
            echo '</form><br></div>';
        }
        mysqli_close($conn);

    ?>

    <?php
        if (isset($_GET['result']) and ($setting=="Complete Result with Question Evaluation")){
            echo '<div class="card container jumbotron"><br>';
            $roll=$_GET['roll'];

            $conn=mysqli_connect($server_name,$username,$password,$database_name);
        
            $sql_query = "SELECT * from questions where quizname=\"$qz\"";
            $records = mysqli_query($conn,$sql_query);
            $total=mysqli_num_rows($records);

            $sql_query = "SELECT * from student where quizname=\"$qz\" and roll=\"$roll\"";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $email=$data['email'];
                $name=$data['ename'];
                $roll=$data['roll'];
                $mobile=$data['mobile'];
                $marks=$data['marks'];
                $percentage=$data['per'];
                echo "<h5>Name: $name</h5><br>";
                echo "<h5>Roll no: $roll</h5><br>";
                echo "<h5>Email: $email</h5><br>";
                echo "<h5>Mobile Number: $mobile</h5><br>";
                echo "<h5>Marks Scored: $marks</h5><br>";
                echo "<h5>Percentage Scored: $percentage%</h5>";
            }

            echo "<hr><br>";

            $n=1;
            echo '<div class="table-responsive">';
            echo '<table class="table">';
                echo '<thead class="thead-dark">';
                    echo '<tr>';
                    echo '<th scope="col">#</th>';
                    echo '<th scope="col">Question</th>';
                    echo '<th scope="col">Option 1</th>';
                    echo '<th scope="col">Option 2</th>';
                    echo '<th scope="col">Option 3</th>';
                    echo '<th scope="col">Option 4</th>';
                    echo '<th scope="col">Given Answer</th>';
                    echo '<th scope="col">Correct Answer</th>';
                    echo '<th scope="col">Evaluation</th>';
                    echo '</tr>';
                echo '</thead>';
            
            $sql_query = "SELECT * from submission where quizname=\"$qz\" and rollno=\"$roll\"";
            $records = mysqli_query($conn,$sql_query);
            echo '<tbody>';
            while($data = mysqli_fetch_array($records)){
                $q1=$data['ques'];
                $ques=str_replace("\n","<br>",$q1);
                $opt1=$data['opt1'];
                $opt2=$data['opt2'];
                $opt3=$data['opt3'];
                $opt4=$data['opt4'];
                $gans=$data['gans'];
                $cans=$data['cans'];
                $cw=$data['cw'];

                if ($cw=="correct"){
                    $cw1="✔️";
                }
                else{
                    $cw1="❌";
                }
                echo '<tr>
                    <th scope="row">'.$n.'</th>
                    <td>'.$ques.'</td>
                    <td>'.$opt1.'</td>
                    <td>'.$opt2.'</td>
                    <td>'.$opt3.'</td>
                    <td>'.$opt4.'</td>
                    <td>'.$gans.'</td>
                    <td>'.$cans.'</td>
                    <td><center>'.$cw1.'</center></td>
                    </tr>';

                $n+=1;
                
            }
            echo '</tbody>
                </table>';
            echo "</div>";
            echo "</div>";
            echo '<br></div>';
            mysqli_close($conn);
        }
        elseif (isset($_GET['result']) and ($setting=="Show only Marks!")){
            echo '<div class="card container jumbotron"><br>';
            $roll=$_GET['roll'];
            echo '<h4>'.$roll.'</h4>';
            
            $conn=mysqli_connect($server_name,$username,$password,$database_name);

            $sql_query = "SELECT * from questions where quizname=\"$qz\"";
            $records = mysqli_query($conn,$sql_query);
            $total=mysqli_num_rows($records);
        
            $sql_query = "SELECT * from student where quizname=\"$qz\" and roll=\"$roll\"";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $email=$data['email'];
                $name=$data['ename'];
                $roll=$data['roll'];
                $mobile=$data['mobile'];
                $marks=$data['marks'];
                $percentage=$data['per'];

                echo "<h5>Name: $name</h5><br>";
                echo "<h5>Roll no: $roll</h5><br>";
                echo "<h5>Email: $email</h5><br>";
                echo "<h5>Mobile Number: $mobile</h5><br>";
                echo "<h5>Marks Scored: $marks out of $total</h5><br>";
                echo "<h5>Percentage: $percentage%</h5>";
            }

            echo "<hr><br>";

        }
    ?>
    <br></div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

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
