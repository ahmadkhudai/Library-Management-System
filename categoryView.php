<?php include 'inc/header.php' ?>

<body>
  <?php
  include './components/php/main-nav.php';
  include './components/php/book-card.php';




  $books = getBooksByCategory($cat, $libraryDB);

  $bookCount = 0;
  if ($books != null) {
    $bookCount = count($books);
  }

  // echo $categories[$_GET["cat"]];

  // print_r($_SESSION["jj"]);
  // print_r($_SESSION["academy"]);


  ?>


  <div class="my-5 mx-auto row" id="main-body">

    <?php include 'components/search-bar.html'; ?>
    <div class="row mx-auto mt-5 container-sm col-12 col-sm-10 col-xl-12">
      <div class="col-8 col-lg-12 p-2 mx-auto ">

        <?php include './components/php/page-banner.php';
        echo createPageBanner(getCategory($cat));

        ?>

      </div>

      <div class="col-12 col-md-8 mt-4 mx-auto text-center">
        <p class="red-text">Showing all books in <?php echo getCategory($cat); ?></p>
        <p> <?php echo getCategory($cat);
            echo " ($bookCount)"; ?></p>


      </div>
      <div class="col-11 col-md-8 container" id="main-view-panel">
        <?php
        if ($books == null) {
          echo '<p id="error-msg">NO BOOKS FOUND!</p>';
        } else {
          foreach ($books as $book) {
            print createBookCard($book["title"], $book["author"], $book["amount"], getCategory($book["category_id"]), $book["isbn13"]);
          }
        }

        ?>
      </div>



    </div>
  </div>

  <?php include "components/footer.html"; ?>

  <?php include 'inc/footer.php'; ?>