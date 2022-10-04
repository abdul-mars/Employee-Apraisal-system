<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="robots" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- PAGE TITLE HERE -->
        <title>Admin Login</title>
        
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
                                        <div class="text-center mb-3 h1">
                                            <!-- <img src="images/logo-full.png" alt=""> --> Admin Sign In
                                        </div>
                                        <h4 class="text-center mb-4 2">Sign in your account</h4>
                                        <h6 class="text-danger text-center fw-bold error"></h6>
                                        <form action="login_hander.php" method="post">
                                            <div class="mb-3">
                                                <label class="mb-1" for="email"><strong>Email</strong></label>
                                                <input type="email" name="email" id="email" class="form-control border border-primary border-2" placeholder="hello@example.com">
                                            </div>
                                            <div class="mb-3">
                                                <label class="mb-1" for="password"><strong>Password</strong></label>
                                                <input type="password" name="password" id="password" class="form-control border border-primary border-2">
                                                <small class="float-end" style="cursor: pointer; user-select: none;" onclick="toggle()"><i class="far fa-eye" id="eye"></i></small>
                                            </div>
                                            <div class="row d-flex justify-content-between mt-4 mb-2">
                                                <div class="mb-3">
                                                    <div class="form-check custom-checkbox ms-1">
                                                        <!-- <input type="hidden" name="fTime" value="0" id="fTime"> -->
                                                        <input type="checkbox" name="remember" value="1" class="form-check-input border border-primary border-2" id="remember">
                                                        <label class="form-check-label" for="remember">Remember Me</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <a href="forgot_password.php">Forgot Password?</a>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" name="loginSubmit" id="loginSubmit" class="btn btn-primary btn-block">Sign Me In</button>
                                            </div>
                                        </form>
                                        <!-- <div class="new-account mt-3">
                                            <p>Don't have an account? <a class="text-primary" href="page-register.html">Sign up</a></p>
                                        </div><?//= md5('123123'); ?> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var state = false;
            function toggle() {
                if(state) {
                    document.getElementById("password").setAttribute("type", "password");
                    // document.getElementById("showHide").innerText('Show1');
                    document.getElementById("eye").className="far fa-eye";

                    state = false;
                } else {
                    document.getElementById("password").setAttribute("type", "text");
                    // document.getElementById("showHide").innerText("Hide");
                    document.getElementById("eye").className="far fa-eye-slash";
                    state = true;
                }
            }
        </script>
        <!--**********************************
        Scripts
        ***********************************-->
        <!-- Required vendors -->
        <script src="js/code.jquery.com-jquery-3.6.0.js?script=<?= time(); ?>"></script>
        <!-- <script src="vendor/global/global.min.js"></script> -->
        <!-- <script src="js/custom.min.js"></script> -->
        <!-- <script src="js/dlabnav-init.js"></script> -->
        <!-- <script src="js/styleSwitcher.js"></script> -->
        <script src="js/index.js?script=<?= time(); ?>"></script>
    </body>
</html>