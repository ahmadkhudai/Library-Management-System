<?php
include '../connect.php';
include "../inc/state.php";
include '../inc/utilities.php';

//check if a user is signed in
if (isset($_SESSION['user'])) {

    if (getBorrowed(null, $libraryDB) != null) {
        $_SESSION['deleteUser']['err'] = "You MUST return all borrowed Books before deleting your account!";
        redirect('userView.php', $webBase);
    } else {
        if (getReserved(null, $libraryDB) != null) {
            //return all reserved
            cancelAllReservations(null, $libraryDB);
        }

        //now delete the user
        $query = "DELETE FROM `members` WHERE `members`.`id` = $_SESSION[user]";
        $result = mysqli_query($libraryDB, $query);
        redirect('logout.php', $webBase);
    }
}
redirect('index.php', $webBase);
