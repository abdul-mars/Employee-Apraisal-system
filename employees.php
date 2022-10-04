<?php include 'header2.php';
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
								<a class="nav-link active" data-bs-toggle="tab" href="#AllStatus" role="tab">Employees</a>
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
						<button class="btn btn-outline-primary btn-rounded fs-18"  data-bs-toggle="modal" data-bs-target="#addEmpmodal"><i class="fas fa-plus"></i> New Employee</button>
					</div>

					<!-- add employee Modal start -->
                    <div class="modal fade" id="addEmpmodal" data-bs-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">New Employee</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
	                            <form action="operations.php?operation=add_employee" method="post">
	                            	<div class="form-group">
	                            		<div class="modal-body">
	                                    	<div class="row">
	                                    		<div class="col-md-6">
	                                    			<label for="firstname" class="form-label mt-2">Firstname</label>
	                                    			<input type="text" name="firstname" id="firstname" class="form-control border border-primary border-2">
	                                    		</div>
	                                    		<div class="col-md-6">
	                                    			<label for="lastname" class="form-label mt-2">Lastname</label>
	                                    			<input type="text" name="lastname" id="lastname" class="form-control border border-primary border-2">
	                                    		</div>
	                                    		<div class="col-md-6">
	                                    			<label for="email" class="form-label mt-2">email</label>
	                                    			<input type="email" name="email" id="email" class="form-control border border-primary border-2">
	                                    		</div>
	                                    		<div class="col-md-3">
	                                    			<label for="department" class="form-label mt-2">Department</label>
	                                    			<!-- <input type="email" name="email" id="email" class="form-control border border-primary border-2"> -->
	                                    			<select name="department" id="department" class="form-select border border-primary border-2">
	                                    				<?php
		                                    				$sql = mysqli_query($con, "SELECT * FROM `department_list`");
		                                    				while ($data = mysqli_fetch_assoc($sql)) {
		                                    					echo '<option value="'.$data['id'].'">'.$data['department'].'</option>';
		                                    				}
	                                    				?>
	                                    				
	                                    			</select>
	                                    		</div>
	                                    		<div class="col-md-3">
	                                    			<label for="designation" class="form-label mt-2">Designation</label>
	                                    			<!-- <input type="email" name="email" id="email" class="form-control border border-primary border-2"> -->
	                                    			<select name="designation" id="designation" class="form-select border border-primary border-2">
	                                    				<?php
		                                    				$sql = mysqli_query($con, "SELECT * FROM `designation_list`");
		                                    				while ($data = mysqli_fetch_assoc($sql)) {
		                                    					echo '<option value="'.$data['id'].'">'.$data['designation'].'</option>';
		                                    				}
	                                    				?>
	                                    			</select>
	                                    		</div>
	                                    	</div>
		                                </div>
		                                <div class="modal-footer">
		                                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
		                                    <button type="submit" name="addEmpSubmit" class="btn btn-primary">Add Employee</button>
		                                </div>
		                            	</div>
	                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- add employee Modal start -->

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
														<th>Name</th>
														<th>Email</th>
														<th>Department</th>
														<th>Designation</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$sql = mysqli_query($con, "SELECT * FROM `employee_list`");
														$count = 1;
														while ($data = mysqli_fetch_assoc($sql)) {
															$depId = $data['department_id'];
															$desigId = $data['designation_id'];
															$firstname = $data['firstname'];
															$lastname = $data['lastname'];
															$email = $data['email'];

															$depSql = mysqli_query($con, "SELECT * FROM `department_list` WHERE `id` = '$depId'");
															$depData = mysqli_fetch_assoc($depSql);

															$desigSql = mysqli_query($con, "SELECT * FROM `designation_list` WHERE `id` = '$desigId'");
															$desigData = mysqli_fetch_assoc($desigSql); ?>

															<tr>
																<td><?= $count; ?></td>
																<td><?= $lastname.' '.$firstname; ?></td>
																<td><?= $email; ?></td>
																<td><?= $depData['department']; ?></td>
																<td><?= $desigData['designation']; ?></td>
																<td>
																	<div class="dropdown">
																		<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
																		Action
																		</button>
																		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
																			<li><a class="dropdown-item" href="#viewEmpModal<?= $data['id']; ?>" data-bs-toggle="modal">View</a></li>
																			<li><a class="dropdown-item" href="#">Update</a></li>
																			<li><a class="dropdown-item" href="#delEmpModal<?= $data['id']; ?>" data-bs-toggle="modal">Delete</a></li>
																		</ul>
																	</div>
																</td>
															</tr>

															<!-- view employee Modal start -->
															<div class="modal fade" id="viewEmpModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="staticBackdropLabel">View Employee</h5>
																			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																		</div>
																		<div class="modal-body">
																			<div class="row">
				                                                                <div class="col-12 text-cener">
				                                                                    <div class="text-center">
				                                                                        <img src="images/pic3.jpg" alt="" class="img-fluid img-thumbnail text-cener" style="border-radius: 50%;">
				                                                                    </div>
				                                                                    <hr>
				                                                                </div>
				                                                                <div class="col-md-6">
				                                                                    <dl>
				                                                                        <dt><b class="border-bottom border-primary">Name</b></dt>
				                                                                        <dd><?php echo ucwords($lastname.' '.$firstname) ?></dd>
				                                                                    </dl>
				                                                                </div>
				                                                                <div class="col-md-6">
				                                                                    <dl>
				                                                                        <dt><b class="border-bottom border-primary">Email</b></dt>
				                                                                        <dd><?php echo ucwords($email) ?></dd>
				                                                                    </dl>
				                                                                </div>
				                                                                <div class="col-md-6">
				                                                                	<dl>
																						<dt>Department</dt>
																						<dd><?php echo $depData['department']; ?></dd>
																					</dl>
				                                                                </div>
				                                                                <div class="col-md-6">
				                                                                	<dl>
																						<dt>Designation</dt>
																						<dd><?php echo $desigData['designation']; ?></dd>
																					</dl>
				                                                                </div>
				                                                            </div>
				                                                            <button type="button" class="btn btn-danger float-end" data-bs-dismiss="modal">Close</button>
																		</div>
																	</div>
																</div>
															</div>
															<!-- view employee Modal start -->

															<!-- delete employee Modal start -->
															<div class="modal fade" id="delEmpModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="staticBackdropLabel">Delete Department</h5>
																			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																		</div>
																		<form method="post" action="operations.php?operation=delete_employee">
																			<div class="modal-body">
																				<div class="row">
																					<div class="col-12 text-center">
																						<i class="fas fa-exclamation-circle fa-5x text-danger"></i>
																						<h4>Are you sure you want to delete this Employee?</h4>
																						<h6 class="text-danger">Note: This action is irriversable</h6>
																					</div>
																					<input type="hidden" name="delEmpId" value="<?= $data['id']; ?>">
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
																				<button type="submit" name="delEmpSubmit" class="btn btn-danger">Yes, Delete</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
															<!-- delete employee Modal end -->

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