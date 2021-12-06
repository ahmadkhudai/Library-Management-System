<!-- <div class="smol-book text-center col-10 col-sm-6 col-md-4 col-lg-3 mx-auto my-2">
  <figure>
    <img src="https://picsum.photos/100/160" alt="Book Cover" height="100%" width="100%" />
  </figure>
  <div>
    <p class="red-text" class="book-title">The Way of Kings</p>
    <p class="author">Brandon Sanderson</p>
  </div>
</div> -->

<!-- <style>
  .smol-book img {

    width: 70px;
  }
</style> -->

<!-- <div class="smol-book col-12 col-md-6 col-lg-5 row mx-auto px-0 align-items-center ak-soft-shadow border-radius-5 my-3 mx-lg-3">
  <figure class="col-6 mx-0 px-0 py-3">
    <img src="https://picsum.photos/100/160" alt="Book Cover" height="100%" width="100%" />
  </figure>
  <div class="col-4  mx-0 px-0 px-sm-2 py-3">
    <p class="red-text text-left" class="book-title">The Way of Kings</p>
    <p class="author text-left">Brandon Sanderson</p>
  </div>
  <div class="col-12 mx-0 px-0">
    <a href="#" class="red-text d-block mx-0 px-0 py-2 ">VIEW-></a>
  </div>
</div> -->

<?php

function getSmolBookTemplate($book, $mode)
{
  switch ($mode) {
    case 'BORROWED': {
        $mode = 'Return';
      }
      break;
    case 'RESERVED': {
        $mode = 'Cancel';
      }
      break;
  }

  // if (title.length > 20) {
  //   title =
  //     title.substring(0, 20) +
  //     "..." +
  //     title.substring(title.length - 10, title.length);
  // }


  $title = $book['title'];
  if (strlen($title) > 20) {
    $title = substr($title, 0, 20) . "..." . (substr(strlen($title) - 10, strlen($title)));
  }


  $author = $book['author'];
  if (strlen($author) > 16) {
    $author = substr($author, 0, 16) . "..." . (substr(-16, strlen($author)));
  }


  return
    '
  <div class="smol-book col-12 col-lg-5 row mx-auto px-0 align-items-center ak-outline border-radius-5 my-3 mx-lg-3">
    <figure class="col-6 mx-0 px-0 py-3">
      <img src="http://covers.openlibrary.org/b/isbn/' . $book['isbn13'] . '-M.jpg?default=false" alt="Book Cover" onerror="this.onerror=null;this.src=\'https://picsum.photos/100/160\';" height="100%" width="100%" />
    </figure>
    <div class="col-4  mx-0 px-0 px-sm-2 py-3">
      <p class="red-text text-left" class="book-title">' . $title . '</p>
      <p class="author text-left">' . $author . '</p>
    </div>
    <div class="col-12 mx-0 px-0">
      <a href="./bookView.php?current-book=' . $book['isbn13'] . '" class="red-text d-block mx-0 px-0 py-2 ">' . $mode . '-></a>
    </div>
  </div>
  ';
}
