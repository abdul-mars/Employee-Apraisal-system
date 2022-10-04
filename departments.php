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
						<a class="nav-link active" data-bs-toggle="tab" href="#AllStatus" role="tab">Departments</a>
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
				<button class="btn btn-outline-primary btn-rounded fs-18"  data-bs-toggle="modal" data-bs-target="#addDepModal"><i class="fas fa-plus"></i> New Department</button>
			</div>

			<!-- add new department Modal start -->
			<div class="modal fade" id="addDepModal" data-bs-backdrop="static">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">New Departments</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal">
							</button>
						</div>
						<form action="operations.php?operation=add_deparment" method="post">
							<div class="modal-body">
								<div class="form-group">
									<div class="row">
										<label for="department" class="form-label mt-2">Department Name</label>
										<input type="text" name="department" id="department" class="form-control border border-primary border-2">
										<label for="desc" class="form-label mt-2">Department Description</label>
										<!-- <input type="text" name="desc" id="desc" class="form-control border border-primary border-2"> -->
										<textarea name="desc" id="desc" cols="" rows="3" class="form-control border border-primary border-2"></textarea>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
								<button type="submit" name="addDepSubmit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- add new department Modal end -->

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
												<th>Department</th>
												<th>Description</th>
												<!-- <th>Assigned To</th>
												<th>Status</th> -->
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $sql = mysqli_query($con, "SELECT * FROM `department_list`");
												$count = 1;
											while ($data = mysqli_fetch_assoc($sql)) { ?>
											<tr>
												<th><?= $count; ?></th>
												<td><?= $data['department']; ?></td>
												<td><?= $data['description']; ?></td>
												<td>
													<span>
														<button class="btn btn-outline-primary p-2 m-1" data-bs-toggle="modal" data-bs-target="#updateDepModal<?= $data['id']; ?>">
															<i class="far fa-edit "></i>
														</button>
														<button class=" btn btn-danger text-light p-2 m-1" data-bs-toggle="modal" data-bs-target="#delDepModal<?= $data['id']; ?>">
															<i class="far fa-trash-alt fa-"></i>
														</button>
													</span>
												</td>
											</tr>

											<!-- update Modal start -->
											<div class="modal fade" id="updateDepModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="staticBackdropLabel">Update Department</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<form action="operations.php?operation=update_deparment" method="post">
															<div class="modal-body">
																<div class="form-group">
																	<div class="row">
																		<input type="hidden" name="depId" value="<?= $data['id']; ?>">
																		<label for="department" class="form-label mt-2">Department Name</label>
																		<input type="text" name="department" id="department" value="<?= $data['department']; ?>" class="form-control border border-primary border-2">
																		<label for="desc" class="form-label mt-2">Department Description</label>
																		<!-- <input type="text" name="desc" id="desc" class="form-control border border-primary border-2"> -->
																		<textarea name="desc" id="desc" cols="" rows="3" class="form-control border border-primary border-2"><?= $data['description']; ?></textarea>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
																<button type="submit" name="updateDepSubmit" class="btn btn-primary">Update</button>
															</div>
														</form>
													</div>
												</div>
											</div>
											<!-- update Modal end -->

											<!-- delete Modal start -->
											<div class="modal fade" id="delDepModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="staticBackdropLabel">Delete Department</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<form method="post" action="operations.php?operation=delete_deparment">
															<div class="modal-body">
																<div class="row">
																	<div class="col-12 text-center">
																		<i class="fas fa-exclamation-circle fa-5x text-danger"></i>
																		<h4>Are you sure you want to delete this department?</h4>
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
<!--**********************************
Content body end
***********************************-->
<?php include 'footer.php'; ?>