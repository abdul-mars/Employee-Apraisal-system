<?php session_start(); error_reporting(0);
	require_once 'dbConnect.php';
	// include_once 'header2.php';
	if (isset($_SESSION['email']) && isset($_SESSION['lastname']) && isset($_SESSION['firstname']) && isset($_SESSION['id'])) {
		$email = $_SESSION['email'];
		$lastname = $_SESSION['lastname'];
		$firstname = $_SESSION['firstname'];
		$name = $lastname.' '.$firstname;
		$id = $_SESSION['id'];
		// $email = $_SESSION['email'];
		$sql = mysqli_query($con, "SELECT * FROM `employee_list` WHERE email = '$email'");
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
			<link rel="shortcut icon" type="image/png" href="images/favicon.png">
			<link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
			<link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
			<link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
			
			<!-- Style css -->
		    <link href="css/style.css" rel="stylesheet">
			
		</head>
		<body>

		     <!-- Nav header start -->
  <div class="nav-header">
            <a href="index.html" class="brand-logo">
				<!-- <svg class="logo-abbr" width="55" height="55" viewbox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg"> -->
					<!-- <path fill-rule="evenodd" clip-rule="evenodd" d="M27.5 0C12.3122 0 0 12.3122 0 27.5C0 42.6878 12.3122 55 27.5 55C42.6878 55 55 42.6878 55 27.5C55 12.3122 42.6878 0 27.5 0ZM28.0092 46H19L19.0001 34.9784L19 27.5803V24.4779C19 14.3752 24.0922 10 35.3733 10V17.5571C29.8894 17.5571 28.0092 19.4663 28.0092 24.4779V27.5803H36V34.9784H28.0092V46Z" fill="url(#paint0_linear)"></path> -->
					<defs>
					</defs>
				</svg>
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
		
		
            <!-- Header start -->
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
									<a href="app-profile.html" class="dropdown-item ai-icon">
										<svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
										<span class="ms-2">Profile </span>
									</a>
									<a href="logout.php?operation=admin_logout" class="dropdown-item ai-icon">
										<span class="ms-2"><i class="fas fa-power-off"> </i> Logout </span>
									</a>
								</div>
							</li>
                        </ul>
                    </div>
				</nav>
			</div>
		</div>
            <!-- Header end ti-comment-alt -->


		<!--**********************************
		Content body start
		***********************************-->
		<?php
			if (isset($_GET['page'])) {
				$page = $_GET['page'];
			} else { $page = ''; }
			switch ($page) {
				case 'progress':
					$page = 'progress';
					break;
				case 'pending':
					$page = 'pending';
					break;
				case 'completed':
					$page = 'completed';
					break;
				case 'appraisals':
					$page = 'appraisals';
					break;
				case 'profile':
					$page = 'profile';
					break;
				
				default:
					$page = '';
					break;
			}
		?>
		<div class="content-body" style="margin-left: -20px !important;">
			<!-- row -->
			<div class="container-fluid">
				<div class="project-page d-flex justify-content-between align-items-center flex-wrap">
					<div class="project mb-4">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link <?php if($page == '') echo 'active'; ?>" href="welcome.php" role="tab">All Tasks</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?php if($page == 'pending') echo 'active'; ?>" href="welcome.php?page=pending" role="tab">Pending</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?php if($page == 'progress') echo 'active'; ?>" href="welcome.php?page=progress" role="tab">On Progress</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?php if($page == 'completed') echo 'active'; ?>" href="welcome.php?page=completed" role="tab">Completed</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?php if($page == 'appraisals') echo 'active'; ?>" href="welcome.php?page=appraisals" role="tab">Appraisals</a>
							</li>
							<li>
								<?php if (@$_GET['msg']) {
								if (@$_GET['cssClass']) { ?>
								<div class="alert <?= $_GET['cssClass']; ?> fs-18 fw-bold text-dark" id="msgAlert" role="alert">
									<?= $_GET['msg']; ?>
									<!-- <button type="button" class="btn btn-primary" id="msgAlert">Show live alert</button> -->
								</div>
								<?php }
								} ?>
							</li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-12">
						<div class="tab-content">
							<div class="tab-pane fade active show" id="AllStatus">
								<div class="card">
									<div class="card-body">
										<div class="row align-items-center">
											<?php if ((@$_GET['page']) != 'progress' && (@$_GET['page']) != 'pending' && (@$_GET['page']) != 'completed' && (@$_GET['page'] != 'appraisals') && (@$_GET['page'] != 'profile')) { ?>
											<table class="table table-hver">
												<thead>
													<tr>
														<th>No.</th>
														<th>Task</th>
														<th>Due Date</th>
														<th>Assigned To</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php $sql = mysqli_query($con, "SELECT * FROM `task_list` WHERE employee_id = '$id'");
														$count = 1;
														while ($data = mysqli_fetch_assoc($sql)) {
															$task = $data['task'];
															$desc = $data['description'];
															$emp = $data['employee_id'];
															$dueDate = $data['due_date'];
															$comp = $data['completed'];
															$status = $data['status'];
															$dateCre = $data['date_created'];
															switch ($status) {
																case '0':
																	$status2 = '<span class="badge bg-info">Pending</span>';
																	break;
																case '1':
																	$status2 = '<span class="badge bg-warning">On Progress</span>';
																	break;
																
																default:
																	$status2 = '<span class="badge bg-primary">Completed</span>';
																	break;
															}
															$today = date('Y-m-d');
															if ($dueDate < $today) {
																$dueDate2 = '<span class="badge bg-danger">Over Due</span>';
															} else {
																$dueDate2 = '';
															}
															$empSql = mysqli_query($con, "SELECT * FROM `employee_list` WHERE `id` = '$emp'");
															$empData = mysqli_fetch_assoc($empSql);
															$empName = $empData['lastname'].' '.$empData['firstname'];
													?>
													<tr>
														<td><?= $count; ?></td>
														<td><?= $task; ?></td>
														<td><?= $dueDate; ?></td>
														<td><?= $empName; ?></td>
														<td><?= $status2; ?> <?= $dueDate2; ?></td>
														<td class="">
															<button class="btn fa-2x btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateTaskModal<?= $data['id']; ?>"><i class="far fa-edit"></i> Update</button>
														</td>
													</tr>
													<!-- view task Modal start -->
													<div class="modal fade" id="viewTaskModal<?= $data['id']; ?>" data-bs-backdrop="static">
														<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">View Task</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal">
																	</button>
																</div>
																<div class="modal-body">
																	<div class="row">
																		<div class="col-md-6">
																			<dl>
																				<dt><b class="border-bottom border-primary">Task</b></dt>
																				<dd><?php echo ucwords($task) ?></dd>
																			</dl>
																			<!-- <dl>
																				<dt><b class="border-bottom border-primary">Assign By</b></dt>
																				<dd><?php echo ucwords($empName) ?></dd>
																			</dl> -->
																		</div>
																		<div class="col-md-6">
																			<dl>
																				<dt><b class="border-bottom border-primary">Due Date</b></dt>
																				<dd><?php echo date("m d,Y",strtotime($dueDate)) ?></dd>
																			</dl>
																			<dl>
																				<dt><b class="border-bottom border-primary">Status</b></dt>
																				<dd class="mt-1">
																				<?php
																					echo $status2.'  '.$dueDate2;
																				?>
																				</dd>
																			</dl>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12">
																			<dl>
																				<dt><b class="border-bottom border-primary">Description</b></dt>
																				<dd><?php echo html_entity_decode($desc) ?></dd>
																			</dl>
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
																	<!-- <button type="button" name="" class="btn btn-primary">Add Task</button> -->
																</div>
															</div>
														</div>
													</div>
													<!-- view task Modal end -->
													<!-- update task Modal start -->
													<div class="modal fade" id="updateTaskModal<?= $data['id']; ?>" data-bs-backdrop="static">
														<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Update Task</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal">
																	</button>
																</div>
																<!-- <form action="operations.php?operation=update_task" method="post"> -->
																	<div class="modal-body">
																		<div class="row">
																			<a href="operations.php?operation=progress_task&id=<?= $data['id']; ?>" class="btn btn-warning h2 fw-bold text-dark">Started working on task</a>
																			<a href="operations.php?operation=completed_task&id=<?= $data['id']; ?>" class="btn btn-primary mt-3 h2 fw-bold">Finished working on task</a>
																		</div>
																	</div>
																	<!-- <div class="modal-footer">
																		<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
																		<button type="submit" name="updateTaskSubmit" class="btn btn-primary">Add Task</button>
																	</div> -->
																<!-- </form> -->
															</div>
														</div>
													</div>
													<!-- update task Modal end -->
													<!-- delete Modal start -->
													<div class="modal fade" id="delTaskModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="staticBackdropLabel">Delete Task</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<form method="post" action="operations.php?operation=delete_task">
																	<div class="modal-body">
																		<div class="row">
																			<div class="col-12 text-center">
																				<i class="fas fa-exclamation-circle fa-5x text-danger"></i>
																				<h4>Are you sure you want to delete this task?</h4>
																				<h6 class="text-danger">Note: This action is irriversable</h6>
																			</div>
																			<input type="hidden" name="delId" value="<?= $data['id']; ?>">
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
																		<button type="submit" name="delSubmit" class="btn btn-danger">Yes, Delete</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
													<!-- delete Modal end -->
													<?php $count++;
														}
													?>
												</tr>
											</tbody>
										</table>
										<?php } if ((@$_GET['page']) == 'pending') { ?>
										<table class="table table-hver">
											<thead>
												<tr>
													<th>No.</th>
													<th>Task</th>
													<th>Due Date</th>
													<th>Assigned To</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $sql = mysqli_query($con, "SELECT * FROM `task_list` WHERE `status` = '0' AND employee_id = '$id'");
													$count = 1;
													while ($data = mysqli_fetch_assoc($sql)) {
														$task = $data['task'];
														$desc = $data['description'];
														$emp = $data['employee_id'];
														$dueDate = $data['due_date'];
														$comp = $data['completed'];
														$status = $data['status'];
														$dateCre = $data['date_created'];
														switch ($status) {
															case '0':
																$status2 = '<span class="badge bg-info">Pending</span>';
																break;
															case '1':
																$status2 = '<span class="badge bg-warning">On Progress</span>';
																break;
															
															default:
																$status2 = '<span class="badge bg-primary">Completed</span>';
																break;
														}
														$today = date('Y-m-d');
														if ($dueDate < $today) {
															$dueDate2 = '<span class="badge bg-danger">Over Due</span>';
														} else {
															$dueDate2 = '';
														}
														$empSql = mysqli_query($con, "SELECT * FROM `employee_list` WHERE `id` = '$emp'");
														$empData = mysqli_fetch_assoc($empSql);
														$empName = $empData['lastname'].' '.$empData['firstname'];
												?>
												<tr>
													<td><?= $count; ?></td>
													<td><?= $task; ?></td>
													<td><?= $dueDate; ?></td>
													<td><?= $empName; ?></td>
													<td><?= $status2; ?> <?= $dueDate2; ?></td>
													<td>
														<button class="btn fa-2x btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateTaskModal<?= $data['id']; ?>"><i class="far fa-edit"></i> Update</button>
													</td>
												</tr>
												<!-- view task Modal start -->
												<div class="modal fade" id="viewTaskModal<?= $data['id']; ?>" data-bs-backdrop="static">
													<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title">View Task</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal">
																</button>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-6">
																		<dl>
																			<dt><b class="border-bottom border-primary">Task</b></dt>
																			<dd><?php echo ucwords($task) ?></dd>
																		</dl>
																		<dl>
																			<dt><b class="border-bottom border-primary">Assign To</b></dt>
																			<dd><?php echo ucwords($empName) ?></dd>
																		</dl>
																	</div>
																	<div class="col-md-6">
																		<dl>
																			<dt><b class="border-bottom border-primary">Due Date</b></dt>
																			<dd><?php echo date("m d,Y",strtotime($dueDate)) ?></dd>
																		</dl>
																		<dl>
																			<dt><b class="border-bottom border-primary">Status</b></dt>
																			<dd class="mt-1">
																			<?php
																				echo $status2.'  '.$dueDate2;
																			?>
																			</dd>
																		</dl>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<dl>
																			<dt><b class="border-bottom border-primary">Description</b></dt>
																			<dd><?php echo html_entity_decode($desc) ?></dd>
																		</dl>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
																<!-- <button type="button" name="" class="btn btn-primary">Add Task</button> -->
															</div>
														</div>
													</div>
												</div>
												<!-- view task Modal end -->
												<!-- update task Modal start -->
												<div class="modal fade" id="updateTaskModal<?= $data['id']; ?>" data-bs-backdrop="static">
													<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title">Update Task</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal">
																</button>
															</div>
															<!-- <form action="operations.php?operation=update_task" method="post"> -->
																<div class="modal-body">
																	<div class="row">
																		<a href="operations.php?operation=progress_task&id=<?= $data['id']; ?>" class="btn btn-warning h2 fw-bold text-dark">Started working on task</a>
																		<a href="operations.php?operation=completed_task&id=<?= $data['id']; ?>" class="btn btn-primary mt-3 h2 fw-bold">Finished working on task</a>
																	</div>
																</div>
														</div>
													</div>
												</div>
												<!-- update task Modal end -->
												<!-- delete Modal start -->
												<div class="modal fade" id="delTaskModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="staticBackdropLabel">Delete Task</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<form method="post" action="operations.php?operation=delete_task">
																<div class="modal-body">
																	<div class="row">
																		<div class="col-12 text-center">
																			<i class="fas fa-exclamation-circle fa-5x text-danger"></i>
																			<h4>Are you sure you want to delete this task?</h4>
																			<h6 class="text-danger">Note: This action is irriversable</h6>
																		</div>
																		<input type="hidden" name="delId" value="<?= $data['id']; ?>">
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
																	<button type="submit" name="delSubmit" class="btn btn-danger">Yes, Delete</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- delete Modal end -->
												<?php $count++;
													}
												?>
											</tr>
										</tbody>
									</table>
									<?php } if ((@$_GET['page']) == 'progress') { ?>
									<table class="table table-hver">
										<thead>
											<tr>
												<th>No.</th>
												<th>Task</th>
												<th>Due Date</th>
												<th>Assigned To</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $sql = mysqli_query($con, "SELECT * FROM `task_list` WHERE `status` = '1' AND employee_id = '$id'");
												$count = 1;
												while ($data = mysqli_fetch_assoc($sql)) {
													$task = $data['task'];
													$desc = $data['description'];
													$emp = $data['employee_id'];
													$dueDate = $data['due_date'];
													$comp = $data['completed'];
													$status = $data['status'];
													$dateCre = $data['date_created'];
													switch ($status) {
														case '0':
															$status2 = '<span class="badge bg-info">Pending</span>';
															break;
														case '1':
															$status2 = '<span class="badge bg-warning">On Progress</span>';
															break;
														
														default:
															$status2 = '<span class="badge bg-primary">Completed</span>';
															break;
													}
													$today = date('Y-m-d');
													if ($dueDate < $today) {
														$dueDate2 = '<span class="badge bg-danger">Over Due</span>';
													} else {
														$dueDate2 = '';
													}
													$empSql = mysqli_query($con, "SELECT * FROM `employee_list` WHERE `id` = '$emp'");
													$empData = mysqli_fetch_assoc($empSql);
													$empName = $empData['lastname'].' '.$empData['firstname'];
											?>
											<tr>
												<td><?= $count; ?></td>
												<td><?= $task; ?></td>
												<td><?= $dueDate; ?></td>
												<td><?= $empName; ?></td>
												<td><?= $status2; ?> <?= $dueDate2; ?></td>
												<td>
													<button class="btn fa-2x btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateTaskModal<?= $data['id']; ?>"><i class="far fa-edit"></i> Update</button>
												</td>
											</tr>
											<!-- view task Modal start -->
											<div class="modal fade" id="viewTaskModal<?= $data['id']; ?>" data-bs-backdrop="static">
												<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">View Task</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal">
															</button>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<dl>
																		<dt><b class="border-bottom border-primary">Task</b></dt>
																		<dd><?php echo ucwords($task) ?></dd>
																	</dl>
																	<dl>
																		<dt><b class="border-bottom border-primary">Assign To</b></dt>
																		<dd><?php echo ucwords($empName) ?></dd>
																	</dl>
																</div>
																<div class="col-md-6">
																	<dl>
																		<dt><b class="border-bottom border-primary">Due Date</b></dt>
																		<dd><?php echo date("m d,Y",strtotime($dueDate)) ?></dd>
																	</dl>
																	<dl>
																		<dt><b class="border-bottom border-primary">Status</b></dt>
																		<dd class="mt-1">
																		<?php
																			echo $status2.'  '.$dueDate2;
																		?>
																		</dd>
																	</dl>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<dl>
																		<dt><b class="border-bottom border-primary">Description</b></dt>
																		<dd><?php echo html_entity_decode($desc) ?></dd>
																	</dl>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
															<!-- <button type="button" name="" class="btn btn-primary">Add Task</button> -->
														</div>
													</div>
												</div>
											</div>
											<!-- view task Modal end -->
											<!-- update task Modal start -->
											<div class="modal fade" id="updateTaskModal<?= $data['id']; ?>" data-bs-backdrop="static">
												<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Update Task</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal">
															</button>
														</div>
														<!-- <form action="operations.php?operation=update_task" method="post"> -->
															<div class="modal-body">
																<div class="row">
																	<a href="operations.php?operation=progress_task&id=<?= $data['id']; ?>" class="btn btn-warning h2 fw-bold text-dark">Started working on task</a>
																	<a href="operations.php?operation=completed_task&id=<?= $data['id']; ?>" class="btn btn-primary mt-3 h2 fw-bold">Finished working on task</a>
																</div>
															</div>
															<!-- <div class="modal-footer">
																<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
																<button type="submit" name="updateTaskSubmit" class="btn btn-primary">Add Task</button>
															</div> -->
														<!-- </form> -->
													</div>
												</div>
											</div>
											<!-- update task Modal end -->
											<!-- delete Modal start -->
											<div class="modal fade" id="delTaskModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="staticBackdropLabel">Delete Task</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<form method="post" action="operations.php?operation=delete_task">
															<div class="modal-body">
																<div class="row">
																	<div class="col-12 text-center">
																		<i class="fas fa-exclamation-circle fa-5x text-danger"></i>
																		<h4>Are you sure you want to delete this task?</h4>
																		<h6 class="text-danger">Note: This action is irriversable</h6>
																	</div>
																	<input type="hidden" name="delId" value="<?= $data['id']; ?>">
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
																<button type="submit" name="delSubmit" class="btn btn-danger">Yes, Delete</button>
															</div>
														</form>
													</div>
												</div>
											</div>
											<!-- delete Modal end -->
											<?php $count++;
												}
											?>
										</tr>
									</tbody>
									</table>
									<?php } if ((@$_GET['page']) == 'completed') { ?>
									<table class="table table-hver">
										<thead>
											<tr>
												<th>No.</th>
												<th>Task</th>
												<th>Due Date</th>
												<th>Assigned To</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $sql = mysqli_query($con, "SELECT * FROM `task_list` WHERE `status` = '2' AND employee_id = '$id'");
												$count = 1;
												while ($data = mysqli_fetch_assoc($sql)) {
													$task = $data['task'];
													$desc = $data['description'];
													$emp = $data['employee_id'];
													$dueDate = $data['due_date'];
													$comp = $data['completed'];
													$status = $data['status'];
													$dateCre = $data['date_created'];
													switch ($status) {
														case '0':
															$status2 = '<span class="badge bg-info">Pending</span>';
															break;
														case '1':
															$status2 = '<span class="badge bg-warning">On Progress</span>';
															break;
														
														default:
															$status2 = '<span class="badge bg-primary">Completed</span>';
															break;
													}
													$today = date('Y-m-d');
													if ($dueDate < $today) {
														$dueDate2 = '<span class="badge bg-danger">Over Due</span>';
													} else {
														$dueDate2 = '';
													}
													$empSql = mysqli_query($con, "SELECT * FROM `employee_list` WHERE `id` = '$emp'");
													$empData = mysqli_fetch_assoc($empSql);
													$empName = $empData['lastname'].' '.$empData['firstname'];
											?>
											<tr>
												<td><?= $count; ?></td>
												<td><?= $task; ?></td>
												<td><?= $dueDate; ?></td>
												<td><?= $empName; ?></td>
												<td><?= $status2; ?> <?= $dueDate2; ?></td>
												<td>
													<button class="btn fa-2x btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateTaskModal<?= $data['id']; ?>"><i class="far fa-edit"></i> Update</button>
												</td>
											</tr>
											<!-- view task Modal start -->
											<div class="modal fade" id="viewTaskModal<?= $data['id']; ?>" data-bs-backdrop="static">
												<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">View Task</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal">
															</button>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-6">
																	<dl>
																		<dt><b class="border-bottom border-primary">Task</b></dt>
																		<dd><?php echo ucwords($task) ?></dd>
																	</dl>
																	<dl>
																		<dt><b class="border-bottom border-primary">Assign To</b></dt>
																		<dd><?php echo ucwords($empName) ?></dd>
																	</dl>
																</div>
																<div class="col-md-6">
																	<dl>
																		<dt><b class="border-bottom border-primary">Due Date</b></dt>
																		<dd><?php echo date("m d,Y",strtotime($dueDate)) ?></dd>
																	</dl>
																	<dl>
																		<dt><b class="border-bottom border-primary">Status</b></dt>
																		<dd class="mt-1">
																		<?php
																			echo $status2.'  '.$dueDate2;
																		?>
																		</dd>
																	</dl>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<dl>
																		<dt><b class="border-bottom border-primary">Description</b></dt>
																		<dd><?php echo html_entity_decode($desc) ?></dd>
																	</dl>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
															<!-- <button type="button" name="" class="btn btn-primary">Add Task</button> -->
														</div>
													</div>
												</div>
											</div>
											<!-- view task Modal end -->
											<!-- update task Modal start -->
											<div class="modal fade" id="updateTaskModal<?= $data['id']; ?>" data-bs-backdrop="static">
												<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Update Task</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal">
															</button>
														</div>
														<!-- <form action="operations.php?operation=update_task" method="post"> -->
															<div class="modal-body">
																<div class="row">
																	<a href="operations.php?operation=progress_task&id=<?= $data['id']; ?>" class="btn btn-warning h2 fw-bold text-dark">Started working on task</a>
																	<a href="operations.php?operation=completed_task&id=<?= $data['id']; ?>" class="btn btn-primary mt-3 h2 fw-bold">Finished working on task</a>
																</div>
															</div>
															<!-- <div class="modal-footer">
																<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
																<button type="submit" name="updateTaskSubmit" class="btn btn-primary">Add Task</button>
															</div> -->
														<!-- </form> -->
													</div>
												</div>
											</div>
											<!-- update task Modal end -->
											<!-- delete Modal start -->
											<div class="modal fade" id="delTaskModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="staticBackdropLabel">Delete Task</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<form method="post" action="operations.php?operation=delete_task">
															<div class="modal-body">
																<div class="row">
																	<div class="col-12 text-center">
																		<i class="fas fa-exclamation-circle fa-5x text-danger"></i>
																		<h4>Are you sure you want to delete this task?</h4>
																		<h6 class="text-danger">Note: This action is irriversable</h6>
																	</div>
																	<input type="hidden" name="delId" value="<?= $data['id']; ?>">
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
																<button type="submit" name="delSubmit" class="btn btn-danger">Yes, Delete</button>
															</div>
														</form>
													</div>
												</div>
											</div>
											<!-- delete Modal end -->
											<?php $count++;
												}
											?>
										</tr>
									</tbody>
								</table>
								<?php } if ((@$_GET['page']) == 'appraisals') { ?>
									<table class="table table-hver">
											<thead>
												<tr>
													<th>No.</th>
													<th>Task</th>
													<!-- <th>Employee</th> -->
													<th>Evaluator</th>
													<th>Performance <br>Average</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $sql = mysqli_query($con, "SELECT * FROM `ratings` WHERE `employee_id` = '$id'");
													$count = 1;
													while ($data = mysqli_fetch_assoc($sql)) {
														$efficiency = $data['efficiency'];
														$timeliness = $data['timeliness'];
														$quality = $data['quality'];
														$accuracy = $data['accuracy'];
														$evaluId = $data['evaluator_id'];
														$ave = $efficiency + $timeliness + $quality + $accuracy; // get the evaluation score
														$per = round($ave * 100 / 20); // convert evaluation score to percentage
														$taskId = $data['task_id'];
														$empId = $data['employee_id'];
														$sql2 = mysqli_query($con, "SELECT `task` FROM `task_list` WHERE `id` = '$taskId'");
														$taskData = mysqli_fetch_assoc($sql2);
														$task = $taskData['task'];
														$sql3 = mysqli_query($con, "SELECT * FROM `employee_list` WHERE `id` = '$empId'");
														$empData = mysqli_fetch_assoc($sql3);
														$empName = $empData['lastname'].' '.$empData['firstname'];

														$evaluSql = mysqli_query($con, "SELECT * FROM `evaluator_list` WHERE `id` = '$evaluId'");
														$evaluData = mysqli_fetch_assoc($evaluSql);
														$evaluName = $evaluData['lastname'].' '.$evaluData['firstname'];
													?>
												<tr>
													<th><?= $count; ?></th>
													<th><?= $task; ?></th>
													<!-- <th><?= $empName; ?></th> -->
													<th>test Evaluator</th>
													<td><?php echo $per; ?>%</td>
													<td>
														<!-- <div class="dropdown">
															<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
															Action
															</button>
															<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
																<li></li>
																<li>
																	<a class="dropdown-item" href="#updateModal<?= $data['id']; ?>" data-bs-toggle="modal">
																		<i class="far fa-edit"></i> Update
																	</a>
																</li>
																<li><a class="dropdown-item" data-bs-toggle="modal" href="#delModal<?= $data['id']; ?>"><i class="far fa-trash-alt"></i> Delete</a></li>
															</ul>
														</div> -->
														<!-- <a class="dropdown-item" href="#viewModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-eye"></i> View</a> -->
														<button class="btn btn-outline-primary" data-bs-target="#viewModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-eye"></i> View</button>
													</td>
												</tr>
												<!-- view Modal start -->
												<div class="modal fade" id="viewModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="staticBackdropLabel">View Evaluation</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-6">
																		<!-- <h5>Task</h5>
																		<p style="height: -10px !important;"><?= $task ?></p> -->
																		<dl>
																			<dt><b class="border-bottom border-primary">Task</b></dt>
																			<dd><?php echo ucwords($task) ?></dd>
																		</dl>
																		<!-- <dl>
																			<dt><b class="border-bottom border-primary">Assign To</b></dt>
																			<dd><?php echo ucwords($empName) ?></dd>
																		</dl> -->
																		<dl>
																			<dt><b class="border-bottom border-primary">Evaluator</b></dt>
																			<dd><?php echo ucwords($evaluName) ?></dd>
																		</dl>
																		<dl>
																			<dt><b class="border-bottom border-primary">Date Evaluated</b></dt>
																			<dd><?php echo date("m d,Y",strtotime($data['date_created'])) ?></dd>
																		</dl>
																	</div>
																	<div class="col-md-6">
																		<b>Ratings:</b>
																		<dl>
																			<dt><b class="border-bottom border-primary">Efficiency</b></dt>
																			<dd><?php echo $data['efficiency'] ?></dd>
																		</dl>
																		<dl>
																			<dt><b class="border-bottom border-primary">Behaviour</b></dt>
																			<dd><?php echo $data['timeliness'] ?></dd>
																		</dl>
																		<dl>
																			<dt><b class="border-bottom border-primary">Quality</b></dt>
																			<dd><?php echo $data['quality'] ?></dd>
																		</dl>
																		<dl>
																			<dt><b class="border-bottom border-primary">Accuracy</b></dt>
																			<dd><?php echo $data['accuracy'] ?></dd>
																		</dl>
																		<dl>
																			<dt><b class="border-bottom border-primary">Performance Average</b></dt>
																			<dd><?php echo number_format($per,2).'%' ?></dd>
																		</dl>
																	</div>
																	<div class="col-md-12">
																		<dl>
																			<dt><b class="border-bottom border-primary">Remarks</b></dt>
																			<dd><?php echo $data['remarks']; ?></dd>
																		</dl>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
																<!-- <button type="button" class="btn btn-primary">Understood</button> -->
															</div>
														</div>
													</div>
												</div>
												<!-- view modal end -->

												<!-- update modal start -->
												<div class="modal fade" id="updateModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="staticBackdropLabel">Update Evaluation</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<form action="operations.php?operation=update_evaluation" method="post">
																<div class="modal-body">
																	<div class="form-group">
																		<div class="row">
																			<div class="col-md-6">
																				<input type="hidden" name="evaluationId" value="<?= $data['id']; ?>">
																				<label for="employee" class="form-label control-label mt-3">Employee</label>
																				<select name="employee" id="employee" class="form-select border border-primary border-2">
																					<option value="<?= $empId ?>"><?= $empName ?></option>
																				</select>
																			</div>
																			<div class="col-md-6">
																				<label for="task" class="form-label control-label mt-3">Task</label>
																				<select name="task" id="task" class="form-select border border-primary border-2">
																					<option value="<?= $taskId ?>"><?= $task ?></option>
																				</select>
																			</div>
																			<h3 class="mt-2">Ratings:</h3>
																			<div class="col-md-6">
																				<label for="efficiency" class="form-label control-label mt-3">Efficiency</label>
																				<select name="efficiency" id="efficiency" class="form-select border border-primary border-2">
																					<!-- <option value="<?= $taskId ?>"><?= $data['efficiency'] ?></option> -->
																					<option value="5">5</option>
																					<option value="4">4</option>
																					<option value="3">3</option>
																					<option value="2">2</option>
																					<option value="1">1</option>
																					<option value="0">0</option>
																				</select>
																			</div>
																			<div class="col-md-6">
																				<label for="quality" class="form-label control-label mt-3">Quality</label>
																				<select name="quality" id="quality" class="form-select border border-primary border-2">
																					<!-- <option value="<?= $taskId ?>"><?= $data['efficiency'] ?></option> -->
																					<option value="5">5</option>
																					<option value="4">4</option>
																					<option value="3">3</option>
																					<option value="2">2</option>
																					<option value="1">1</option>
																					<option value="0">0</option>
																				</select>
																			</div>
																			<div class="col-md-6">
																				<label for="timeliness" class="form-label control-label mt-3">Timeliness</label>
																				<select name="timeliness" id="timeliness" class="form-select border border-primary border-2">
																					<!-- <option value="<?= $taskId ?>"><?= $data['efficiency'] ?></option> -->
																					<option value="5">5</option>
																					<option value="4">4</option>
																					<option value="3">3</option>
																					<option value="2">2</option>
																					<option value="1">1</option>
																					<option value="0">0</option>
																				</select>
																			</div>
																			<div class="col-md-6">
																				<label for="accuracy" class="form-label control-label mt-3">Accuracy</label>
																				<select name="accuracy" id="accuracy" class="form-select border border-primary border-2">
																					<!-- <option value="<?= $taskId ?>"><?= $data['efficiency'] ?></option> -->
																					<option value="5">5</option>
																					<option value="4">4</option>
																					<option value="3">3</option>
																					<option value="2">2</option>
																					<option value="1">1</option>
																					<option value="0">0</option>
																				</select>
																			</div>
																			<div class="col-md-12">
																				<label for="remark" class="form-label mt-3">Remark</label>
																				<textarea name="remark" id="remark" cols="30" rows="10" class="form-control border border-primary border-2"><?= $data['remarks'] ?></textarea>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
																	<button type="submit" name="updateEvaluation" class="btn btn-primary">Update</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- update modal end -->

												<!-- delete Modal start -->
												<div class="modal fade" id="delModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="staticBackdropLabel text-danger h5">Delete Evaluation</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<form method="post" action="operations.php?operation=delete_evaluation">
																<div class="modal-body">
																	<div class="row">
																		<div class="col-12 text-center">
																			<i class="fas fa-exclamation-circle fa-5x text-danger"></i>
																			<h4>Are you sure you want to delete this evaluation?</h4>
																			<h6 class="text-danger">Note: This action is irriversable</h6>
																		</div>
																		<input type="hidden" name="delId" value="<?= $data['id']; ?>">
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
																	<button type="submit" name="delSubmit" class="btn btn-primary">Yes, Delete</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- delete modal end -->
												<?php $count++;
													}
												?>
											</tbody>
										</table>
								<?php } if ((@$_GET['page']) == 'profile') { ?>
									<div class="row">
										<div class="col-md-5">
											<div class="card shadow-lg">
												<div class="card-body">
													<h2 class="text-center">My Profile</h2>
													<hr>
													<div class="row">
														<div class="col-12 text-center">
															<img src="<?= $picture; ?>" alt="" class="img-fluid img-thumbnail rounded" width="200" height="200" style="border-radius: 50%!important;">
															<hr>
														</div>
														<dl>
															<dt><b class="border-bottom border-primary">Email</b></dt>
															<dd><?php echo ucwords($email) ?></dd>
														</dl>
														<dl>
															<dt><b class="border-bottom border-primary">Firstname</b></dt>
															<dd><?php echo ucwords($firstname) ?></dd>
														</dl>
														<dl>
															<dt><b class="border-bottom border-primary">Lastname</b></dt>
															<dd><?php echo ucwords($lastname) ?></dd>
														</dl>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-7">
											<div class="card shadow-lg">
												<div class="card-body">
													<form action="operations.php?operation=user_update_profile" method="post" enctype="multipart/form-data">
														<div class="form-group">
															<div class="row">
																<h2 class="text-center">Update Profile</h2>
																<hr>
																<div class="col-12 mb-3">
																	<label for="email" class="form-label"><strong>Email</strong></label>
																	<input type="email" name="email" id="email" value="<?= $email; ?>" class="form-control border border-primary border-2">
																</div>
																<div class="col-12 mb-3">
																	<label for="firstname" class="form-label"><strong>Firstname</strong></label>
																	<input type="text" name="firstname" id="firstname" value="<?= $firstname; ?>" class="form-control border border-primary border-2">
																</div>
																<div class="col-12 mb-3">
																	<label for="lastname" class="form-label"><strong>Lastname</strong></label>
																	<input type="text" name="lastname" id="lastname" value="<?= $lastname; ?>" class="form-control border border-primary border-2">
																</div>
																<div class="col-12 mb-3">
																	<label for="picture" class="form-label"><strong>Picture</strong></label>
																	<input type="file" name="picture" id="picture" value="<?= $picture; ?>" class="form-control border border-primary border-2">
																</div>
																<hr>
																<div class="col-12 mb-3">
																	<label for="password" class="form-label"><strong>Enter password before you submit</strong></label>
																	<input type="password" name="password" id="password" class="form-control border border-primary border-2">
																</div>
																<div class="col-12 mb-3">
																	<button type="submit" name="userUpdateProfileSubmit" class="btn btn-primary">Submit</button>
																</div>

															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								<?php }
								?>
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

		<div class="footer">
			<div class="copyright">
				<p>Copyright © TaTU &amp; Developed by <a href="#" target="_blank">Mbo</a> 2022</p>
			</div>
		</div>
		</div>
		<!-- Required vendors -->
		<script src="vendor/global/global.min.js"></script>
		<!-- <script src="vendor/chart.js/Chart.bundle.min.js"></script> -->
		<!-- <script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script> -->

		<!-- Apex Chart -->
		<!-- <script src="vendor/apexchart/apexchart.js"></script> -->

		<!-- <script src="vendor/chart.js/Chart.bundle.min.js"></script> -->

		<!-- Chart piety plugin files -->
		<script src="vendor/peity/jquery.peity.min.js"></script>
		<!-- Dashboard 1 -->
		<script src="js/dashboard/dashboard-1.js"></script>

		<script src="vendor/owl-carousel/owl.carousel.js"></script>

		<script src="js/custom.min.js"></script>
		<script src="js/dlabnav-init.js"></script>
		<script src="js/demo.js"></script>
		<!-- <script src="js/styleSwitcher.js"></script> -->
		<script src="js/index.js?script=<?php echo time(); ?>"></script>
		<script>
			function cardsCenter() {
				
				/*  testimonial one function by = owl.carousel.js */
				

				
				jQuery('.card-slider').owlCarousel({
					loop:true,
					margin:0,
					nav:true,
					//center:true,
					slideSpeed: 3000,
					paginationSpeed: 3000,
					dots: true,
					navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
					responsive:{
						0:{
							items:1
						},
						576:{
							items:1
							},
						800:{
							items:1
									},
						991:{
							items:1
						},
						1200:{
							items:1
						},
						1600:{
							items:1
						}
					}
				})
			}
			
			jQuery(window).on('load',function(){
				setTimeout(function(){
					cardsCenter();
				}, 1000);
			});
			
		</script>
		</body>
		</html>

	<?php } else {
		header("location: user.php");
	}
		
