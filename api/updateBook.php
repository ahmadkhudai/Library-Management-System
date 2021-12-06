<?php


include '../connect.php';
include '../inc/state.php';



// $isbn13 = '';
// $amount = '';
// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

if (!isset($_SESSION['user']) || $_SESSION['role'] != '0') {
    header('HTTP/1.1 401 AUTHENTICATION ERROR');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'ERROR: YOU DO NOT HAVE PRIVILEGES FOR THIS OPERATION.', 'code' => 401)));
}

$bookID = $data->id;
$bookAmount = $data->amount;

if (is_int($bookAmount) && is_int($bookID) && $bookAmount >= 0 && $bookAmount < 999) {
    $query = "select * from books where book_id = $bookID";
    $result = mysqli_query($libraryDB, $query);

    //check if book amount is already equal to the given $bookAmount
    $book =  mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
    if ($book['amount'] == $bookAmount) {
        echo json_encode($data);
    } else {
        if (mysqli_num_rows($result) == 1) {
            $query = "update books set amount=$bookAmount where book_id=$bookID";
            $result = mysqli_query($libraryDB, $query);
            if (mysqli_affected_rows($libraryDB) > 0) {
                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                header('HTTP/1.1 500 DB ERROR');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('message' => 'ERROR: Amount change failed.', 'code' => 500)));
                // echo json_encode($data->err = "Amount change failed");
            }
        }
    }
} else {
    header('HTTP/1.1 422 BAD INPUT');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'ERROR: Invalid Data! Amount change failed.', 'code' => 422)));
    // echo json_encode($data->err = "Amount change failed");
}




// $query = "select * from books where book_id = 13";
// $result = mysqli_query($libraryDB, $query);

// $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
// foreach ($data as $key => $value) {
//     fwrite($myfile, $key . "->" . $value);
//     // print "$key => $value\n";
// }

// fclose($myfile);

// // echo json_encode($data[0]);
// echo json_encode(mysqli_num_rows($result));
// // echo $data;
// print_r($data);
