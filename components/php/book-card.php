<?php

function createBookCard($title, $author, $amount, $category, $isbn)
{
  $deleteBookForm = '';
  if (isset($_SESSION['user']) && $_SESSION['role'] == '0') {
    $deleteBookForm =
      '
    <form action="./api/deleteBook.php" method="get">
        <input name="current-book" type="text" class="d-none" value="' . $isbn . '">
        <button class="ak-dark-bkg text-white p-1 border-radius-5" type="submit"  onclick="return confirm(\'Are you sure? This action is irreversible\');">DELETE</button>
      </form>
    
      
    ';
  }
  return
    '
    <div class="book-card ak-opacity-5">
  <div class="book my-3 row p-3 ">
    <h4
      class="col-12 red-text d-block d-sm-none text-center mt-2"
      class="book-title"
    >
      ' . $title . '
    </h4>
    <figure class="col-10 col-sm-4 my-4 my-sm-0">
    <img src="http://covers.openlibrary.org/b/isbn/' . $isbn . '-M.jpg?default=false" alt="Book Cover" onerror="this.onerror=null;this.src=\'https://picsum.photos/100/160\';" height="100%" width="100%" />
      
    </figure>
    <div class="col-10 col-sm-8 col-md-4 text-center text-sm-left">
      <p class="red-text d-none d-sm-block" class="book-title">
      ' . $title . '
      </p>
      <p class="author">' . $author . '</p>
      <p class="category">Category: ' . $category . '</p>
    </div>
    <div class="col-sm-12 col-md-4 ml-auto text-center">
      <p>Available: ' . $amount . '</p>
      <form action="./bookView.php" method="get">
        <input name="current-book" type="text" class="d-none" value="' . $isbn . '">
        <button type="submit">View-></button>
      </form>
      ' . $deleteBookForm . '
     
    </div>
  </div>
</div>

    ';
}

?>





<!-- <form action="./bookView.php" method="post">
    <input type="text" class="d-none" value="">
    <button type="submit">View-></button>
</form> -->

<!-- <button onclick="location.href=\'./bookView.php\'">View-></button> -->