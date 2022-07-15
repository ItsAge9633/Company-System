<?php
    session_start();
    if ($_SESSION['erole']=="admin"){
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title> RichTech - Project Report</title>
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
                <h1>Project Report</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Save Project Report</li>
                    </ol>
                </nav>
            </div>
            <!-- End Page Title -->
            <section class="section dashboard">
                <div class="card jumbotron container" style="padding-left: 2%; padding-right: 2%">
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <center><h3>Projects</h3></center>
                            <hr>
                            <?php
                                include '../imports/config.php';
                                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                                $sql_query = "SELECT * from clientt where pstatus='Completed'";
                                $records = mysqli_query($conn, $sql_query);
                                
                                echo '<table class="table table-hover">';
                                    echo '<thead class="thead-dark">';
                                        echo '<tr>';
                                        echo '<th scope="col">Project ID</th>';
                                        echo '<th scope="col">Client Name</th>';
                                        echo '<th scope="col">Project Name</th>';
                                        echo '<th scope="col">Description</th>';
                                        echo '<th scope="col">Status</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    
                                    echo '<tbody>';
                                    while($data = mysqli_fetch_array($records)){
                                        $n=$data['Id'];
                                        $cname=$data['cname'];
                                        $pname=$data['pname'];
                                        $desc=$data['descrip'];
                                        $status=$data['pstatus'];

                                        echo '<tr>
                                                <th scope="row">'.$n.'</th>
                                                <td>'.$cname.'</td>
                                                <td>'.$pname.'</td>
                                                <td>'.$desc.'</td>
                                                <td>'.$status.'</td>
                                                </tr>';
                                    }
                                    echo '</tbody>
                                    </table>';
                                ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <center>
                                <h4>Save Project Report</h4>
                            </center>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <center>
                                <h4>Modify Project Report Access</h4>
                            </center>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="post" enctype="multipart/form-data">
                                <center>
                                    <input type="text" class="form-control" name="pid" id="pid" placeholder="Project ID"><br>
                                    <input type="file" class="form-control" name="pdoc" id="pdoc" placeholder="Project Document"><br>
                                    <textarea class="form-control" id="descrip" name="descrip" rows="4"></textarea><br>
                                    <label for="access" class="form-control">Choose Access Permission</label>
                                    <select name="access" class="form-control" id="access">
                                        <option value="private">Private</option>
                                        <option value="public">Public</option>
                                    </select><br>

                                    <input type="submit" name="prsubmit" style="font-size:20px" class="btn btn-outline-primary" value="Save">
                                </center>
                                <br>
                                <br>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="post">
                                <center>
                                    <input type="text" class="form-control" name="upid" id="" placeholder="Project ID"><br>
                                    <label for="uaccess" class="form-control">Choose Access Permission</label>
                                    <select name="uaccess" class="form-control" id="uaccess">
                                        <option value="private">Private</option>
                                        <option value="public">Public</option>
                                    </select><br>

                                    <input type="submit" name="prupdate" style="font-size:20px" class="btn btn-outline-primary" value="Update">
                                </center>
                                <br>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>

                <?php

                    if (isset($_POST['prsubmit'])){

                        include '../imports/config.php';

                        $pid=$_POST['pid'];
                        //$pdoc=$_FILES['pdoc'];
                        $descrip=$_POST['descrip'];
                        $access=$_POST['access'];

                        $fileName = basename($_FILES["pdoc"]["name"]); 
                        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                        
                        // Allow certain file formats 
                        $allowTypes = array('jpg','png','jpeg','gif','txt','pdf'); 
                        if(in_array($fileType, $allowTypes)){ 
                            $image = $_FILES['pdoc']['tmp_name']; 
                            $pdoc = addslashes(file_get_contents($image)); 
                        }

                        $sql_query = "INSERT INTO reportt (pid,doct,descrip,accessp) VALUES ('$pid','$pdoc','$descrip','$access')";
                        $records = mysqli_query($conn, $sql_query);

                    }
                    
                    if (isset($_POST['prupdate'])){
                        include '../imports/config.php';

                        $pid=$_POST['upid'];
                        $access=$_POST['uaccess'];

                        $sql_query = "UPDATE reportt SET accessp='$access' WHERE pid='$pid'";
                        $records = mysqli_query($conn, $sql_query);
                    }

                ?>
                
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