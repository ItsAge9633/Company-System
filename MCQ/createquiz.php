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
          <li class="breadcrumb-item active">Create Quiz</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card jumbotron container">
        <br>
        <?php
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
            $sql_query = "SELECT quizname from activequiznames";
            $records = mysqli_query($conn,$sql_query);
            while($data = mysqli_fetch_array($records)){
                $qn=$data['quizname'];
                echo "<h4> Put Questions for $qn!</h4>";
            }
        ?>
        
        <p>Type out the Questions and the Options. Select the radio button which have correct answer!</p>
        <p></p>
    </div>
    <br>

    <script>
        num=0
    </script>

    <div class="card container jumbotron">
        <form action="savequiz.php" method="post">
            <input type="hidden" id="quesno" name="quesno" value='0'>
            <div id="textboxDiv" style="padding-left: 50px; padding-right: 50px; padding-top: 25px">
                
            </div>
            <br>
            <center>
                <input type="submit" name="save" value="Submit" style="font-size:20px" class="btn btn-outline-success">
            </center>
        </form>
        <br>
        <div>
            <center>
                <button id="Add" class="btn btn-secondary">Add a Question</button> 
                <button id="Remove" class="btn btn-secondary">Delete Last Question</button>
            </center>
        </div>
        <br>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <script>  
        $(document).ready(function() {  
            $("#Add").on("click", function() { 
                w="text"+num
                w1="radio"+num
                w2="radiotext"+num
                num+=1 
                //$("#textboxDiv").append("<div><br><input type='text' class='form-control' placeholder='Question " + (num) + "' id='" + w + "' name='" + w + "'/><br></div>");
                //<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                $("#textboxDiv").append('<div><br><textarea class="form-control" id="'+w+'" name='+w+' rows="3"></textarea><br></div>');
                
                $("#textboxDiv").append("<table><tr><td><div><br><input type='radio' id='" + w1+'1' + "' name='" + w1 + "' value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' placeholder='Option 1' id='" + w2+'1' + "' name='" + w2+'1' + "'/></div></td></tr></table>");
                $("#textboxDiv").append("<br>")
                $("#textboxDiv").append("<table><tr><td><div><br><input type='radio' id='" + w1+'2' + "' name='" + w1 + "' value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' placeholder='Option 2' id='" + w2+'2' + "' name='" + w2+'2' + "'/></div></td></tr></table>");
                $("#textboxDiv").append("<br>")
                $("#textboxDiv").append("<table><tr><td><div><br><input type='radio' id='" + w1+'3' + "' name='" + w1 + "' value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' placeholder='Option 3' id='" + w2+'3' + "' name='" + w2+'3' + "'/></div></td></tr></table>");
                $("#textboxDiv").append("<br>")
                $("#textboxDiv").append("<table><tr><td><div><br><input type='radio' id='" + w1+'4' + "' name='" + w1 + "' value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' placeholder='Option 4' id='" + w2+'4' + "' name='" + w2+'4' + "'/></div></td></tr></table>");
                $("#textboxDiv").append("<hr>")
                document.getElementById("quesno").value=num
            });  
            $("#Remove").on("click", function() {  
                
                console.log(num)
                if (num>0){
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    $("#textboxDiv").children().last().remove();
                    num-=1
                    document.getElementById("quesno").value=num
                }
            });  
        });  
    </script>
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