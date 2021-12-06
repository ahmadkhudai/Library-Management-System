<?php

include '../connect.php';
include "../inc/state.php";
include '../inc/utilities.php';


// Takes raw data from the request

if ((!isset($_GET) || $_GET == array()) ||
    (!isset($_SESSION['user']) || $_SESSION['role'] != '0')
) {
    redirect('index.php', $webBase);
}



$isbn = $_GET['current-book'];

$query = $sql = "SELECT * FROM `books` WHERE  `isbn13` ='" . $isbn . "'";
$result = mysqli_query($libraryDB, $query);
$currentBook = (mysqli_fetch_assoc($result));
// $_SESSION['current-book'] = $currentBook;
// cancelAllReservations('10', $libraryDB);
// print_r($currentBook);

if (deleteBook($currentBook, $libraryDB) == null) {
    $_SESSION['index']['err'] = "Borrowed Books Must be returned before deletion!";
} else {
    $_SESSION['index']['msg'] = "Successfully Deleted!";
}



redirect('index.php', $webBase);

// CHECK IF BOOK IS BORROWED


// $sTerm = $data;
// if (strlen($sTerm) > 2) {


//     if (!$libraryDB) {
//         die("ERROR!" + mysqli_connect_error());
//     }


//     // $sql = "SELECT searchterm FROM searchhistory where searchterm like '$sTerm'%";

//     $sql = "SELECT * FROM `books`  where title like '%$sTerm%' or author like '%$sTerm%'";
//     $queryResult = mysqli_query($libraryDB, $sql);


//     if (mysqli_num_rows($queryResult) > 0) {

//         echo json_encode(mysqli_fetch_all($queryResult));
//     } else {
//         echo json_encode("error");
//     }
//     // mysqli_close($conn);
// }
