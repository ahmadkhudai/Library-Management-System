<?php include 'inc/header.php';

header_remove("login");
if (isset($_SESSION['user'])) {

    redirect("userView.php", $webBase);
    // header($headers["user-view"]);
} else {
}
// echo $_SESSION['user'];

?>

<body>
    <?php include './components/php/main-nav.php' ?>

    <div class="my-5 mx-auto row" id="main-body">
        <div class="row mx-auto container-sm col-12 col-md-6 col-lg-4">

            <div id="login-panel" class="col-10 col-lg-12 mx-auto" onkeyup="checkFormValidation(this.id)">
                <div class="col-12 text-center my-3">
                    <h1 class="banner d-inline-block">LOGIN</h1>
                </div>
                <form action="./inc/manage_login.php" method="post">
                    <div class="form-group">
                        <label for="login-email">Email address</label>
                        <input type="email" class="form-control" id="login-email" name="login-email" aria-describedby="emailHelp" placeholder="Enter email" />
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="login-pass">Password</label>
                        <input type="password" class="form-control" id="login-pass" name="login-pass" placeholder="Password" />
                    </div>
                </form>
                <button class="btn ak-red-bkg text-white disabled" id="login-panel-button">
                    Login
                </button>
                <div class="py-3">
                    <p>
                        Don't have an account?
                        <span><button type="submit" class="blue-text d-inline black-underline" onclick="hideOther()">
                                Sign Up
                            </button></span>
                    </p>
                </div>
            </div>

            <div id="signup-panel" class="col-10 col-lg-12 mx-auto d-none" onkeyup="checkFormValidation(this.id)">
                <div class="col-12 mx-auto text-center my-3">
                    <h1 class="banner d-inline-block">Sign up</h1>
                </div>
                <form action="./inc/manage_login.php" method="post">
                    <div class="form-group">
                        <label for="uni-id">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your name..." />
                    </div>
                    <div class="form-group">
                        <label for="login-email">Email address</label>
                        <input type="email" class="form-control" id="signup-email" name="signup-email" aria-describedby="emailHelp" placeholder="Enter email" />
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="signup-pass">Password</label>

                        <input type="password" class="form-control" id="signup-pass" name="signup-pass" placeholder="Your Password" />
                        <small id="passHelp" class="form-text text-muted">Two or more characters.</small>
                    </div>
                </form>
                <button class="btn ak-blue-bkg text-white disabled" id="signup-panel-button">
                    Sign Up
                </button>
                <div class="py-3">
                    <p>
                        Already have an account?
                        <button class="red-text black-underline" onclick="hideOther()">
                            Login
                        </button>
                    </p>
                </div>
            </div>

            <div class="col-10 col-lg-12 mx-auto">

                <?php
                if (isset($_SESSION['manage_login']['err'])) {
                    //set 
                    $msg = $_SESSION['manage_login']['err'];
                    $_SESSION['manage_login'] = null;


                    echo
                    '
                <div id="err_msg" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ' . $msg . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <script>
                setTimeout(() => {
                    $("#err_msg").hide()
                }, 2500);
            </script>
                ';
                }
                ?>

            </div>
        </div>
    </div>
    <hr class="col-3 row mx-auto align-items-center my-5" />

    <ak-footer></ak-footer>

    <script src="components/componentLoader.js"></script>
    <!-- <script src="js/utilities.js"></script> -->

    <?php include "components/footer.html"; ?>


    <?php include 'inc/footer.php'; ?>



    <?php

    // if (isset($_POST['login-email']) && isset($_POST['login-pass'])) {
    //     $userEmail = filter_var(
    //         $_POST['login-email'],
    //         FILTER_SANITIZE_STRING
    //     );
    //     $pass = filter_var(
    //         $_POST['login-pass'],
    //         FILTER_SANITIZE_STRING
    //     );
    //     [$currentUserId, $currentUserName, $user_img, $currentUserRole] = checkCreds($userEmail, $pass, $libraryDB);
    //     if (!is_null($currentUserId)) {
    //         setSession($currentUserId, $currentUserName, $user_img, $currentUserRole);
    //         redirect("userView.php", $webBase);
    //     } else {
    //     }
    // } else if (
    //     isset($_POST['signup-email']) && isset($_POST['signup-pass']) && isset($_POST['username'])
    // ) {
    //     $userName = filter_var(
    //         $_POST['username'],
    //         FILTER_SANITIZE_STRING
    //     );
    //     $userEmail = filter_var(
    //         $_POST['signup-email'],
    //         FILTER_SANITIZE_STRING
    //     );
    //     $pass = filter_var(
    //         $_POST['signup-pass'],
    //         FILTER_SANITIZE_STRING
    //     );
    //     [$currentUserId, $currentUserName, $user_img, $currentUserRole] = createUser($userName, $userEmail,  $pass, './uploads/img/cat.png', $libraryDB);

    //     if (!is_null($currentUserId)) {
    //         setSession($currentUserId, $currentUserName, $user_img, $currentUserRole);
    //         redirect("userView.php", $webBase);
    //     } else {
    //     }
    // }
