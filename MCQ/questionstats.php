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
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">

  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>

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
          <li class="breadcrumb-item active">Complete Results</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <nav class="navbar navbar-light navbar-expand-md">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <div class="row">
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="allresult.php" style="color:black">Complete Result</a></li></center>
                        </div>
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="studresult.php" style="color:black">Student Result</a></li></center>
                        </div>
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="questionstats.php" style="color:black">Question Stats</a></li></center>
                        </div>
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="graph.php" style="color:black">Graphical View</a></li></center>
                        </div>
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="studnots.php" style="color:black">Not Submitted</a></li></center>
                        </div>
                        <div class="card container jumbotron col-md-2" style="margin:0px">
                            <center><li class="nav-item"><a class="nav-link" href="malicious.php" style="color:black">Malicious Activity</a></li></center>
                        </div>
                    </div>
                    <!--<li class="nav-item"><a class="nav-link active" href="dashboard.php" style="color:black">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="allresult.php" style="color:black">Complete Result</a></li>
                    <li class="nav-item"><a class="nav-link" href="studresult.php" style="color:black">Student Result</a></li>
                    <li class="nav-item"><a class="nav-link" href="questionstats.php" style="color:black">Question Stats</a></li>
                    <li class="nav-item"><a class="nav-link" href="graph.php" style="color:black">Graphical View</a></li>
                    <li class="nav-item"><a class="nav-link" href="studnots.php" style="color:black">Not Submitted</a></li>
                    <li class="nav-item"><a class="nav-link" href="malicious.php" style="color:black">Malicious Activity</a></li>-->
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <form action="" method="post">
        <?php
            if (isset($_POST['quesresult'])){
                echo '<div class="card container jumbotron form-group"><br>';
                $quesno=intval($_POST['quesno'])-1;
                $d='text'.$quesno;
                $ques1=$_POST[$d];

                $ques=str_replace("'","\'",$ques1);
                $count = substr_count($ques1, "\n") + 2;
                echo "<center><h2> Question Stats </h2></center>";
                echo "<div><br><textarea rows='$count' class='form-control' disabled>$ques1</textarea></div>";

                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                $sql_query = "SELECT quizname from tempresult";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $qz=$data['quizname'];
                }

                $sql_query = "SELECT ans from questions where quizname='$qz' and question='$ques'";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $cans=$data['ans'];
                }
                echo "<br>Correct Answer: $cans<br>";
                
                $nc=1;
                $sql_query = "SELECT * from submission where quizname='$qz' and ques='$ques' and cw='correct'";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $roll=$data['rollno'];
                    $name=$data['email'];

                    $nc+=1;
                }

            

                $sql_query = "SELECT quizname from tempresult";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $qz=$data['quizname'];
                }

                //echo "<div class='row'><div class='col-md-6>";
            
                $nw=1;
                $sql_query = "SELECT * from submission where quizname='$qz' and ques='$ques' and cw='wrong'";
                $records = mysqli_query($conn,$sql_query);
                while($data = mysqli_fetch_array($records)){
                    $roll=$data['rollno'];
                    $name=$data['email'];

                    $nw+=1;
                }

                echo '<br></div>';
                mysqli_close($conn);
            }
        ?>
    </form>
    </div>
    </div>

    <div class="card container jumbotron">
    <br>
    <canvas id="graph" width="400" height="150"></canvas>
    <script>
        <?php
            if (isset($_POST['quesresult'])){
                $conn=mysqli_connect($server_name,$username,$password,$database_name);

                echo "const ctx = document.getElementById('graph').getContext('2d');";
                echo "const myChart = new Chart(ctx, {";
                    echo "type: 'bar',";
                    echo "data: {";
                        echo "labels: ['Correct', 'Wrong',],";
                        echo "datasets: [{";
                            echo "label: 'Number of Students',";
                            echo "data: [$nc,$nw],";
                            echo "backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                            ],
                            borderWidth: 1
                        }]";
                    echo "},";
                    echo "options: {";
                        echo "scales: {";
                            echo "y: {";
                                echo "beginAtZero: true";
                                echo "}
                        }
                    }
                });";
                mysqli_close($conn);
            }
        ?>
        </script>
        <br>
    </div>   
        
    <form action="" method="post">
        <?php

        if (isset($_POST['quesresult'])){
            echo '<div class="card container jumbotron form-group"><br>';
            $quesno=intval($_POST['quesno'])-1;
            $d='text'.$quesno;
            $ques1=$_POST[$d];

            $ques=str_replace("'","\'",$ques1);
            $count = substr_count($ques1, "\n") + 2;

            $conn=mysqli_connect($server_name,$username,$password,$database_name);

            $sql_query = "SELECT quizname from tempresult";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $qz=$data['quizname'];
            }

            $sql_query = "SELECT ans from questions where quizname='$qz' and question='$ques'";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $cans=$data['ans'];
            }

            echo '<div class="row">';
            
            echo '<div class="col-md-6">';
            echo '<br><center><h4>Studnets gave Correct Answer</h4></center><hr>';

            //echo "<div class='row'><div class='col-md-6>";
            echo '<br><div class="table-responsive">';
                echo '<table class="table">';
                    echo '<thead class="thead-dark">';
                        echo '<tr>';
                        echo '<th scope="col">#</th>';
                        echo '<th scope="col">Roll No.</th>';
                        echo '<th scope="col">Name</th>';
                        echo '</tr>';
                    echo '</thead>';
                
            
            echo '<tbody>';
            $nc=1;
            $sql_query = "SELECT * from submission where quizname='$qz' and ques='$ques' and cw='correct'";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $roll=$data['rollno'];
                $name=$data['email'];
                echo '<tr>';
                echo '<th scope="row">'.$nc.'</th>';
                echo '<td>'.$roll.'</td>';
                echo '<td>'.$name.'</td>';
                echo '<tr>';
                $nc+=1;
            }

            echo '</table>';
            echo '</div><br></div>';

            echo '<div class="col-md-6">';
            echo '<br><center><h4>Studnets gave Wrong Answer</h4></center><hr>';

            $sql_query = "SELECT quizname from tempresult";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $qz=$data['quizname'];
            }

            //echo "<div class='row'><div class='col-md-6>";
            echo '<br><div class="table-responsive">';
                echo '<table class="table">';
                    echo '<thead class="thead-dark">';
                        echo '<tr>';
                        echo '<th scope="col">#</th>';
                        echo '<th scope="col">Roll No.</th>';
                        echo '<th scope="col">Name</th>';
                        echo '</tr>';
                    echo '</thead>';
                
            
            echo '<tbody>';
            $nw=1;
            $sql_query = "SELECT * from submission where quizname='$qz' and ques='$ques' and cw='wrong'";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $roll=$data['rollno'];
                $name=$data['email'];
                echo '<tr>';
                echo '<th scope="row">'.$nw.'</th>';
                echo '<td>'.$roll.'</td>';
                echo '<td>'.$name.'</td>';
                echo '<tr>';
                $nw+=1;
            }

            echo '</table>';
            echo '</div></div>';

            mysqli_close($conn);
            echo '<br></div>';
        }

        ?>
    </form>
    </div>
    </div>
    
    <br>
    <div class="card jumbotron container">
        <br>
        <?php
        $conn=mysqli_connect($server_name,$username,$password,$database_name);

        $sql_query = "SELECT quizname from tempresult";
        $records = mysqli_query($conn,$sql_query);
        while($data = mysqli_fetch_array($records)){
            $qz=$data['quizname'];
        }
        
        echo "<center><h1>Question Wise Stats of ".$qz."</h1></center>";
        mysqli_close($conn);
        ?>
        <br>
    </div>

    <div class="card container jumbotron">
        <br>
    <form action="" method="post" class="form-group">
        <?php
            $selection=array();
            $sn=array();
            $num=0;
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
            $sql_query = "SELECT * from questions where quizname='$qz'";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $q=$data['question'];
                $q2=str_replace("\n","<br>",$q);
                $q1=str_replace("    ","&emsp;",$q2);
                $opt1=$data['opt1'];
                $opt2=$data['opt2'];
                $opt3=$data['opt3'];
                $opt4=$data['opt4'];
                
                $w="text".$num;
                $w1="radio".$num;
                $w11="radio".$num."1";
                $w12="radio".$num."2";
                $w13="radio".$num."3";
                $w14="radio".$num."4";
                $w2="radiotext".$num;

                $t1="opt".$num."1";
                $t2="opt".$num."2";
                $t3="opt".$num."3";
                $t4="opt".$num."4";

                echo "<div><br><textarea style='display: none;' id='$w' name='$w' rows='3'>$q</textarea></div>";
                
                $heynum=$num+1;
                echo "<div><p>$heynum.)&ensp;$q1 </p></div>";

                echo "<hr>";
                $num=$num+1;
            }
            echo "<hr>";
            echo 'Select Question Number:-<br><br><select name="quesno" class="form-select forselect" aria-label="Default select example" style="width: 90%;">';
            $n1=0;
            while ($n1<$num) {
                $n1+=1;
                $selected = ($options == $n1) ? "selected" : "";
                echo '<option '.$selected.' value="'.$n1.'">'.$n1.'</option>';
            }
            echo '</select><br><br>';
        ?>
        <center><input type="submit" name="quesresult" value="Question Stats" style="font-size:20px" class="btn btn-outline-success"></center>
    </form>
    <br>
    </div>

    <br><br>
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