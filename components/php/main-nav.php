<div id="main-nav">
  <nav class="navbar navbar-expand-lg navbar-light container my-3">
    <button class="navbar-toggler red-text" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa fa-bars red-text"></i>
    </button>
    <a class="navbar-brand mr-auto" href="./">Local<br />University<br />Library</a>
    <ul class="user-nav-items d-lg-none">
      <li class="nav-item d-lg-block" id="nav-settings">
        <a href="./userOptions.php" class="nav-link text-center">
          <i class="fa fa-cogs"></i>
        </a>
      </li>
      <!-- <li class="nav-item d-none d-sm-block">
        <a href="#" class="nav-link"><i class="far fa-bell"></i></a>
      </li> -->
      <li class="nav-item">
        <a href="./userView.php" class="red-text nav-link mt-2">
          <?php
          if (isset($_SESSION['user'])) {
            echo
              '<figure>
              <img src=' . $_SESSION["user_img"] . ' class="rounded-circle" />
            </figure>';
          } else {
            echo
              '
              <i class="fas fa-user material-shadow "></i>
              ';
          }
          ?>
        </a>


      </li>
    </ul>
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav ml-md-auto mt-lg-0">
        <li class="nav-item">

          <a href="./categoryView.php?cat=1" class="py-1 px-2 px-md-3 category-button nav-li">Academic<br />Books</a>
          <a href="./categoryView.php?cat=2" class="py-1 px-2 px-md-3 category-button">Non-<br />Fiction</a>
          <a href="./categoryView.php?cat=3" class="py-1 px-2 px-md-3 category-button">Fiction<br />&Fantasy</a>
        </li>
        <li class="nav-item d-lg-none mt-4" id="nav-search">
          <button class="nav-link">
            <i class="fa fa-search"></i>
            <p>SEARCH</p>
          </button>
        </li>
        <li class="nav-item d-lg-none" id="nav-settings">
          <a href="./userOptions.php" class="nav-link text-center">
            <i class="fa fa-cogs"></i>
            <p>SETTINGS</p>
          </a>
        </li>
        <!-- <li class="nav-item d-lg-none" id="nav-settings">
          <a href="./userView.php" class="nav-link text-center">
            <i class="far fa-bell"></i>
            <p>NOTIFICATIONS</p>
          </a>
        </li> -->
      </ul>
    </div>
    <div class="d-none d-lg-block ml-2">
      <ul class="user-nav-items">
        <li class="nav-item" id="nav-search">
          <button class="red-text nav-link">
            <i class="fa fa-search"></i>
          </button>
        </li>
        <li class="nav-item d-none d-lg-block" id="nav-settings">
          <a href="./userOptions.php" class="nav-link text-center">
            <i class="fa fa-cogs"></i>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="#" class="nav-link"><i class="far fa-bell"></i></a>
        </li> -->
        <li class="nav-item">
          <a href="./userView.php" class="red-text nav-link">
            <?php

            if (isset($_SESSION['user'])) {
              echo
                '
                <figure>
                  <img src="' . $_SESSION["user_img"] . '" class="rounded-circle" />
                </figure>
                ';
            } else {
              echo
                '
                <i class="fas fa-user material-shadow "></i>
                ';
            }
            ?>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</div>