<?php



function refreshViews()
{
    $_SESSION['indexView'] = 1;
    $_SESSION['categoryView'] = 1;
    $_SESSION['searchView'] = 1;
}


function checkCreds($userEmail, $pass, $libraryDB)
{
    $query = $sql = "SELECT * FROM `members` WHERE  `email_id` = \"$userEmail\"";
    $result = mysqli_query($libraryDB, $query);
    $currentUser = (mysqli_fetch_assoc($result));
    if (!$currentUser) {
        return null;
    } else {
        if ($currentUser['password'] === $pass) {
            return [$currentUser['id'], $currentUser['name'], $currentUser['user_img'], $currentUser['role']];
        }
    }

    return null;
}


function createUser($userName, $userEmail, $pass, $user_img,  $libraryDB)
{
    //first check if user already exists
    if (!is_null(checkCreds($userEmail, $pass, $libraryDB))) {
        // echo "USER ALREADY EXISTS!";
        return null;
    }

    $query = "INSERT INTO `members` (`id`, `name`, `email_id`, `password`, `user_img`, `role`) VALUES 
    (NULL, '$userName',  '$userEmail' , '$pass', '$user_img', '1')";
    $result = mysqli_query($libraryDB, $query);
    if ($result) {
        return checkCreds($userEmail, $pass, $libraryDB);
    }


    return null;
}

function setSession($userID, $userName, $userImg = "./uploads/img/cat.png", $userRole = 1)
{
    $_SESSION['user'] = $userID;
    $_SESSION['role'] = $userRole;
    $_SESSION['name'] = $userName;
    $_SESSION['user_img'] = $userImg;
    refreshViews();
}

function resetSession()
{
    $_SESSION = array();
    refreshSession();
}

function refreshSession()
{
    refreshViews();
}


function redirect($pageName, $webBase)
{

    // echo "https://$_SERVER[SERVER_NAME]/";
    $URL = $webBase . "/" . $pageName;
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}



function getAllBooks($libraryDB)
{
    $query = "SELECT * FROM `books` ORDER BY `added_at_timestamp` DESC";
    $result = mysqli_query($libraryDB, $query);

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function getBooksByCategory($catID, $libraryDB)
{
    $query = "SELECT * FROM `books`where category_id='$catID' ORDER BY `added_at_timestamp` DESC ";
    $result = mysqli_query($libraryDB, $query);

    if (mysqli_num_rows($result) > 0) {
        return (mysqli_fetch_all($result, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



function getReserved($currentBook = null, $libraryDB)
{
    $bookCheck = "";
    if ($currentBook != null) {
        $bookCheck =
            " and books.book_id = $currentBook[book_id]";
    }
    $resCheckQuery =
        "
        SELECT members.id,
        reserved_books.member_id,
        reserved_books.book_id,
        books.book_id
        FROM reserved_books
        INNER JOIN members ON members.id = reserved_books.member_id
        INNER JOIN books ON books.book_id = reserved_books.book_id  where members.id =  $_SESSION[user]" . $bookCheck;

    $result = mysqli_query($libraryDB, $resCheckQuery);
    if (mysqli_num_rows($result) > 0) {
        return (mysqli_fetch_all($result, MYSQLI_ASSOC));
    } else {
        return null;
    }
}

function getBorrowed($currentBook = null, $libraryDB)
{
    $bookCheck = "";
    if ($currentBook != null) {
        $bookCheck =
            " and books.book_id = $currentBook[book_id]";
    }

    if (!isset($_SESSION['user'])) {
        return null;
    }

    $resCheckQuery =
        "
        SELECT members.id,
        borrowed_books.member_id,
        borrowed_books.book_id,
        books.book_id
        FROM borrowed_books
        INNER JOIN members ON members.id = borrowed_books.member_id
        INNER JOIN books ON books.book_id = borrowed_books.book_id where members.id =  " . $_SESSION['user'] . " " . $bookCheck;

    $result = mysqli_query($libraryDB, $resCheckQuery);
    // echo  mysqli_info($libraryDB);
    // echo $resCheckQuery;
    // echo 
    if (mysqli_num_rows($result) > 0) {
        return (mysqli_fetch_all($result, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



function reserveBook($currentBook, $libraryDB)
{
    // return ($currentBook);
    //check if book hasn't already been borrowed or reserved
    if (is_null(getBorrowed($currentBook, $libraryDB)) and is_null(getBorrowed($currentBook, $libraryDB))) {
        //check book amount
        //this check is important because someone else might have borrowed the book
        $query = "SELECT * FROM `books` WHERE book_id= $currentBook[book_id] and amount > 1";

        $result = mysqli_query($libraryDB, $query);
        if (mysqli_num_rows($result) > 0) {
            //add to res table
            $query = "INSERT INTO `reserved_books` (`issue_id`, `book_id`, `member_id`, `added_at_timestamp`) VALUES (NULL, $currentBook[book_id] ,$_SESSION[user], current_timestamp())";
            $result = mysqli_query($libraryDB, $query);
            //negate book amount
            $query = "UPDATE `books` SET amount = amount-1
            WHERE `book_id`=$currentBook[book_id]";
            $result = mysqli_query($libraryDB, $query);
            return $result;
        }
    }
    return null;
}

function cancelBookReservation($currentBook, $libraryDB)
{
    // return ($currentBook);
    //check if book hasn't already been borrowed or reserved

    if (!is_null(getReserved($currentBook, $libraryDB))) {
        //add to res table
        $query = "DELETE FROM `reserved_books` WHERE book_id = $currentBook[book_id] and member_id = $_SESSION[user]";
        $result = mysqli_query($libraryDB, $query);
        //negate book amount
        $query = "UPDATE `books` SET amount = amount+1
            WHERE `book_id`=$currentBook[book_id]";
        $result = mysqli_query($libraryDB, $query);
        return $result;
    }
    return null;
}


function borrowBook($currentBook, $libraryDB)
{
    // return ($currentBook);
    //check if book hasn't already been borrowed or reserved by current user
    if (is_null(getBorrowed($currentBook, $libraryDB)) and is_null(getBorrowed($currentBook, $libraryDB))) {
        //check book amount
        //this check is important because someone else might have borrowed the book
        $query = "SELECT * FROM `books` WHERE book_id= $currentBook[book_id] and amount > 0";

        $result = mysqli_query($libraryDB, $query);
        if (mysqli_num_rows($result) > 0) {
            //add to res table

            cancelBookReservation($currentBook, $libraryDB);
            $query = "INSERT INTO `borrowed_books` (`id`, `book_id`, `member_id`, `issued_time`, `return_time`, `time_stamp`) VALUES (NULL, $currentBook[book_id], $_SESSION[user], 'current_timestamp()', 'DATE_ADD(NOW(), INTERVAL 10 DAY)', current_timestamp())";
            $result = mysqli_query($libraryDB, $query);
            //negate book amount
            $query = "UPDATE `books` SET amount = amount-1
            WHERE `book_id`=$currentBook[book_id]";
            $result = mysqli_query($libraryDB, $query);
            return $result;
        }
    }
    return null;
}


function returnBook($currentBook, $libraryDB)
{
    // return ($currentBook);
    //check if book hasn't already been borrowed or reserved

    if (!is_null(getBorrowed($currentBook, $libraryDB))) {
        //add to res table
        $query = "DELETE FROM `borrowed_books` WHERE book_id = $currentBook[book_id] and member_id = $_SESSION[user]";
        $result = mysqli_query($libraryDB, $query);
        //negate book amount
        $query = "UPDATE `books` SET amount = amount+1
            WHERE `book_id`=$currentBook[book_id]";
        $result = mysqli_query($libraryDB, $query);
        return $result;
    }
    return false;
}


function checkIfBorrowed($currentBook, $libraryDB)
{
    $bookCheck = "";


    // if (!isset($_SESSION['user'])) {
    //     return null;
    // }

    $resCheckQuery =
        "select * from `borrowed_books` where book_id= $currentBook[book_id]";

    $result = mysqli_query($libraryDB, $resCheckQuery);
    // echo  mysqli_info($libraryDB);
    // echo $resCheckQuery;
    // echo 
    if (mysqli_num_rows($result) > 0) {
        return (mysqli_fetch_all($result));
    } else {
        return null;
    }
}



// Delete book 
function deleteBook($currentBook, $libraryDB)
{
    cancelAllReservations($currentBook['book_id'], $libraryDB);
    if (checkIfBorrowed($currentBook, $libraryDB) != null) {
        return null;
    }
    $sql = "DELETE FROM `books` WHERE `books`.`book_id` = $currentBook[book_id]";
    $result = mysqli_query($libraryDB, $sql);
    return $result;
}




function cancelAllReservations($currentBookID, $libraryDB)
{

    if ($currentBookID == null) {
        //REMOVE ALL RESERVATION FOR USER
        $reservedBooks = getAllReservedBooks($libraryDB);

        // $numofbooks = 0;
        // if (!is_null(getReserved($currentBook, $libraryDB))) {
        //add to res table

        foreach ($reservedBooks as $book) {
            //delete reservation from table
            $query = "DELETE FROM `reserved_books` WHERE member_id = $_SESSION[user] and book_id = $book[book_id]";
            $result = mysqli_query($libraryDB, $query);

            //increment book amount in books table
            $query = "UPDATE `books` SET amount = amount+1
            WHERE `book_id`=$book[book_id]";
            $result = mysqli_query($libraryDB, $query);
        }

        // return $result;



        return;
    }
    // return ($currentBook);
    //check if book hasn't already been borrowed or reserved
    $query = "Select * FROM `reserved_books` WHERE book_id = $currentBookID";
    $result = mysqli_query($libraryDB, $query);
    // return ;
    $numofbooks = mysqli_num_rows($result);
    // return ($numofbooks);

    if ($numofbooks == 0) {
        return;
    }
    // $numofbooks = 0;
    // if (!is_null(getReserved($currentBook, $libraryDB))) {
    //add to res table
    $query = "DELETE FROM `reserved_books` WHERE book_id = $currentBookID";
    $result = mysqli_query($libraryDB, $query);
    //negate book amount
    // $numofbooks = mysqli_num_rows($result);
    // return ($numofbooks);
    for ($i = $numofbooks; $i > 0; $i--) {
        $query = "UPDATE `books` SET amount = amount+1
        WHERE `book_id`=$currentBookID";
        $result = mysqli_query($libraryDB, $query);
        // return $result;
    }
    // }
    // return null;
}


//GET ALL BOOKS BORROWED BY "CURRENT" USER
function getAllBorrowedBooks($libraryDB)
{
    $BorrowedInfo = getBorrowed(null, $libraryDB);
    $books = [];

    if ($BorrowedInfo == null) {
        return null;
    }

    foreach ($BorrowedInfo as $row) {
        $bookID = $row['book_id'];
        $query = "select * from `books` where book_id = '$bookID'";
        $result = mysqli_query($libraryDB, $query);
        $book =  mysqli_fetch_all($result, MYSQLI_ASSOC);
        // append($books, $book);

        // $books.append($book);
        array_push($books, $book[0]);
    }

    return $books;
}


function getAllReservedBooks($libraryDB)
{
    $ReservationInfo = getReserved(null, $libraryDB);
    $books = [];

    if ($ReservationInfo == null) {
        return null;
    }

    foreach ($ReservationInfo as $row) {
        $bookID = $row['book_id'];
        $query = "select * from `books` where book_id = '$bookID'";
        $result = mysqli_query($libraryDB, $query);
        $book =  mysqli_fetch_all($result, MYSQLI_ASSOC);
        // append($books, $book);

        // $books.append($book);
        array_push($books, $book[0]);
    }

    return $books;
}
