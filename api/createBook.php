<?php

include '../connect.php';

// $_POST -> Array ( [title] => The Way of Kings [author] => Brandon Sanderson 
// [publisher] => Tor inc [isbn13] => 9780765365279 [amount] => 1 [description] => jkj ) 

// print_r($_POST);



$sql = "
INSERT INTO `books` (`book_id`, `title`, `author`, `isbn13`, `publisher`, `amount`, `description`, `category_id`, `added_at_timestamp`) VALUES  
(NULL, ?, ?, ?, ?, ?, ?, ?, current_timestamp())
";



$qResult = mysqli_prepare($libraryDB, $sql);

// $addBookQuery = mysqli_prepare($libraryDB,)

[$title, $author, $publisher, $isbn13, $amount, $category_id, $description]
    = array($_POST["title"], $_POST["author"], $_POST["publisher"], $_POST["isbn13"], $_POST["amount"], $_POST["category_id"], $_POST["description"]);
// [$_POST["title", "publisher", "isbn"];

//execution
mysqli_stmt_bind_param($qResult, "ssssisi", $title, $author, $isbn13, $publisher, $amount, $description, $category_id);

print_r(mysqli_stmt_execute($qResult));

// print_r($qResult);

header("location:../index.php");
