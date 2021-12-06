<?php include 'inc/header.php';

[$books, $query] = getFoundBooks($libraryDB);
?>

<body>
  <?php include './components/php/main-nav.php' ?>

  <div class="my-5 mx-auto" id="main-body">

    <?php include 'components/search-bar.html'; ?>
    <div class="row mx-3 mt-5">
      <div class="col-8 col-lg-12 p-2 mx-auto">

        <?php include 'components/php/page-banner.php';
        echo createPageBanner("Search Results");
        ?>
      </div>

      <div class="col-12 col-md-8 mt-4 mx-auto text-center">
        <p class="red-text">Results for your query</p>
        <?php
        if ($books != null) {
          echo "<p>'$query' (" . count($books) . " results)</p>";
        }
        ?>

        <div class="red-bar"></div>

      </div>
      <div class="col-11 col-md-8 container" id="main-view-panel">

        <?php include './components/php/book-card.php';

        if ($books == null) {
          echo '<p id="error-msg">NO BOOKS FOUND!</p>';
        } else {
          foreach ($books as $book) {
            print createBookCard($book["title"], $book["author"], $book["amount"], getCategory($book["category_id"]), $book["isbn13"]);
          }
        }

        // print createBookCard("The Way of Kings", "BrandoSando", 10, "fantasy, fiction", "lmfao");
        ?>

      </div>


    </div>
  </div>




  <?php include "components/footer.html"; ?>
  <?php include 'inc/footer.php'; ?>


  <?php


  //search for books in $_get request


  function getFoundBooks($libraryDB)
  {
    if (isset($_GET["search-area"])) {
      $sTerm = $_GET["search-area"];
      if (strlen($sTerm) > 2) {


        if (!$libraryDB) {
          die("ERROR!" + mysqli_connect_error());
        }


        // $sql = "SELECT searchterm FROM searchhistory where searchterm like '$sTerm'%";

        $sql = "SELECT * FROM `books`  where title like '%$sTerm%' or author like '%$sTerm%'";
        $queryResult = mysqli_query($libraryDB, $sql);

        $books = [];

        if (mysqli_num_rows($queryResult) > 0) {
          while (($book = mysqli_fetch_assoc($queryResult)) != null) {
            array_push($books, $book);
          }


          return [$books, $sTerm];
          // print_r(mysqli_fetch_all($queryResult));
        } else {
          return null;
        }
        // mysqli_close($conn);
      }
    }

    return null;
  }
