<?php include 'header.php';
	include 'side_bar.php';
?>
<!--**********************************
Content body start
***********************************-->
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
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
			<div class="col-md-5">
				<div class="card shadow-sm">
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
				<div class="card shadow-sm">
					<div class="card-body">
						<form action="operations.php?operation=update_profile" method="post" enctype="multipart/form-data">
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
										<button type="submit" name="updateProfileSubmit" class="btn btn-primary">Submit</button>
									</div>

								</div>
							</div>
						</form>
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