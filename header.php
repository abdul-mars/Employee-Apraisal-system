<?php
	session_start();
	
	require_once 'dbConnect.php';
	 //include_once 'side_bar.php';
	

	if (isset($_SESSION['email']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && isset($_SESSION['id'])){
		$email = $_SESSION['email'];
		$lastname = $_SESSION['lastname'];
		$firstname = $_SESSION['firstname'];
		$name = $lastname.' '.$firstname;
		$email = $_SESSION['email'];
		$sql = mysqli_query($con, "SELECT * FROM `evaluator_list` WHERE email = '$email'");
		$data = mysqli_fetch_assoc($sql);
		$picture = $data['picture']; ?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
		    <meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			
			<!-- PAGE TITLE HERE -->
			<title>Admin Dashboard</title>
			
			<!-- FAVICONS ICON -->
			<!-- <link rel="shortcut icon" type="image/png" href="images/favicon.png"> -->
			<link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
			<link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
			<link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
			
			<!-- Style css -->
		    <link href="css/style.css" rel="stylesheet">
			
		</head>
		<body>

		    <!--*******************
		        Preloader start
		    ********************-->
		    <!-- <div id="preloader">
				<div class="lds-ripple">
					<div></div>
					<div></div>
				</div>
		    </div> -->
		    <!--*******************
		        Preloader end
		    ********************-->

		    <!--**********************************
		        Main wrapper start
		    ***********************************-->
		    <!-- <div id="main-wrapper"> -->

		        <!--**********************************
		            Nav header start
		        ***********************************-->
				<div class="nav-header">
		            <a href="index.php" class="brand-logo">
						<!-- <svg class="logo-abbr" width="55" height="55" viewbox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg"> -->
							<!-- <path fill-rule="evenodd" clip-rule="evenodd" d="M27.5 0C12.3122 0 0 12.3122 0 27.5C0 42.6878 12.3122 55 27.5 55C42.6878 55 55 42.6878 55 27.5C55 12.3122 42.6878 0 27.5 0ZM28.0092 46H19L19.0001 34.9784L19 27.5803V24.4779C19 14.3752 24.0922 10 35.3733 10V17.5571C29.8894 17.5571 28.0092 19.4663 28.0092 24.4779V27.5803H36V34.9784H28.0092V46Z" fill="url(#paint0_linear)"></path> -->
							<!-- <defs>
							</defs> -->
						<!-- </svg> -->
						<div class="brand-title">
							<h2 class="">Appraisal</h2>
							<span class="brand-sub-title"><?= $email; ?></span>
						</div>
		            </a>
		            <div class="nav-control">
		                <div class="hamburger">
		                    <span class="line"></span><span class="line"></span><span class="line"></span>
		                </div>
		            </div>
		        </div>
		            <!-- Nav header end -->
				
				
				<!--**********************************
		            Header start
		        ***********************************-->
		        <div class="header border-bottom">
		            <div class="header-content">
		                <nav class="navbar navbar-expand">
		                    <div class="collapse navbar-collapse justify-content-between">
		                        <div class="header-left">
									<div class="dashboard_bar">
		                                Dashboard
		                            </div>
		                        </div>
		                        <ul class="navbar-nav header-right">
									
									<!-- user profile  -->
									<li class="nav-item dropdown  header-profile">
										<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
											<img src="<?= $picture; ?>" width="56" alt="">
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<a href="profile.php" class="dropdown-item ai-icon">
												<!-- <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> -->
												<span class="ms-2">Profile </span>
											</a>
											<a href="logout.php?operation=admin_logout" class="dropdown-item ai-icon">
												<span class="ms-2">Logout </span>
											</a>
										</div>
									</li>
		                        </ul>
		                    </div>
						</nav>
					</div>
				</div>
		        <!--**********************************
		            Header end ti-comment-alt
		        ***********************************-->
	<?php } else {
		header("location: login.php");
		}
