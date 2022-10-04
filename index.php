<?php //include 'header2.php'; ?>
<?php include 'header.php'; ?>
<?php include 'side_bar.php'; ?>
<?php ob_start();
	// $host = 'localhost';
	// $user = 'root';
	// $password = '';
	// $dbName = 'appraisal';

	// $con = mysqli_connect($host, $user, $password, $dbName) or die('Error');
?>

<title>Admin Dashboard</title>
			
			<!-- FAVICONS ICON -->
			<!-- <link rel="shortcut icon" type="image/png" href="images/favicon.png">
			<link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
			<link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
			<link rel="stylesheet" href="vendor/nouislider/nouislider.min.css"> -->
			
			<!-- Style css -->
		    <!-- <link href="css/style.css" rel="stylesheet"> -->
		

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								<div class="row">
									<div class="col-xl-6 col-sm-6">
										<a href="departments.php">
											<div class="card">
												<div class="card-body d-flex px-4 pb-0 justify-content-between">
													<div class="row">
														<div class="col-6">
															<h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Departments</h4>
															<div class="d-flex align-items-center">
																<?php $sql = mysqli_query($con, "SELECT * FROM `department_list`");
																	$departNo = mysqli_num_rows($sql);
																?>
																<h2 class="fs-32 font-w700 mb-0"><?= $departNo; ?></h2>
																
															</div>
														</div>
														<div class="col-6">
															<div class="row">
																<div class="col-8"></div>
																<div class="col-4">
																	<div class="d-flex px-4 mt-1 text-center justify-content-between align-items-center">
																	<i class="fas fa-list fa-5x text-muted"></i>
															</div>
																</div>
																<!-- <div class="col-4"></div> -->
															</div>
															
														</div>
													</div>
													<!-- <div id="columnChart"></div> -->
												</div>
											</div>
										</a>
									</div>
									<div class="col-xl-6 col-sm-6">
										<a href="designations.php">
											<div class="card">
												<div class="card-body d-flex px-4 pb justify-content-between">
													<div class="col-6">
														<h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Designations</h4>
														<div class="d-flex align-items-center">
														<?php $sql = mysqli_query($con, "SELECT * FROM `designation_list`");
															$designNo = mysqli_num_rows($sql);
														?>
															<h2 class="fs-32 font-w700 mb-0"><?= $designNo; ?></h2>
														</div>
													</div>
													<div class="col-6">
														<div class="row">
															<div class="col-6"></div>
															<div class="col-4">
																<div class="d-flex px-4 mt-1 text-center justify-content-between align-items-center">
																	<i class="nav-icon fas fa-list-alt fa-5x text-muted"></i>
																</div>
															</div>
															<!-- <div class="col-4"></div> -->
														</div>
														
													</div>
												</div>
											</div>
										</a>	
									</div>
									<div class="col-xl-6 col-sm-6">
										<a href="Employees.php">
											<div class="card">
												<div class="card-body d-flex px-4 pb-0 justify-content-between">
													<div class="col-6">
														<h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Employees</h4>
														<div class="d-flex align-items-center">
															<?php $sql = mysqli_query($con, "SELECT * FROM `employee_list`");
																$empNo = mysqli_num_rows($sql);
															?>
															<h2 class="fs-32 font-w700 mb-"><?= $empNo; ?></h2>
															
														</div>
													</div>
													<div class="col-6">
														<div class="row">
															<div class="col-6"></div>
															<div class="col-4">
																<div class="d-flex px-4 mt-1 text-center justify-content-between align-items-center">
																	<i class="nav-icon fas fa-user-friends fa-5x text-muted"></i>
																</div>
															</div>
															<!-- <div class="col-4"></div> -->
														</div>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="col-xl-6 col-sm-6">
										<a href="evaluators.php">
											<div class="card">
												<div class="card-body d-flex px-4 pb-0 justify-content-between">
													<div class="col-6">
														<h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Evaluators</h4>
														<div class="d-flex align-items-center">
															<?php $sql = mysqli_query($con, "SELECT * FROM `evaluator_list`");
																$evaluatorNo = mysqli_num_rows($sql);
															?>
															<h2 class="fs-32 font-w700 mb-"><?= $evaluatorNo; ?></h2>
															
														</div>
													</div>
													<div class="col-6">
														<div class="row">
															<div class="col-6"></div>
															<div class="col-4">
																<div class="d-flex px-4 mt-1 text-center justify-content-between align-items-center">
																	<i class="fas fa-user-graduate fa-5x text-muted"></i>
																</div>
															</div>
															<!-- <div class="col-4"></div> -->
														</div>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="col-xl-6 col-sm-6">
										<a href="tasks.php">
											<div class="card">
												<div class="card-body d-flex px-4 pb-0 justify-content-between">
													<div class="col-6">
														<h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Tasks</h4>
														<div class="d-flex align-items-center">
															<?php $sql = mysqli_query($con, "SELECT * FROM `task_list`");
																$taskNo = mysqli_num_rows($sql);
															?>
															<h2 class="fs-32 font-w700 mb-"><?= $taskNo; ?></h2>
															
														</div>
													</div>
													<div class="col-6">
														<div class="row">
															<div class="col-6"></div>
															<div class="col-4">
																<div class="d-flex px-4 mt-1 text-center justify-content-between align-items-center">
																	<i class="nav-icon fas fa-tasks fa-5x text-muted"></i>
																</div>
															</div>
															<!-- <div class="col-4"></div> -->
														</div>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="col-xl-6 col-sm-6">
										<a href="evaluation.php">
											<div class="card">
												<div class="card-body d-flex px-4 pb-0 justify-content-between">
													<div class="col-6">
														<h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Evaluations</h4>
														<div class="d-flex align-items-center">
															<?php $sql = mysqli_query($con, "SELECT * FROM `ratings`");
																$evaluationNo = mysqli_num_rows($sql);
															?>
															<h2 class="fs-32 font-w700 mb-"><?= $evaluationNo; ?></h2>
															
														</div>
													</div>
													<div class="col-6">
														<div class="row">
															<div class="col-6"></div>
															<div class="col-4">
																<div class="d-flex px-4 mt-1 text-center justify-content-between align-items-center">
																	<i class="far fa-edit fa-5x text-muted"></i>
																</div>
															</div>
															<!-- <div class="col-4"></div> -->
														</div>
													</div>
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->
		


		
       <?php include 'footer.php'; ?>