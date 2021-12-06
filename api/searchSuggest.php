<?php

include '../connect.php';


// Takes raw data from the request
$json = file_get_contents('php://input');


// Converts it into a PHP object
$data = json_decode($json);





$sTerm = $data;
if (strlen($sTerm) > 2) {


    if (!$libraryDB) {
        die("ERROR!" + mysqli_connect_error());
    }


    // $sql = "SELECT searchterm FROM searchhistory where searchterm like '$sTerm'%";

    $sql = "SELECT * FROM `books`  where title like '%$sTerm%' or author like '%$sTerm%'";
    $queryResult = mysqli_query($libraryDB, $sql);


    if (mysqli_num_rows($queryResult) > 0) {

        echo json_encode(mysqli_fetch_all($queryResult));
    } else {
        echo json_encode("error");
    }
    // mysqli_close($conn);
}
