<?php include 'inc/header.php';
include './components/php/book-card.php';


?>

<body>
  <?php include './components/php/main-nav.php'; ?>


  <div class="my-5 mx-auto  row" id="main-body">
    <?php include 'components/search-bar.html'; ?>

    <div class="row mx-auto mt-5 container-sm col-12 col-sm-10 col-xl-12">
      <div class="col-8 col-lg-12 p-2 mx-auto">

        <?php include './components/php/page-banner.php';
        echo createPageBanner(getCategory($cat));

        ?>
      </div>

      <div class="col-12 col-lg-8 container-sm mx-auto" id="main-view-panel">
        <?php
        if (isset($_SESSION['index']['err'])) {
          //set 
          $msg = $_SESSION['index']['err'];
          $_SESSION['index'] = null;


          echo
          '
                <div id="err_msg" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ' . $msg . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <script>
                setTimeout(() => {
                    $("#err_msg").hide()
                }, 2500);
            </script>
                ';
        } else if (isset($_SESSION['index']['msg'])) {
          $msg = $_SESSION['index']['msg'];
          $_SESSION['index'] = null;
          echo
          '
          <div id="err_msg" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> ' . $msg . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <script>
                setTimeout(() => {
                    $("#err_msg").hide()
                }, 2500);
            </script>
          ';
        }

        $books = getAllBooks($libraryDB);
        foreach ($books as $book) {
          print createBookCard($book["title"], $book["author"], $book["amount"], getCategory($book["category_id"]), $book["isbn13"]);
        }

        ?>



      </div>


      ?>
    </div>
  </div>

  <?php include "components/footer.html"; ?>

  <?php include 'inc/footer.php'; ?>