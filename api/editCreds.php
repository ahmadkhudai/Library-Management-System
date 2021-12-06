<?php

include '../connect.php';
include '../inc/state.php';
include '../inc/utilities.php';

if (!isset($_SESSION["user"])) {

    redirect('index.php', $webBase);
}

// echo $_SESSION["user"];

if (isset($_POST['username']) && $_POST['username'] != '') {
    // echo ($_POST['username']);

    $sql = "UPDATE `members` set `name`= '$_POST[username]' WHERE id = $_SESSION[user]";
    $result = mysqli_query($libraryDB, $sql);
    $_SESSION['name'] =  $_POST['username'];
    header("location:../userView.php");
} else if (isset($_POST['email']) && $_POST['email'] != '') {
    $sql = "UPDATE `members` set `email_id`= '$_POST[email]' WHERE id = $_SESSION[user]";
    $result = mysqli_query($libraryDB, $sql);
    header("location:../logout.php");

    // echo ($_POST['email']);
} else if (isset($_POST['password']) && $_POST['password'] != '') {

    $sql = "UPDATE `members` set `password`= '$_POST[password]' WHERE id = $_SESSION[user]";
    $result = mysqli_query($libraryDB, $sql);
    header("location:../logout.php");
} else {
    echo "error";
    $_SESSION['editCreds']['err'] = "Creds NOT changed!";
}
// Takes raw data from the request

// $editNameQuery = "UPDATE `members` set `name`=? WHERE id = ?";

// UPDATE `members` set `name`="kasim" WHERE id = 3
