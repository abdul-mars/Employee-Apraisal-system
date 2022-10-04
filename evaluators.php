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
                        <a class="nav-link active" data-bs-toggle="tab" href="#AllStatus" role="tab">Evaluators</a>
                    </li>
                    <li>
                        <?php if (@$_GET['msg']) {
                            if (@$_GET['cssClass']) { ?>
                                <div class="alert <?= $_GET['cssClass']; ?> fs-18 fw-bold text-dark" id="msgAlert" role="alert">
                                    <?= $_GET['msg']; ?>
                                    <!-- <button type="button" class="btn btn-primary" id="msgAlert">Show live alert</button> -->
                                </div>
                                <!-- <script> -->
                            <?php }
                        } ?>
                    </li>
                </ul>
            </div>
            <div class="mb-4">
                <!-- <a href="javascript:void(0);" class="btn btn-primary btn-rounded fs-18">+ New Evaluation</a> -->
                <button class="btn btn-outline-primary btn-rounded fs-18"  data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fas fa-plus"></i> New Evaluator</button>
            </div>

            <!-- add evaluator Modal start -->
            <div class="modal fade" id="exampleModalCenter">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">New Evaluator</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <form action="operations.php?operation=add_evaluator" method="post">
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
                                        <div class="col-md-6">
                                            <?php function genratepass($length){
                                            $char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
                                            return substr(str_shuffle($char), 0, $length);
                                            }
                                            ?>
                                            <label for="token" class="form-label mt-2">Token</label>
                                            <input type="text" name="token" value="<?php echo genratepass(8); ?>" id="token" class="form-control border border-primary border-2" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" name="addEvaSubmit" class="btn btn-primary">Add Evaluator</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- add evaluator Modal end -->

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
                                                <!-- <th>Department</th>
                                                <th>Designation</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = mysqli_query($con, "SELECT * FROM `evaluator_list`");
                                            $count = 1;
                                            while ($data = mysqli_fetch_assoc($sql)) {
                                            $name = $data['lastname'].' '.$data['firstname'];
                                            $email = $data['email'];
                                            ?>
                                            <tr>
                                                <td><?= $count; ?></td>
                                                <td><?= $name; ?></td>
                                                <td><?= $email; ?></td>
                                                <!-- <th>Department test</th>
                                                <td>testing</td> -->
                                                <td>
                                                    <span>
                                                        <button class="btn btn-outline-primary p-2 m-1" data-bs-toggle="modal" data-bs-target="#viewModal<?= $data['id']; ?>">
                                                        <i class="far fa-eye"></i>
                                                        </button>
                                                        <button class=" btn btn-danger text-light p-2 m-1" data-bs-toggle="modal" data-bs-target="#delEvaModal<?= $data['id']; ?>">
                                                        <i class="far fa-trash-alt fa-"></i>
                                                        </button>
                                                    </span>
                                                </td>
                                            </tr>

                                            <!-- view Modal start -->
                                            <div class="modal fade" id="viewModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">View Evaluater</h5>
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
                                                                        <dd><?php echo ucwords($name) ?></dd>
                                                                    </dl>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <dl>
                                                                        <dt><b class="border-bottom border-primary">Email</b></dt>
                                                                        <dd><?php echo ucwords($email) ?></dd>
                                                                    </dl>
                                                                </div>
                                                            </div>
                                                        <button type="button" class="btn btn-danger float-end" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- view modal end -->

                                            <!-- delete Modal start -->
                                            <div class="modal fade" id="delEvaModal<?= $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Delete Evaluator</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post" action="operations.php?operation=delete_evaluator">
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
        </div>
    </div>
</div>
<!--**********************************
Content body end
***********************************-->
<?php include 'footer.php'; ?>