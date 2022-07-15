<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users / Profile - Richtech</title>
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
<?php
error_reporting(0);
?>
<body>
	<?php

		session_start();
    	include '../imports/nav-user.php';        

		if(isset($_SESSION['uname']) and $_SESSION['erole']=="emp"){
			$u=$_SESSION['uname'];
            include '../imports/config.php';
            $conn=mysqli_connect($server_name,$username,$password,$database_name);
            $sql_query = "SELECT * from empt where uname='$u'";
            $records = mysqli_query($conn,$sql_query);

			$empid="";
			$ename="";
			$email="";
			$mobile="";
			$dob="";
			$address="";
			$photo="";
			$cv="";
			$bio="";
			$github="";
			$twitter="";
			$linkedin="";
			$insta="";

			while($data = mysqli_fetch_assoc($records)){
				$empid=$data['empid'];
				$ename=$data['ename'];
				$email=$data['email'];
				$mobile=$data['mobile'];
				$dob=$data['dob'];
				$address=$data['eaddress'];
				$photo=$data['pphoto'];
				$cv=$data['cv'];
				$bio=$data['bio'];
				$github=$data['github'];
				$twitter=$data['twitter'];
				$linkedin=$data['linkedin'];
				$insta=$data['insta'];
			}


			if(true){      
	?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
				<?php
					echo '<img src="data:image/jpg;charset=utf8;base64, '.base64_encode($photo).'" class="rounded-circle" alt="Profile"/>';
					echo '<h2>'.$ename.'</h2>';
					echo '<h3>'.$_SESSION['uname'].'</h3>';
				?>
              
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <!--
              <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>
                  -->

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $ename;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Employee ID</div>
                    <div class="col-lg-9 col-md-8"><?php echo $empid;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email ID</div>
                    <div class="col-lg-9 col-md-8"><?php echo $email;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Mobile Number</div>
                    <div class="col-lg-9 col-md-8"><?php echo $mobile;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">DOB</div>
                    <div class="col-lg-9 col-md-8"><?php echo $dob;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $address;?></div>
                  </div>

				          <div class="row">
                    <div class="col-lg-3 col-md-4 label">Bio</div>
                    <div class="col-lg-9 col-md-8"><?php echo $bio;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Github Profile</div>
                    <div class="col-lg-9 col-md-8"><?php echo $github;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Twitter Profile</div>
                    <div class="col-lg-9 col-md-8"><?php echo $twitter;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">LinkedIn Profile</div>
                    <div class="col-lg-9 col-md-8"><?php echo $linkedin;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Instagram Profile</div>
                    <div class="col-lg-9 col-md-8"><?php echo $insta;?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
					<?php

						$u=$_SESSION['uname'];
						include '../imports/config.php';
						$conn=mysqli_connect($server_name,$username,$password,$database_name);
						$sql_query = "SELECT * from empt where uname='$u'";
						$records = mysqli_query($conn,$sql_query);

						while($data = mysqli_fetch_assoc($records)){
							$empid=$data['empid'];
							$ename=$data['ename'];
							$email=$data['email'];
							$mobile=$data['mobile'];
							$dob=$data['dob'];
							$address=$data['eaddress'];
							$photo=$data['pphoto'];
							$cv=$data['cv'];
							$bio=$data['bio'];
              $github=$data['github'];
              $twitter=$data['twitter'];
              $linkedin=$data['linkedin'];
              $insta=$data['insta'];

              if ($github=="") {
                $github="https://github.com/#";
              }
              if ($twitter=="") {
                $twitter="https://twitter.com/#";
              }
              if ($linkedin=="") {
                $linkedin="https://linkedin.com/#";
              }
              if ($insta=="") {
                $insta="https://instagram.com/#";
              }

						}

						$newDate = date("Y-m-d", strtotime($dob));
						$dob=$newDate;

						if(isset($empid)){
							$_SESSION['new']=False;

					?>
                  <!-- Profile Edit Form -->
                  <form action="save.php" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <?php
                          echo '<img src="data:image/jpg;charset=utf8;base64, '.base64_encode($photo).'" alt="Profile"/>';
                        ?>
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="ename" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="ename" type="text" class="form-control" id="ename" value="<?php echo $ename;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email ID</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" id="email" value="<?php echo $email;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="mobile" class="col-md-4 col-lg-3 col-form-label">Mobile Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="mobile" type="text" class="form-control" id="mobile" value="<?php echo $mobile;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="dob" class="col-md-4 col-lg-3 col-form-label">DOB</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="dob" type="text" class="form-control" id="dob" value="<?php echo $dob;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="address" value="<?php echo $address;?>">
                      </div>
                    </div>

					<?php
						echo '<label class="form-label" for="pp">Profile Photo</label>
						<input type="file" class="form-control" id="pp" name="pp" />';
						echo '<br><label for="bio">Bio</label>
						<textarea class="form-control" id="bio" name="bio" rows="4">'.$bio.'</textarea><br>';
					?>

                    <div class="row mb-3">
                      <label for="github" class="col-md-4 col-lg-3 col-form-label">Github Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="github" type="text" class="form-control" id="github" value="<?php echo $github;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="twitter" value="<?php echo $twitter;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="insta" type="text" class="form-control" id="Instagram" value="<?php echo $insta;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="<?php echo $linkedin;?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="srsubmit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>
				<?php
						}
				?>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action= "emp-pass.php" method="POST">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="changepass" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

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


  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
	<?php
			}
		}
		else{
			ob_start();
            header('Location: '.'../');
            ob_end_flush();
            die();
		}
	?>
</body>

</html>