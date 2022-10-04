<?php include 'header.php';
	include 'side_bar.php';

?>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="project-page d-flex justify-content-between align-items-center flex-wrap">
			<div class="project mb-4">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#AllStatus" role="tab">Evaluations</a>
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
					<!-- <li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#OnProgress" role="tab">On Progress</a>
					</li>
					<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#Pending" role="tab">Pending</a>
					</li>
					<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#Closed" role="tab">Closed</a>
					</li> -->
				</ul>
			</div>
			<div class="mb-4">
				<!-- <a href="javascript:void(0);" class="btn btn-primary btn-rounded fs-18">+ New Evaluation</a> -->
				<button class="btn btn-outline-primary btn-rounded fs-18"  data-bs-toggle="modal" data-bs-target="#newEvaluation"><i class="fas fa-plus"></i> New Evaluation</button>
			</div>

			<!-- add new evaluation Modal start -->
			<div class="modal fade" id="newEvaluation" data-bs-backdrop="static">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">New Evaluation</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal">
							</button>
						</div>
						<!-- <form action="operations.php?operation=evalution" method="post"> -->
						<div class="modal-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<div class="mb-2">
											<?php $sql = mysqli_query($con, "SELECT `id` FROM `evaluator_list` WHERE email = '$email'");
												$evaId = $evaData = mysqli_fetch_assoc($sql)['id'];
											?>
											<input type="hidden" name="evaluator" id="evaluator" value="<?= $evaId; ?>">
											<label for="employee" class="form-label">Employee</label>
											<select name="employee" id="employee" class="form-select border border-primary">
												<option value="">Select Employee</option>
												<?php $sql = mysqli_query($con, "SELECT * FROM `employee_list` ");
												while ($data = mysqli_fetch_assoc($sql)) { ?>
												<option value="<?= $data['id'] ?>"><?php echo $data['lastname'].' '.$data['firstname']; ?></option>
												<?php }
												?>
												<!-- <option value="mustapha abdul-rashid">Mustapha Abdul-Rashid</option>
												<option value="test emaployee">Test Employee</option> -->
											</select>
										</div>
										<div class="mb-2">
											<label for="task" class="form-label">Task</label>
											<select name="task" id="task" class="form-select border border-primary">
												<option value="">Select Employee first</option>
												<!-- <option value="sample task">Sample Task</option>
												<option value="test task">Test Task</option> -->
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<h4>Rating</h4>
										<div class="row">
											<div class="mb-2 col-md-6">
												<label for="efficiency" class="form-label">Efficiency</label>
												<select name="efficiency" id="efficiency" class="form-select border border-primary">
													<option value="5">5</option>
													<option value="4">4</option>
													<option value="3">3</option>
													<option value="2">2</option>
													<option value="1">1</option>
													<option value="0">0</option>
												</select>
											</div>
											<div class="mb-2 col-md-6">
												<label for="quality" class="form-label">Quality</label>
												<select name="quality" id="quality" class="form-select border border-primary">
													<option value="5">5</option>
													<option value="4">4</option>
													<option value="3">3</option>
													<option value="2">2</option>
													<option value="1">1</option>
													<option value="0">0</option>
												</select>
											</div>
											<div class="mb-2 col-md-6">
												<label for="timeliness" class="form-label">Behaviour</label>
												<select name="timeliness" id="timeliness" class="form-select border border-primary">
													<option value="5">5</option>
													<option value="4">4</option>
													<option value="3">3</option>
													<option value="2">2</option>
													<option value="1">1</option>
													<option value="0">0</option>
												</select>
											</div>
											<div class="mb-2 col-md-6">
												<label for="accuracy" class="form-label">Accuracy</label>
												<select name="accuracy" id="accuracy" class="form-select border border-primary">
													<option value="5">5</option>
													<option value="4">4</option>
													<option value="3">3</option>
													<option value="2">2</option>
													<option value="1">1</option>
													<option value="0">0</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<label for="remark" class="form-label">Remark</label>
										<textarea name="remark" id="remark" cols="" rows="2" style="height: 100%;" class="form-control border border-primary"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
							<button type="button" name="evaluationSubmit" id="evaluationSubmit" class="btn btn-primary">Add Evaluation</button>
						</div>
					</form>
				</div>
			</div>
			<!-- add new evaluation Modal end -->
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12">
			<div class="tab-content">
				<div class="tab-pane fade active show" id="AllStatus">
					<div class="card">
						<div class="card-body">
							<div class="row align-items-center">
								<table class="table table-hver">
									<thead>
										<tr>
											<th>No.</th>
											<th>Task</th>
											<th>Employee</th>
											<th>Evaluator</th>
											<th>Performance <br>Average</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $sql = mysqli_query($con, "SELECT * FROM `ratings`");
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
											<th><?= $empName; ?></th>
											<th>test Evaluator</th>
											<td><?php echo $per; ?>%</td>
											<td>
												<div class="dropdown">
													<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
													Action
													</button>
													<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
														<li><a class="dropdown-item" href="#viewModal<?= $data['id']; ?>" data-bs-toggle="modal"><i class="far fa-eye"></i> View</a></li>
														<li>
															<a class="dropdown-item" href="#updateModal<?= $data['id']; ?>" data-bs-toggle="modal">
																<i class="far fa-edit"></i> Update
															</a>
														</li>
														<li><a class="dropdown-item" data-bs-toggle="modal" href="#delModal<?= $data['id']; ?>"><i class="far fa-trash-alt"></i> Delete</a></li>
													</ul>
												</div>
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
																<dl>
																	<dt><b class="border-bottom border-primary">Assign To</b></dt>
																	<dd><?php echo ucwords($empName) ?></dd>
																</dl>
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
																		<label for="timeliness" class="form-label control-label mt-3">Behaviour</label>
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
        <!-- <script src="js/index.js?script=<?php echo time(); ?>"></script> -->
        <!-- <script>
        	alert()
        </script> -->
        <!--**********************************
            Content body end
        ***********************************-->

        <?php include 'footer.php'; ?>