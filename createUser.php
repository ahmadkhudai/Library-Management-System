<?php include './inc/header.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] != 0) {

    redirect('index.php', $webBase);
}

?>

<?php include './components/php/main-nav.php'; ?>



<div class="my-5 mx-auto" id="main-body">

    <div class="row mx-3 mt-5">


        <div id="signup-panel" class="col-10 col-lg-12 mx-auto text-center material-shadow my-3 py-3" onkeyup="checkFormValidation(this.id)">
            <div class="col-12 mx-auto text-center ">
                <h1 class="d-inline-block mt-3">ADD NEW USER</h1>
            </div>
            <form action="./inc/manage_login.php" method="post">
                <div class="form-group">
                    <label for="uni-id">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your name..." />
                </div>
                <div class="form-group">
                    <label for="login-email">Email address</label>
                    <input type="email" class="form-control" id="signup-email" name="signup-email" aria-describedby="emailHelp" placeholder="Enter email" />
                </div>
                <div class="form-group">
                    <label for="signup-pass">Password</label>
                    <input type="password" class="form-control" id="signup-pass" name="signup-pass" placeholder="Your Password" />
                </div>
            </form>
            <button class="btn btn-success text-white disabled" id="signup-panel-button">
                CREATE USER
            </button>
        </div>
    </div>
</div>

<?php include "./components/footer.html"; ?>

<?php include './inc/footer.php'; ?>