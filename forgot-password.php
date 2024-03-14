<?php
    require('components/global/config/config.php');
    require('components/global/model/database-model.php');
    
    $databaseModel = new DatabaseModel();

    $pageTitle = 'Forgot Password';

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
                        <div class="d-flex justify-content-between align-items-end mb-2">
                            <h2 class="mb-0 fs-7 fw-bolder">Forgot <span class="text-primary">Password</span></h2>
                            <a href="index.php" class="link-primary">Back to Login</a>
                        </div>
                        <p class="mb-7">Please enter the email address associated with your account and We will email you a link to reset your password.</p>
                        <form id="forgot-password-form" method="post" action="#">
                            <div class="form-group mb-3">
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" autocomplete="off">
                            </div>
                            <p class="mt-4 text-sm text-muted">Do not forgot to check SPAM box.</p>
                        </form>
                        <div class="d-grid mt-4">
                            <button id="forgot-password" form="forgot-password-form" type="submit" class="btn btn-primary w-100 py-8 mb-3 rounded-2">Forgot Password</button>
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
    <script src="./components/authentication/js/forgot-password.js?v=<?php echo rand(); ?>"></script>
</body>
</html>