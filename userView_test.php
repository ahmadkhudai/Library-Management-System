<?php

include 'inc/header.php';
include 'components/php/related-books.php';

if (!isset($_SESSION['user'])) {
    header($headers["login"]);
}

$borrowedBooks = getBorrowed(null, $libraryDB) ?? array();
$reservedBooks = getReserved(null, $libraryDB) ?? array();

// echo $_SESSION["user_img"];
// echo "./uploads/img/cat.png";

// $userData = $libraryDB.

?>

<body>
    <?php include './components/php/main-nav.php' ?>

    <div class="my-5 mx-auto" id="main-body">

        <div class="row mx-3 mt-5">
            <div class="col-12  mx-auto text-center my-3">

                <h1 class="banner  d-inline-block ">USER PROFILE</h1>
            </div>

            <!-- <div class="col-12 mx-auto text-center mt-4">

                <h3 class="d-inline-block ">AHMAD TUFAIL</h3>
            </div> -->
            <div class="col-12 col-sm-10 row mx-auto align-items-center my-4">
                <div class="col-12  p-0 my-auto ">
                    <div class="col-12 m-0 text-center">
                        <h3 class="d-inline-block "><?php echo $_SESSION["name"] ?></h3>
                        <figure class="user-face col-12">
                            <img class="rounded-circle" src="<?php echo $_SESSION["user_img"] ?>" alt="">
                            <!-- <img class="rounded-circle" src="https://picsum.photos/100/100" alt=""> -->
                        </figure>
                    </div>
                </div>

                <div class="col-12 p-0 ">
                    <div class="col-12 text-center">


                        <div class="col-12 ">

                            <p>Books Borrowed: <span><?php echo count($borrowedBooks) ?></span></p>
                            <p>Books Reserved: <span><?php echo count($reservedBooks) ?></span></p>
                            <!-- <p class="bold-text">Books Overdue: <span>2</span></p>
                            <p>Joined on: <span>13/20/2020</span></p> -->
                        </div>

                    </div>

                </div>


            </div>


            <hr class=" col-3 row mx-auto align-items-center mb-4">
            <div class="col-12 col-sm-10 row mx-auto align-items-center my-4">

                <div class="col-12  p-0 ">
                    <div class="col-12 m-0 text-center">
                        <h3 class="d-inline-block ">User<br>Options</h3>
                    </div>

                </div>

                <div class="col-12 col-md-6 col-lg-4 mx-auto text-center">
                    <div class="col-12 text-center">
                        <button class="ak-button ak-blue-bkg col-8 col-lg-12"> <a href="./userOptions.php" class="text-white">SETTINGS</a></button>
                        <button class="ak-button ak-blue-bkg col-8 col-lg-12"><a href="#borrowed-books" class="text-white">BORROWED BOOKS</a></button>
                        <!-- <button class="ak-button ak-blue-bkg col-8 col-lg-12"><a href="#overdue-books" class="text-white">OVERDUE BOOKS</a></button> -->
                        <button class="ak-button ak-blue-bkg col-8 col-lg-12"><a href="#reserved-books" class="text-white">RESERVED BOOKS</a></button>
                        <form action="./logout.php">
                            <button type="submit" class="ak-button ak-red-bkg col-8 col-lg-12">LOG OUT</button>
                        </form>
                    </div>
                    <hr class=" col-3 row mx-auto align-items-center my-4">
                </div>



                <?php if ($borrowedBooks > 0) {
                    echo
                        ' 
                    <div id="borrowed-books" class="col-12  my-4">
                        ' . createRelatedBooks("BORROWED", $libraryDB) . '
                    </div>

                    ';
                }
                ?>


                <?php if ($reservedBooks > 0) {
                    echo
                        ' 
                    <div id="reserved-books" class="col-12  my-4">
                        ' . createRelatedBooks("RESERVED", $libraryDB) . '
                    </div>

                    ';
                }
                ?>






                <!-- <div class="col-12 col-lg-7 row material-shadow my-3 mx-auto">
</div> -->

            </div>





        </div>
    </div>
    <?php include "components/footer.html"; ?>
    <?php include 'inc/footer.php'; ?>