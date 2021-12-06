<?php include './inc/header.php';
if (!isset($_SESSION['user']) || $_SESSION['role'] != 0) {
    header("location:index.php");
}

?>

<?php include './components/php/main-nav.php'; ?>



<div class="my-5 mx-auto" id="main-body">

    <div class="row mx-3 mt-5">

        <div id="create-book-panel" class="col-12 col-md-10 mx-auto  my-3 py-3 ">
            <div class="col-12 mx-auto text-center ">
                <h1 class="d-inline-block mt-3 banner my-3">ADD NEW BOOK</h1>
            </div>
            <form action="./api/createBook.php" method="post">
                <div class="form-group ">
                    <label for="title">Title</label>
                    <input type="text" class="form-control ak-outline" id="title" name="title" placeholder="Book Title..." />
                </div>
                <div class="form-group">
                    <label for="author">Author Name</label>
                    <p class="small">(Separate multiple names by comma)</p>
                    <input type="text" class="form-control ak-outline" id="author" name="author" placeholder="Author name" />
                </div>
                <div class="form-group">
                    <label for="publisher">Publisher</label>
                    <input class="form-control ak-outline" type="text" name="publisher" id="publisher" placeholder="Book Publisher...">
                </div>
                <div class="row ">
                    <div class="col-12 col-md-8">
                        <div class="form-group">
                            <label for="isbn13">ISBN NO.</label>
                            <p class="small red-text">(isbn 13 only)</p>
                            <input type="text" class="form-control ak-outline" id="isbn13" name="isbn13" placeholder="Isbn13..." />
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount of Books</label>
                            <input class="form-control ak-outline" type="number" name="amount" id="amount" min="1" max="999" value="1">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 ml-auto">
                        <div class="from-group ml-auto">
                            <figure>
                                <img class="ak-outline" id="book-cover" src="kk" alt="Book Cover" onerror="this.onerror=null;this.src='https://picsum.photos/180/288';">

                            </figure>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="category">SELECT CATEGORY:</label>
                    <select class="form-control ak-outline" id="category_id" name="category_id">
                        <option value="1">ACADEMIC BOOKS</option>
                        <option value="2">NON-FICTION</option>
                        <option value="3">FICTION & FANTASY</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Book Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control ak-outline"></textarea>
                </div>

            </form>
            <button class="btn btn-success text-white disabled my-3 ak-outline" id="create-book-panel-button">
                ADD BOOK
            </button>
        </div>
    </div>
</div>

<?php include "./components/footer.html"; ?>

<?php include './inc/footer.php'; ?>