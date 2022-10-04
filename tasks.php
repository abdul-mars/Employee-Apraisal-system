<?php include 'header.php';
	include 'side_bar.php';
?>
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
		
		default:
			$page = '';
			break;
	}
?>
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="project-page d-flex justify-content-between align-items-center flex-wrap">
			<div class="project mb-4">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link <?php if($page == '') echo 'active'; ?>" href="tasks.php" role="tab">All Tasks</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if($page == 'pending') echo 'active'; ?>" href="tasks.php?page=pending" role="tab">Pending</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if($page == 'progress') echo 'active'; ?>" href="tasks.php?page=progress" role="tab">On Progress</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if($page == 'completed') echo 'active'; ?>" href="tasks.php?page=completed" role="tab">Completed</a>
					</li>
					<li>
						<?php if (@$_GET['msg']) {
						if (@$_GET['cssClass']) { ?>
						<div class="alert <?= $_GET['cssClass']; ?> fs-18 fw-bold text-dark" id="msgAlert" role="alert">
							<?= $_GET['msg']; ?>
							<!-- <button type="button" class="btn btn-primary" id="msgAlert">Show live alert</button> -->
						</div>
						<script>
							$('#msgModal').modal().show();
						</script>
						<?php }
						} ?>
					</li>
				</ul>
			</div>
			<div class="mb-4">
				<!-- <a href="javascript:void(0);" class="btn btn-primary btn-rounded fs-18">+ New Evaluation</a> -->
				<button class="btn btn-outline-primary btn-rounded fs-18"  data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fas fa-plus"></i> New Task</button>
			</div>
			<!-- add task Modal start -->
			<div class="modal fade" id="exampleModalCenter" data-bs-backdrop="static">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">New Task</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal">
							</button>
						</div>
						<form action="operations.php?operation=add_task" method="post">
							<div class="modal-body">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-12">
													<label for="task" class="form-label mt-2">Task</label>
													<input type="text" name="task" id="task" class="form-control border border-primary border-2">
												</div>
												<div class="col-md-12">
													<label for="assigned" class="form-label mt-2">Assigned To</label>
													<select name="assigned" id="assigned" class="form-select border border-primary border-2">
														<?php $sql = mysqli_query($con, "SELECT * FROM `employee_list`");
															while ($data = mysqli_fetch_assoc($sql)) {
																$name = $data['lastname'].' '.$data['firstname'];
																echo '<option value="'.$data['id'].'">'.$name.'</option>';
															}
														?>
													</select>
												</div>
												<div class="col-md-12">
													<label for="dueData" class="form-label mt-2">Due Date</label>
													<input type="date" name="dueDate" id="dueDate" class="form-control border border-primary border-2">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<label for="desc" class="form-label">Description</label>
											<textarea name="desc" id="desc" cols="" rows="" style="height: 100%;" class="form-control border border-primary border-2"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
								<button type="submit" name="addTaskSubmit" class="btn btn-primary">Add Task</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- add task Modal end -->
		</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="tab-content">
					<div class="tab-pane fade active show" id="AllStatus">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<?php if ((@$_GET['page']) != 'progress' && (@$_GET['page']) != 'pending' && (@$_GET['page']) != 'completed') { ?>
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
												<?php $sql = mysqli_query($con, "SELECT * FROM `task_list`");
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
															<div class="dropdown">
																<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
																Action
																</button>
																<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
																	<li><a class="dropdown-item" href="#viewTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-eye"></i> View</a></li>
																	<li><a class="dropdown-item" href="#updateTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-edit"></i> Update</a></li>
																	<li><a class="dropdown-item" href="#delTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-trash-alt"></i> Delete</a></li>
																</ul>
															</div>
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
														<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Update Task</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal">
																	</button>
																</div>
																<form action="operations.php?operation=update_task" method="post">
																	<div class="modal-body">
																		<div class="form-group">
																			<div class="row">
																				<div class="col-md-6">
																					<div class="row">
																						<input type="hidden" name="taskId" value="<?= $data['id']; ?>">
																						<div class="col-md-12">
																							<label for="task" class="form-label mt-2">Task</label>
																							<input type="text" name="task" id="task" value="<?= $task; ?>" class="form-control border border-primary border-2">
																						</div>
																						<div class="col-md-12">
																							<label for="assigned" class="form-label mt-2">Assigned To</label>
																							<select name="assigned" id="assigned" class="form-select border border-primary border-2">
																								<!-- <option value="<?= $emp; ?>"><?= $name; ?></option> -->
																								<?php $sql2 = mysqli_query($con, "SELECT * FROM `employee_list`");
																									while ($data2 = mysqli_fetch_assoc($sql2)) {
																										$name = $data2['lastname'].' '.$data2['firstname'];
																										echo '<option value="'.$data2['id'].'">'.$name.'</option>';
																									}
																								?>
																							</select>
																						</div>
																						<div class="col-md-12">
																							<label for="dueData" class="form-label mt-2">Due Date</label>
																							<input type="date" name="dueDate" id="dueDate" value="<?= $dueDate; ?>" class="form-control border border-primary border-2">
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6">
																					<label for="desc" class="form-label">Description</label>
																					<textarea name="desc" id="desc" cols="" rows="" style="height: 100%;" class="form-control border border-primary border-2"><?= $desc; ?></textarea>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
																		<button type="submit" name="updateTaskSubmit" class="btn btn-primary">Add Task</button>
																	</div>
																</form>
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
												<?php $sql = mysqli_query($con, "SELECT * FROM `task_list` WHERE `status` = '0'");
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
															<div class="dropdown">
																<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
																Action
																</button>
																<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
																	<li><a class="dropdown-item" href="#viewTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-eye"></i> View</a></li>
																	<li><a class="dropdown-item" href="#updateTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-edit"></i> Update</a></li>
																	<li><a class="dropdown-item" href="#delTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-trash-alt"></i> Delete</a></li>
																</ul>
															</div>
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
														<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Update Task</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal">
																	</button>
																</div>
																<form action="operations.php?operation=update_task" method="post">
																	<div class="modal-body">
																		<div class="form-group">
																			<div class="row">
																				<div class="col-md-6">
																					<div class="row">
																						<input type="hidden" name="taskId" value="<?= $data['id']; ?>">
																						<div class="col-md-12">
																							<label for="task" class="form-label mt-2">Task</label>
																							<input type="text" name="task" id="task" value="<?= $task; ?>" class="form-control border border-primary border-2">
																						</div>
																						<div class="col-md-12">
																							<label for="assigned" class="form-label mt-2">Assigned To</label>
																							<select name="assigned" id="assigned" class="form-select border border-primary border-2">
																								<!-- <option value="<?= $emp; ?>"><?= $name; ?></option> -->
																								<?php $sql2 = mysqli_query($con, "SELECT * FROM `employee_list`");
																									while ($data2 = mysqli_fetch_assoc($sql2)) {
																										$name = $data2['lastname'].' '.$data2['firstname'];
																										echo '<option value="'.$data2['id'].'">'.$name.'</option>';
																									}
																								?>
																							</select>
																						</div>
																						<div class="col-md-12">
																							<label for="dueData" class="form-label mt-2">Due Date</label>
																							<input type="date" name="dueDate" id="dueDate" value="<?= $dueDate; ?>" class="form-control border border-primary border-2">
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6">
																					<label for="desc" class="form-label">Description</label>
																					<textarea name="desc" id="desc" cols="" rows="" style="height: 100%;" class="form-control border border-primary border-2"><?= $desc; ?></textarea>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
																		<button type="submit" name="updateTaskSubmit" class="btn btn-primary">Add Task</button>
																	</div>
																</form>
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
												<?php $sql = mysqli_query($con, "SELECT * FROM `task_list` WHERE `status` = '1'");
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
															<div class="dropdown">
																<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
																Action
																</button>
																<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
																	<li><a class="dropdown-item" href="#viewTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-eye"></i> View</a></li>
																	<li><a class="dropdown-item" href="#updateTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-edit"></i> Update</a></li>
																	<li><a class="dropdown-item" href="#delTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-trash-alt"></i> Delete</a></li>
																</ul>
															</div>
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
														<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Update Task</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal">
																	</button>
																</div>
																<form action="operations.php?operation=update_task" method="post">
																	<div class="modal-body">
																		<div class="form-group">
																			<div class="row">
																				<div class="col-md-6">
																					<div class="row">
																						<input type="hidden" name="taskId" value="<?= $data['id']; ?>">
																						<div class="col-md-12">
																							<label for="task" class="form-label mt-2">Task</label>
																							<input type="text" name="task" id="task" value="<?= $task; ?>" class="form-control border border-primary border-2">
																						</div>
																						<div class="col-md-12">
																							<label for="assigned" class="form-label mt-2">Assigned To</label>
																							<select name="assigned" id="assigned" class="form-select border border-primary border-2">
																								<!-- <option value="<?= $emp; ?>"><?= $name; ?></option> -->
																								<?php $sql2 = mysqli_query($con, "SELECT * FROM `employee_list`");
																									while ($data2 = mysqli_fetch_assoc($sql2)) {
																										$name = $data2['lastname'].' '.$data2['firstname'];
																										echo '<option value="'.$data2['id'].'">'.$name.'</option>';
																									}
																								?>
																							</select>
																						</div>
																						<div class="col-md-12">
																							<label for="dueData" class="form-label mt-2">Due Date</label>
																							<input type="date" name="dueDate" id="dueDate" value="<?= $dueDate; ?>" class="form-control border border-primary border-2">
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6">
																					<label for="desc" class="form-label">Description</label>
																					<textarea name="desc" id="desc" cols="" rows="" style="height: 100%;" class="form-control border border-primary border-2"><?= $desc; ?></textarea>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
																		<button type="submit" name="updateTaskSubmit" class="btn btn-primary">Add Task</button>
																	</div>
																</form>
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
												<?php $sql = mysqli_query($con, "SELECT * FROM `task_list` WHERE `status` = '2'");
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
															<div class="dropdown">
																<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
																Action
																</button>
																<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
																	<li><a class="dropdown-item" href="#viewTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-eye"></i> View</a></li>
																	<li><a class="dropdown-item" href="#updateTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-edit"></i> Update</a></li>
																	<li><a class="dropdown-item" href="#delTaskModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-trash-alt"></i> Delete</a></li>
																</ul>
															</div>
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
														<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title">Update Task</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal">
																	</button>
																</div>
																<form action="operations.php?operation=update_task" method="post">
																	<div class="modal-body">
																		<div class="form-group">
																			<div class="row">
																				<div class="col-md-6">
																					<div class="row">
																						<input type="hidden" name="taskId" value="<?= $data['id']; ?>">
																						<div class="col-md-12">
																							<label for="task" class="form-label mt-2">Task</label>
																							<input type="text" name="task" id="task" value="<?= $task; ?>" class="form-control border border-primary border-2">
																						</div>
																						<div class="col-md-12">
																							<label for="assigned" class="form-label mt-2">Assigned To</label>
																							<select name="assigned" id="assigned" class="form-select border border-primary border-2">
																								<!-- <option value="<?= $emp; ?>"><?= $name; ?></option> -->
																								<?php $sql2 = mysqli_query($con, "SELECT * FROM `employee_list`");
																									while ($data2 = mysqli_fetch_assoc($sql2)) {
																										$name = $data2['lastname'].' '.$data2['firstname'];
																										echo '<option value="'.$data2['id'].'">'.$name.'</option>';
																									}
																								?>
																							</select>
																						</div>
																						<div class="col-md-12">
																							<label for="dueData" class="form-label mt-2">Due Date</label>
																							<input type="date" name="dueDate" id="dueDate" value="<?= $dueDate; ?>" class="form-control border border-primary border-2">
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6">
																					<label for="desc" class="form-label">Description</label>
																					<textarea name="desc" id="desc" cols="" rows="" style="height: 100%;" class="form-control border border-primary border-2"><?= $desc; ?></textarea>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
																		<button type="submit" name="updateTaskSubmit" class="btn btn-primary">Add Task</button>
																	</div>
																</form>
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
									<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="progect-pagination d-flex justify-content-between align-items-center flex-wrap">
		<h4 class="mb-3">Showing 10 from 160 data</h4>
		<ul class="pagination mb-3">
			<li class="page-item page-indicator">
				<a class="page-link" href="javascript:void(0)">
				<i class="fas fa-angle-double-left me-2"></i>Previous</a>
			</li>
			<li class="page-item">
				<a class=" active" href="javascript:void(0)">1</a>
				<a class="" href="javascript:void(0)">2</a>
				<a class="" href="javascript:void(0)">3</a>
				<a class="" href="javascript:void(0)">4</a>
			</li>
			<li class="page-item page-indicator">
				<a class="page-link" href="javascript:void(0)">
				Next<i class="fas fa-angle-double-right ms-2"></i></a>
			</li>
		</ul>
	</div> -->
</div>
</div>
</div>
<!--**********************************
Content body end
***********************************-->
<?php include 'footer.php'; ?>