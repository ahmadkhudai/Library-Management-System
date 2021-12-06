<?php include 'inc/header.php';

$isbn = "";
if (isset($_GET["current-book"])) {
    $isbn = $_GET["current-book"];
} else if (isset($_SESSION["current-book"])) {
    $isbn = $_SESSION["current-book"]["isbn13"];
} else {
    header("location:index.php");
}


?>

<body>
    <?php include './components/php/main-nav.php' ?>

    <div class="my-5 mx-auto" id="main-body">

        <?php include 'components/search-bar.html'; ?>
        <div class="row mx-3 mt-5">



            <div class="col-12 col-md-9 container" id="main-view-panel">

                <?php
                if (isset($_SESSION['bookView']['err'])) {
                    //set 
                    $msg = $_SESSION['bookView']['err'];
                    $_SESSION['bookView'] = null;


                    echo
                    '
                <div id="err_msg" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ' . $msg . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            
                ';
                }


                // echo "<h1>" .  . "</h1>";
                ?>
                <?php include './components/php/book-view-card.php';
                // $books = getAllBooks($libraryDB);
                // print_r($books);

                // print_r($_SESSION["current-book"]);
                echo (createBookViewCard($isbn, $libraryDB));
                ?>


            </div>





        </div>
    </div>
    <?php include "components/footer.html"; ?>

    <?php include 'inc/footer.php'; ?>