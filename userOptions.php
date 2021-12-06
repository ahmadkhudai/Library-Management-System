<?php include 'inc/header.php';
if (!isset($_SESSION['user'])) {
    header($headers["login"]);
}

?>


<body>
    <?php include './components/php/main-nav.php' ?>

    <div class="my-5 mx-auto" id="main-body">

        <div class="row mx-3 mt-5">
            <div class="col-12  mx-auto text-center my-3">

                <h1 class="banner red-text d-inline-block ">SETTINGS</h1>
            </div>

            <div class="col-10 row mx-auto align-items-center my-4">

                <div class="col-12 col-md-4 p-0 ">
                    <div class="col-12 m-0 text-center">
                        <h3 class="d-inline-block">Edit</h3>
                    </div>

                </div>


                <div class="col-12 col-md-4 text-center">
                    <div class="col-12 text-center">
                        <button class="ak-button ak-blue-bkg col-8 col-lg-12" id="edit-name-button">
                            Name
                        </button>
                        <button class="ak-button ak-blue-bkg ak-red-bkg col-8 col-lg-12" id="edit-email-button">
                            Email
                        </button>
                        <button class="ak-button ak-blue-bkg ak-red-bkg col-8 col-lg-12" id="edit-password-button">
                            Password
                        </button>
                    </div>
                </div>


                <!-- <div class="col-12 col-lg-7 row material-shadow my-3 mx-auto">

                </div> -->
            </div>
            <div id="edit-pane" class="col-12 col-md-10  mx-auto material-shadow py-3  my-3 border-primary border-1" onkeyup="checkFormValidation(this.id, '.enabled')">
                <div class="col-12 mx-auto text-center my-3">
                    <form action="./api/editCreds.php" method="post">
                        <div class="form-group">
                            <label for="edit-name" id="edit-name-label">EDIT NAME</label>

                            <input type="text" class="form-control enabled" id="edit-name" name="username" placeholder="Enter NEW Name..." />
                        </div>
                        <div class="form-group">
                            <label for="edit-email" id="edit-email-label" class="d-none">EDIT EMAIL</label>
                            <input type="email" class="form-control d-none" id="edit-email" name="email" aria-describedby="emailHelp" placeholder="Enter NEW Email" />
                        </div>
                        <div class="form-group">
                            <label for="edit-password" id="edit-password-label" class="d-none">EDIT PASSWORD</label>

                            <input type="password" class="form-control d-none" id="edit-password" name="password" placeholder="New Password.." />
                        </div>
                    </form>
                    <button class="btn red-text light-grey-bkg font-weight-bold disabled w-50 material-shadow" id="edit-pane-button">
                        SUBMIT CHANGES
                    </button>
                </div>
                <!-- <div class="col-12 col-lg-7 row material-shadow my-3 mx-auto">

                </div> -->
            </div>








            <?php
            if ($_SESSION['role'] == 0) {
                echo
                '
                    <div class="col-10 row mx-auto align-items-center my-4">

                    <div class="col-12 col-md-4 p-0 ">
                        <div class="col-12 m-0 text-center">
                            <h3 class=" d-inline-block">Add(Admin)</h3>
                        </div>
    
                    </div>
    
                    <div class="col-12   col-md-4 text-center">
                        <div class="col-12 text-center">
                       
            <button class="ak-button ak-blue-bkg col-8 col-lg-12"> <a href="./createUser.php" class="text-white">User</a></button>
            <button class="ak-button ak-blue-bkg col-8 col-lg-12"><a href="./createBook.php" class="text-white">Books</a></button>

     
                        </div>
                        
                    </div>
                    
                   
    
                </div>
    
    
                <div class="col-10 row mx-auto align-items-center my-4">
    
                    <div class="col-12 col-md-4 p-0 ">
                        <div class="col-12 m-0 text-center">
                            <h3 class="d-inline-block">View/Remove<br>(Admin)</h3>
                        </div>
    
                    </div>
    
                    <div class="col-12 col-md-4  text-center">
                        <div class="col-12 text-center">
                        <button class="ak-button ak-blue-bkg col-8 col-lg-12"><a href="./index.php" class="text-white">Books</a></button>
                        </div>
                    </div>
    
                </div>  
                    ';
            }
            ?>

            <div class="col-10 row mx-auto align-items-center my-4">

                <div class="col-12 col-md-4 p-0 ">
                    <div class="col-12 m-0 text-center">
                        <h3 class=" d-inline-block">CLOSE YOUR ACCOUNT</h3>
                    </div>

                </div>

                <div class="col-12   col-md-4 text-center">
                    <div class="col-12 text-center">

                        <button class="ak-button red-text col-8 col-lg-12"> <a href="./api/deleteUser.php" class="red-text" onclick="return confirm('Are you sure?');">DELETE ACCOUNT</a></button>


                    </div>

                </div>



            </div>

            <!-- <div id="signup-panel" class="col-10 col-lg-12 mx-auto text-center " onkeyup="checkFormValidation(this.id)">
                <div class="col-12 mx-auto text-center my-3">
                    <h1 class="banner d-inline-block">Sign up</h1>
                </div>
                <form action="./login.php" method="post">
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
            </div> -->







        </div>
    </div>
    <hr class="mb-5 border-white">
    <?php include "components/footer.html"; ?>
    <?php include 'inc/footer.php'; ?>