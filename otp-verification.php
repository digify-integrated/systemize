<?php
    require('components/global/config/config.php');
    require('components/global/model/database-model.php');
    require('components/global/model/security-model.php');
    require('components/authentication/model/authentication-model.php');

    $databaseModel = new DatabaseModel();
    $securityModel = new SecurityModel();
    $authenticationModel = new AuthenticationModel($databaseModel);
    
    $pageTitle = 'OTP Verification';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $userID = $securityModel->decryptData($id);

        $checkLoginCredentialsExist = $authenticationModel->checkLoginCredentialsExist($userID, null);
        $total = $checkLoginCredentialsExist['total'] ?? 0;

        if($total > 0){
            $loginCredentialsDetails = $authenticationModel->getLoginCredentials($userID, null);
            $emailObscure = $securityModel->obscureEmail($loginCredentialsDetails['email']);
        }
        else{
            header('location: 404.php');
            exit;
        }
    }
    else {
        header('location: 404.php');
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
                        <h2 class="mb-1 fs-7 fw-bolder">Two Step <span class="text-primary">Verification</span></h2>
                        <p class="mb-7">We've sent a verification code to your email address. Please check your inbox and enter the code below.</p>
                        <h6 class="fw-bolder mb-4"><?php echo $emailObscure; ?></h6>
                        <form id="otp-form" method="post" action="#">
                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $userID; ?>">
                            <div class="form-group mb-3">
                                <div class="d-flex align-items-center gap-2 gap-sm-3">
                                    <input type="text" class="form-control text-center otp-input" id="otp_code_1" name="otp_code_1" autocomplete="off" maxlength="1">
                                    <input type="text" class="form-control text-center otp-input" id="otp_code_2" name="otp_code_2" autocomplete="off" maxlength="1">
                                    <input type="text" class="form-control text-center otp-input" id="otp_code_3" name="otp_code_3" autocomplete="off" maxlength="1">
                                    <input type="text" class="form-control text-center otp-input" id="otp_code_4" name="otp_code_4" autocomplete="off" maxlength="1">
                                    <input type="text" class="form-control text-center otp-input" id="otp_code_5" name="otp_code_5" autocomplete="off" maxlength="1">
                                    <input type="text" class="form-control text-center otp-input" id="otp_code_6" name="otp_code_6" autocomplete="off" maxlength="1">
                                 </div>
                            </div>
                        </form>
                        <div class="d-grid mt-4">
                            <button id="forgot-password" form="password-reset-form" type="submit" class="btn btn-primary w-100 py-8 mb-3 rounded-2">Verify</button>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2 mb-sm-0">
                                <p class="text-dark">Didn't get the code?</p>
                            </div>
                            <div class="col-6 text-end">
                                <p id="countdown" class="d-none">Resend code in <span id="timer">60</span> seconds</p>
                                <a href="Javascript:void(0);" id="resend-link" class="text-primary fw-medium ms-2">Resend Code</a>
                            </div>
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
    <script src="./components/authentication/js/otp-verification.js?v=<?php echo rand(); ?>"></script>
</body>
</html>