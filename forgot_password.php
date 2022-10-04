<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- PAGE TITLE HERE -->
        <title>Admin Dashboard</title>
        
        <!-- FAVICONS ICON -->
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body class="vh-100">
        <div class="authincation h-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-6">
                        <div class="authincation-content">
                            <div class="row no-gutters">
                                <div class="col-xl-12">
                                    <div class="auth-form">
                                        <li>
                                            <?php if (@$_GET['msg']) {
                                            if (@$_GET['cssClass']) { ?>
                                            <div class="alert <?= $_GET['cssClass']; ?> text-center fs-18 fw-bold text-dark" id="msgAlert" role="alert">
                                                <?= $_GET['msg']; ?>
                                                <!-- <button type="button" class="btn btn-primary" id="msgAlert">Show live alert</button> -->
                                            </div>
                                            <?php }
                                            } ?>
                                        </li>
                                        <div class="text-center mb-3">
                                            <!-- <a href="index.html"><img src="images/logo-full.png" alt=""></a><h3 class="text-center">Admin Forgot Password</h3> -->
                                        </div>
                                        <?php if (@$_GET['page'] != 'verification_code' && @$_GET['page'] != 'create_password') { ?>
                                            <h2 class="text-center mb-4">Admin Forgot Password</h2>
                                            <h6 class="text-center">Enter email to reset password</h6>
                                            <form action="phpmailer/index.php?operation=forgot_password" method="post">
                                                <div class="mb-3">
                                                    <label><strong>Email</strong></label>
                                                    <input type="email" name="email" id="email" class="form-control border border-primary border-2" placeholder="hello@example.com">
                                                </div>
                                                <div class="row d-flex justify-content-between mt-4 mb-2">
                                                    <div class="mb-3">
                                                        <a href="login.php" class="h4">Log In</a>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-block">SUBMIT</button>
                                                </div>
                                            </form>
                                        <?php } if (@$_GET['page'] == 'verification_code') { 
                                            if (@$_POST['email']) {
                                                $email = $_POST['email']; ?>
                                                <h2 class="text-center mb-4">Admin Forgot Password</h2>
                                                <h6 class="text-center">Enter Verification code to reset password</h6>
                                                <form action="operations.php?operation=code_handler" method="post">
                                                    <div class="mb-3">
                                                        <label for="code"><strong>Verification Code</strong></label>
                                                        <input type="text" name="code" id="code" class="form-control border border-primary border-2" placeholder="Enter Verification code">
                                                        <input type="hidden" name="email" id="email" value="<?= $email; ?>">
                                                    </div>
                                                    <div class="row d-flex justify-content-between mt-4 mb-2">
                                                        <div class="mb-3">
                                                            <a href="login.php" class="h4">Log In</a>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" name="submit" class="btn btn-primary btn-block">SUBMIT</button>
                                                    </div>
                                                </form>
                                        <?php } 
                                            } if (@$_GET['page'] == 'create_password') { 
                                                // if (@$_GET['email']) {
                                                    $email = $_POST['email']; ?>
                                                    <h2 class="text-center mb-4">Admin Reset Password</h2>
                                                    <h6 class="text-center">Create a new password</h6>
                                                    <form action="operations.php?operation=new_password_handler" method="post">
                                                        <div class="mb-3">
                                                            <label for="password"><strong>New Password</strong></label>
                                                            <input type="password" name="password" id="password" class="form-control border border-primary border-2" placeholder="Create new password">
                                                            <input type="hidden" name="email" id="email" value="<?= $email; ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="confirmPassword" class="form-label"><strong>Re Enter Password</strong></label>
                                                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control border border-primary border-2" placeholder="Re enter password">
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" name="submit" class="btn btn-primary btn-block">SUBMIT</button>
                                                        </div>
                                                    </form>
                                            <?php }
                                                // }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
        Scripts
        ***********************************-->
        <!-- Required vendors -->
        <script src="vendor/global/global.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/dlabnav-init.js"></script>
        <!-- <script src="js/styleSwitcher.js"></script> -->
    </body>
</html>