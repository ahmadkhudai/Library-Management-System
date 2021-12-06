<?php

function createBookViewCard($isbn, $libraryDB)
{


  $query = $sql = "SELECT * FROM `books` WHERE  `isbn13` = " . $isbn . "";
  $result = mysqli_query($libraryDB, $query);
  $currentBook = (mysqli_fetch_assoc($result));
  $_SESSION['current-book'] = $currentBook;
  //CHECK IF THERE IS ANY ASSOCIATION BETWEEN THE BOOK AND THE USER


  $editionalForm = '';

  if (isset($_SESSION['user']) && $_SESSION['role'] == 0) {
    $editionalForm =
      '
    <form id="update-amount-form" class="col-12 mx-0 py-2" action="./api/updateBook.php" method="post">
    <input type="text" name="bookid" id="bookid" class="d-none" value=' . $currentBook["book_id"] . '>
    <div class="form-group">
      <label for="amount">Amount of Books</label>
      <input class="form-control ak-outline" type="number" name="amount" id="amount" min="1" max="999" value=' . $currentBook["amount"] . '>
    </div>
    <button class="btn btn-success text-white  my-3 ak-outline" id="create-book-panel-button">
      CHANGE AMOUNT
    </button>
  </form>
  <script>
$("#update-amount-form").submit(function(e) {
  e.preventDefault();
  let bookID = parseInt(document.getElementById("bookid").value);
  let bookAmount = parseInt(document.getElementById("amount").value);

  postData(webBase+"/api/updateBook.php", {
    "id": bookID,
    "amount": bookAmount
  }).then(data => {
    if (typeof data["amount"] === "undefined") {
      throw Error(data["message"]);
    }
      //set amount
      document.getElementById("book_amount").innerText = data["amount"];
      document.getElementById("status-msg").innerHTML = ` 
      <div id="err_msg" class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> New Amount Set!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>`;

    }


  ).catch(err => {
    document.getElementById("status-msg").innerHTML = `
    <div id="err_msg" class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> ${err["message"]}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>`
  });
});
</script>
    ';
  }


  $buttons = '';

  $cancelReservationButton  =
    '<button type="submit" name="book-action" value="3" id="cancel-btn" class="col-8 ak-button ak-red-bkg">
  Cancel
</button>';
  $borrowButton = '<button name="book-action" value="2" id="borrow-btn" class="col-8 ak-button ak-blue-bkg">
    Borrow
  </button>';

  $reserveButton = '<button name="book-action" value="1"  id="reserve-btn" class="col-8 ak-button ak-blue-bkg">
  Reserve
</button>';
  $cancelButton =
    '<button name="book-action" value="4"  id="return-btn" class="col-8 ak-button ak-red-bkg " >
        Return
      </button>';

  $resStatus  = 0;
  //CHECK IF USER IS LOGGED IN
  if (isset($_SESSION['user'])) {

    $queryRes = getBorrowed($currentBook, $libraryDB);
    // $queryRes = 10;
    if (!is_null($queryRes)) {
      $buttons = $cancelButton;
      $resStatus = 1;
    } else {
      $queryRes = getReserved($currentBook, $libraryDB);
      if (!is_null($queryRes)) {
        $buttons .=
          $cancelReservationButton . $borrowButton;
      } else {
        $buttons = $borrowButton . $reserveButton;
      }
    }
  } else {
    $buttons =
      '<a href="./login.php" class="col-8 ak-button ak-red-bkg  text-white">
  LOGIN to Borrow
</a>
    ';
  }


  return
    '<div id="book-card-view" class=" border-radius-5 ak-outline ak-soft-shadow">
  <div class="my-3 row p-3 align-items-center text-center text-md-left">
    <figure class="col-12 row col-lg-4 p-0 mx-0">
      <img class="col-12 col-sm-6 col-md-8 col-lg-12 mx-auto" src="http://covers.openlibrary.org/b/isbn/' . $isbn . '-M.jpg?default=false" alt="Book Cover" onerror="this.onerror=null;this.src=\'https://picsum.photos/100/160\';" height="100%" width="100%" />
    </figure>
    <div class="col-12 col-lg-4 text-center text-lg-left">
      <h4 class="text-blue font-weight-bold big" class="book-title">' . $currentBook['title'] . '</h4>
      <p class="author">' . $currentBook['author'] . '</p>
      <p class="category">Category: ' . getCategory($currentBook['category_id']) . '</p>
    </div>
    <div class="col-12 col-lg-4 text-center row mx-0">
      <p class="col-8 mx-auto">Amount: <span id="book_amount">' . $currentBook['amount'] . '</span></p>
      <form class="col-12 mx-0" action="./bookView.php" method="post">
 ' . $buttons . '
      </form>

      ' . $editionalForm . '


    </div>
  </div>
</div>
<div id="status-msg"></div>
  ';
}


if (isset($_POST["book-action"])) {

  // echo $_GET
  // $query = $sql = "SELECT * FROM `books` WHERE  `isbn13` = " . $isbn . "";
  // $result = mysqli_query($libraryDB, $query);
  // $currentBook = (mysqli_fetch_assoc($result));
  $currentBook = $_SESSION['current-book'];

  switch ($_POST["book-action"]) {
      //TODO:ADD CONFIRMATION MESSAGES!
      //book reserved
    case "1":
      // print_r($currentBook);
      if (reserveBook($currentBook, $libraryDB) == null) {
        $_SESSION['bookView']['err'] = "Not enough books for reservation. As per our policy: The last book is left for borrowing only.";
      };
      break;
    case "2":
      borrowBook($currentBook, $libraryDB);
      break;
    case "3":
      cancelBookReservation($currentBook, $libraryDB);
      break;
    case "4":
      returnBook($currentBook, $libraryDB);
      break;
    default:
      $_SESSION['bookView']['err'] = "ERROR! ACTION UNSUCCESSFUL!";
      echo "ERROR! POST[book-action] NOT SET!";
      break;
  }
}


?>
<!-- <script>
  $("#update-amount-form").submit(function(e) {
    e.preventDefault();
    let bookID = parseInt(document.getElementById("bookid").value);
    let bookAmount = parseInt(document.getElementById("amount").value);

    postData("http://localhost/project4/api/updateBook.php", {
      "id": bookID,
      "amount": bookAmount
    }).then(data => {
        if (data["amount"] === "undefined") {
          throw new Error(data["message"]);
        }
        //set amount
        document.getElementById("book_amount").innerText = data["amount"];
        document.getElementById("status-msg").innerHTML = ` 
        <div id="err_msg" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> New Amount Set!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`;

      }


    ).catch(err => {
      document.getElementById("status-msg").innerHTML = `
      <div id="err_msg" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ${err["message"]}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`
    });
  });
</script> -->
<!-- <form id="update-amount-form" class="col-12 mx-0 py-2" action="./api/updateBook.php" method="post">
  <input type="text" name="bookid" id="bookid" class="d-none" value='.$currentBook["book_id"].'>
  <div class="form-group">
    <label for="amount">Amount of Books</label>
    <input class="form-control ak-outline" type="number" name="amount" id="amount" min="1" max="999" value=' . $currentBook["amount"] . '>
  </div>
  <button class="btn btn-success text-white  my-3 ak-outline" id="create-book-panel-button">
    CHANGE AMOUNT
  </button>
</form>
<script>
  $("#update-amount-form").submit(function(e) {
    e.preventDefault();
    postData("http://localhost/project4/api/updateBook.php", {
      "id": document.getElementById("bookid").value,
      "amount": document.getElementById("amount").value
    }).then(data => console.log(data)).catch(err => console.log(err));
  });
</script> -->