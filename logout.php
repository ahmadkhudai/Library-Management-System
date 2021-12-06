<?php
include 'inc/header.php';
// include './inc/state.php';

resetSession();
// header_remove("login");
// $_SESSION['user'] = 22;
// unset($_SESSION['user']);

redirect("login.php", $webBase);
// header($headers["login"]);
