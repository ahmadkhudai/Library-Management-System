<?php
include '../connect.php';
include './utilities.php';
include './state.php';

// header_remove("login");
// if (isset($_SESSION['user'])) {

//     redirect("userView.php", $webBase);
//     // header($headers["user-view"]);
// } else {
// }

if (isset($_POST['login-email']) && isset($_POST['login-pass'])) {
    $userEmail = filter_var(
        $_POST['login-email'],
        FILTER_SANITIZE_STRING
    );
    $pass = filter_var(
        $_POST['login-pass'],
        FILTER_SANITIZE_STRING
    );
    [$currentUserId, $currentUserName, $user_img, $currentUserRole] = checkCreds($userEmail, $pass, $libraryDB);
    if (!is_null($currentUserId)) {
        setSession($currentUserId, $currentUserName, $user_img, $currentUserRole);
        $_SESSION['manage_login']['err']  = "kdsfjl";
        redirect("userView.php", $webBase);
    } else {
        $_SESSION['manage_login']['err'] = "Incorrect Email or Password!";
    }
} else if (
    isset($_POST['signup-email']) && isset($_POST['signup-pass']) && isset($_POST['username'])
) {
    $userName = filter_var(
        $_POST['username'],
        FILTER_SANITIZE_STRING
    );
    $userEmail = filter_var(
        $_POST['signup-email'],
        FILTER_SANITIZE_STRING
    );
    $pass = filter_var(
        $_POST['signup-pass'],
        FILTER_SANITIZE_STRING
    );
    [$currentUserId, $currentUserName, $user_img, $currentUserRole] = createUser($userName, $userEmail,  $pass, './uploads/img/cat.png', $libraryDB);

    // if (isset($_SESSION['user'])) {
    //     redirect("userView.php", $webBase);
    // }


    if (!is_null($currentUserId) && (!(isset($_SESSION['user'])))) {
        setSession($currentUserId, $currentUserName, $user_img, $currentUserRole);
    }
}
redirect("userView.php", $webBase);
