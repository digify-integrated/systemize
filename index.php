<?php
    require('components/global/config/config.php');
    require('components/global/model/database-model.php');
    
    $databaseModel = new DatabaseModel();

    $pageTitle = 'CGMI Digital Solutions';

    require('session-check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('view/_head.php'); ?>
</head>
<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
    <?php require_once('view/_preloader.html'); ?>
    <div class="auth-main">
        <div class="auth-wrapper v2">
            <div class="auth-sidecontent bg-light">
                <img src="./assets/images/authentication/img-auth-sideimg.svg" alt="images" class="img-fluid img-auth-side">
            </div>
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                    <img src="./assets/images/dark-logo.svg" class="dark-logo mb-4" alt="Logo-Dark" />
                        <h2 class="mb-1 fs-7 fw-bolder">Welcome to <span class="text-primary">CGMI Digital Solutions</span></h2>
                        <p class="mb-7">Empowering Futures, Crafting Digital Excellence</p>
                        <form id="signin-form" method="post" action="#">
                            <div class="form-group mb-3">
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                    <button class="input-group-text password-addon" type="button">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="text-end">
                                <a class="text-primary fw-medium" href="forgot-password.php">Forgot Password ?</a>
                            </div>
                        </form>
                        <div class="d-grid mt-4">
                            <button id="signin" type="submit" form="signin-form" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        require_once('view/_error_modal.php'); 
        require_once('view/_global_js.php'); 
    ?>
    
    <script src="./components/authentication/js/index.js?v=<?php echo rand(); ?>"></script>
</body>
</html>