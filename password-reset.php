<?php
    require('components/global/config/config.php');
    require('components/global/model/database-model.php');
    require('components/global/model/security-model.php');
    require('components/authentication/model/authentication-model.php');

    $databaseModel = new DatabaseModel();
    $securityModel = new SecurityModel();
    $authenticationModel = new AuthenticationModel($databaseModel);

    $pageTitle = 'Password Reset';

    if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['token']) && !empty($_GET['token'])) {
        $id = $_GET['id'];
        $token = $_GET['token'];
        $userID = $securityModel->decryptData($id);
        $token = $securityModel->decryptData($token);

        $loginCredentialsDetails = $authenticationModel->getLoginCredentials($userID, null);
        $resetToken =  $securityModel->decryptData($loginCredentialsDetails['reset_token']);
        $resetTokenExpiryDate = $loginCredentialsDetails['reset_token_expiry_date'];

        if($token != $resetToken || strtotime(date('Y-m-d H:i:s')) > strtotime($resetTokenExpiryDate)){
            header('location: 404.php');
            exit;
        }
    }
    else{
        header('location: index.php');
        exit;
    }

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
                        <h2 class="mb-1 fs-7 fw-bolder">Password <span class="text-primary">Reset</span></h2>
                        <p class="mb-7">Enter your new password</p>
                        <form id="password-reset-form" method="post" action="#">
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $userID; ?>">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input id="new_password" name="new_password" type="password" class="form-control" placeholder="New Password">
                                    <button class="input-group-text password-addon" type="button">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password">
                                    <button class="input-group-text password-addon" type="button">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="d-grid mt-4">
                            <button id="forgot-password" form="password-reset-form" type="submit" class="btn btn-primary w-100 py-8 mb-3 rounded-2">Reset Password</button>
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
    <script src="./components/authentication/js/password-reset.js?v=<?php echo rand(); ?>"></script>
</body>
</html>