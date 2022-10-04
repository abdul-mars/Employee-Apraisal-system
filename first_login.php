<?php session_start();
    $email = $_SESSION['email'];
    $firstname = $_SESSION['firstname']; 
    $lastname = $_SESSION['lastname']; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- PAGE TITLE HERE -->
        <title>Admin First Login</title>
        
        <!-- FAVICONS ICON -->
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        
        <link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <!--*******************
        Preloader start
        ********************-->
        <div id="preloader">
            <div class="lds-ripple">
                <div></div>
                <div></div>
            </div>
        </div>
        <div id="main-wrapper">
            
            <!--**********************************
            Content body start
            ***********************************-->
            <div class="cotent-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
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
                                </div>
                                <div class="card-body">
                                    <div class="form-validation">
                                        <form action="operations.php?operation=admin_first_time" method="post" class="needs-validation" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xl-3"></div>
                                                <div class="col-xl-6">
                                                    <div class="mb-3 row">
                                                        <h4 class="card-title text-lowerase text-center">Welcome <?= strtolower($email); ?></h4> <hr>
                                                        <label class="col-lg-4 col-form-label" for="firstname">Firstname
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <input type="text" name="firstname" class="form-control border border-primary border-2" value="<?= $firstname; ?>" id="firstname" placeholder="Enter your firstname.." required="">
                                                            <div class="invalid-feedback">
                                                                Please enter a firstname.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-lg-4 col-form-label" for="lastname">Lastname
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <input type="text" name="lastname" class="form-control border border-primary border-2" value="<?= $lastname; ?>" id="lastname" placeholder="Enter your lastname.." required="">
                                                            <div class="invalid-feedback">
                                                                Please enter a lastname.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-lg-4 col-form-label" for="picture">Picture <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="file" name="picture" class="form-control border border-primary border-2" id="picture" placeholder="Your valid picture.." required="">
                                                        <div class="invalid-feedback">
                                                            Please enter a Email.
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="password">Password
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="password" name="password" class="form-control border border-primary border-2" id="password" placeholder="Create a password.." required="">
                                                    <div class="invalid-feedback">
                                                        Please enter a password.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="confirmPassword">Confirm Password
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="password" name="confirmPassword" class="form-control border border-primary border-2" id="confirmPassword" placeholder="Re-type password.." required="">
                                                    <div class="invalid-feedback">
                                                        Please re-enter a password.
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" name="adminFirstTimeSubmit">Submit</button>
                                        </form>
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
            
        </div>
        <!--   Scripts
        *********************************** -->
        <!-- Required vendors -->
        <script src="vendor/global/global.min.js"></script>
        <script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/dlabnav-init.js"></script>
        <script src="js/demo.js"></script>
        <!-- <script src="js/styleSwitcher.js"></script> -->
        <script src="js/index.js"></script>
    </body>
</html>