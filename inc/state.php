<?php

session_start();


$webBase = "http://localhost/project4";
if ($_SERVER["SERVER_NAME"] != "localhost") {
    $webBase = "http://" . $_SERVER["SERVER_NAME"];
}
$headers =
    [
        "user-view" => "location:userView.php",
        "login" => "location:login.php"
    ];


$libraryName = "Local University Library";

function getCategory($catID)
{
    $categories = [
        1 => "Academic Books",
        2 => "Non-Fiction",
        3 => "Fantasy & Fiction"
    ];
    switch ($catID) {
        case '1':
            return $categories[1];

        case '2':
            return $categories[2];

        case '3':
            return $categories[3];

        default:
            return "RECENT BOOKS";
    }
}

// set category for page to read
$cat = "0";
if (isset($_GET["cat"])) {
    $cat = $_GET["cat"];
}

// $_SESSION['user'] = '1';
// $_SESSION['indexView'] = '1';
// $_SESSION['categoryView'] = '1';
// $_SESSION['searchView'] = '1';
