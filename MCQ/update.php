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
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <?php
        require ('config.php');
    ?>
    <br>

    <div class="card jumbotron container">
        <br>
        <?php
            $conn=mysqli_connect($server_name,$username,$password,$database_name);

            if(isset($_POST['update'])){
                $qn=$_POST['updateopt'];
                
            }
            echo "<h4> Update Quiz $qn!</h4>";
        ?>
        
        <p>Type out the Questions and the Options. Select the radio button which have correct answer!</p>
        <p></p>
    </div>
    <br>

    <script>
        num=0
    </script>

    <div class="card container jumbotron">
        <br>
        <form action="updatequiz.php" method="post">
            <div id="textboxDiv" style="padding-left: 50px; padding-right: 50px; padding-top: 25px">
                <?php
                    $conn=mysqli_connect($server_name,$username,$password,$database_name);
                    $num=0;
                    
                    $sql_query = "SELECT * from questions where quizname='$qn'";
                    $records = mysqli_query($conn,$sql_query);
                    while($data = mysqli_fetch_array($records)){
                        $q=$data['question'];
                        $opt1=$data['opt1'];
                        $opt2=$data['opt2'];
                        $opt3=$data['opt3'];
                        $opt4=$data['opt4'];
                        $ans =$data['ans'];
                        
                        $w="text".$num;
                        $w1="radio".$num;
                        $w2="radiotext".$num;

                        if ($ans==$opt1){
                            //echo "<div><br><input type='text' class='form-control' value='$q' id='$w' name='$w'/><br></div>";
                            echo '<div><br><textarea class="form-control" id="'.$w.'" name='.$w.' rows="3">'.$q.'</textarea><br></div>';
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' checked=checked value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt1' id='".$w2.'1'."' name='".$w2.'1'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt2' id='".$w2.'2'."' name='".$w2.'2'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt3' id='".$w2.'3'."' name='".$w2.'3'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt4' id='".$w2.'4'."' name='".$w2.'4'."'/></div></td></tr></table>";
                        }
                        elseif($ans==$opt2){
                            //echo "<div><br><input type='text' class='form-control' value='$q' id='$w' name='$w'/><br></div>";
                            echo '<div><br><textarea class="form-control" id="'.$w.'" name='.$w.' rows="3">'.$q.'</textarea><br></div>';
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt1' id='".$w2.'1'."' name='".$w2.'1'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' checked=checked  value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt2' id='".$w2.'2'."' name='".$w2.'2'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt3' id='".$w2.'3'."' name='".$w2.'3'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt4' id='".$w2.'4'."' name='".$w2.'4'."'/></div></td></tr></table>";
                        }
                        elseif($ans==$opt3){
                            //echo "<div><br><input type='text' class='form-control' value='$q' id='$w' name='$w'/><br></div>";
                            echo '<div><br><textarea class="form-control" id="'.$w.'" name='.$w.' rows="3">'.$q.'</textarea><br></div>';
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt1' id='".$w2.'1'."' name='".$w2.'1'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt2' id='".$w2.'2'."' name='".$w2.'2'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' checked=checked  value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt3' id='".$w2.'3'."' name='".$w2.'3'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt4' id='".$w2.'4'."' name='".$w2.'4'."'/></div></td></tr></table>";
                        }
                        elseif($ans==$opt4){
                            //echo "<div><br><input type='text' class='form-control' value='$q' id='$w' name='$w'/><br></div>";
                            echo '<div><br><textarea class="form-control" id="'.$w.'" name='.$w.' rows="3">'.$q.'</textarea><br></div>';
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt1' id='".$w2.'1'."' name='".$w2.'1'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt2' id='".$w2.'2'."' name='".$w2.'2'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt3' id='".$w2.'3'."' name='".$w2.'3'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' checked=checked  value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt4' id='".$w2.'4'."' name='".$w2.'4'."'/></div></td></tr></table>";
                        }
                        else{
                            //echo "<div><br><input type='text' class='form-control' value='$q' id='$w' name='$w'/><br></div>";
                            echo '<div><br><textarea class="form-control" id="'.$w.'" name='.$w.' rows="3">'.$q.'</textarea><br></div>';
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='1'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt1' id='".$w2.'1'."' name='".$w2.'1'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='2'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt2' id='".$w2.'2'."' name='".$w2.'2'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='3'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt3' id='".$w2.'3'."' name='".$w2.'3'."'/></div></td></tr></table>";
                            echo "<table><tr><td><div><br><input type='radio' id='$w1' name='$w1' value='4'/></div></td><td width=98.5%><div><input type='text' class='form-control' value='$opt4' id='".$w2.'4'."' name='".$w2.'4'."'/></div></td></tr></table>";
                        }

                        $num=$num+1;
                    }
                    echo '<input type="hidden" id="quesno" name="quesno" value='.$num.'>';
                    echo '<input type="hidden" id="quiznameforupdate" name="quiznameforupdate" value="'.$qn.'">';
                ?>
                
            
                
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
                num=parseInt(document.getElementById("quesno").value)
                w="text"+num
                w1="radio"+num
                w2="radiotext"+num
                num+=1
                $("#textboxDiv").append('<div><br><textarea class="form-control" id="'+w+'" name='+w+' rows="3"></textarea><br></div>');
                //$("#textboxDiv").append("<div><br><input type='text' class='form-control' placeholder='Question " + (num) + "' id='" + w + "' name='" + w + "'/><br></div>");
                
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
                num=parseInt(document.getElementById("quesno").value)
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









































