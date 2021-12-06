
            <?php include('./components/php/smol-book.php');



            // <!-- <div class="related-books col-12 row p-md-3  mx-auto">
            //     <div class="col-12 col-md-8 pt-1 my-4 text-center mx-auto banner">
            //         <h2>More Books by Brandon Sanderson</h2>
            //     </div>
            //     <div class="scrollpane row col-12 mx-auto justify-content-center">
            //         <div class="row col-12 text-center mx-auto px-0">

            //         </div>
            //     </div>
            // </div> -->



            function createRelatedBooks($type, $libraryDB)
            {
                $paneTitle = "";
                $books = [];
                switch ($type) {
                    case "BORROWED": {
                            $paneTitle = "Borrowed Books";
                            $books = getAllBorrowedBooks($libraryDB);
                            // $books = getBorrowed(null, $libraryDB);
                        }
                        break;
                    case "RESERVED": {
                            $paneTitle = "Reserved Books";
                            $books = getAllReservedBooks($libraryDB);
                        }
                        break;
                }

                $smolBooks = '';

                if ($books != null) {
                    foreach ($books as $book) {
                        $smolBooks .= getSmolBookTemplate($book, $type);
                    }
                } else {
                    $smolBooks = 'NO ' . $paneTitle . " FOUND!";
                }




                echo
                    '
    <div class="related-books col-12 row p-md-3  mx-auto">
    <div class="col-12 col-md-8 pt-1 my-4 text-center mx-auto banner">
        <h2>' . $paneTitle . '</h2>
    </div>
    <div class="scrollpane row col-12 mx-auto justify-content-center">
        <div class="row col-12 text-center mx-auto px-0">
            ' . $smolBooks . '
        </div>
    </div>
    </div>
    ';
            }
