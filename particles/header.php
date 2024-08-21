<?php
session_start();
echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">MindQuest Forum</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                   
                    <li class="nav-item dropdown">
                        <div class="d-flex">
                        <li class="nav-item">
                        <div class="dropdown mr-1 nav-item">
                          <button type="button" class="btn nav-link dropdown-toggle " data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                            Top Category
                          </button>
                          <div class="dropdown-menu">';
// Display Category dynamically
$sql = 'SELECT * FROM `categories` LIMIT 4';
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $catId = $row['category_id'];
    $catName = $row['category_name'];
    echo '<a class="dropdown-item" href="/MindQuest/threadslist.php?catid=' . $catId . '">' . $catName . '</a>';
}


echo '</div>
                        </div>
                    </li>
                <li class="nav-item">
                <a class="nav-link" href="/MindQuest/about.php" >About Us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/MindQuest/contact.php" >Contact</a>
                </li>
                </ul>
                <div class="d-flex align-items-center">';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $us = $_SESSION['userName'];
    echo '<form name="search" class="d-flex align-items-center" role="search" method="get" action="/MindQuest/search.php">
        <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success mx-2" type="submit">Search</button>
        <div class="container-fluid">
            <span class="text-light p2-4">Welcome <span class="font-weight-bold">';
    echo ucfirst(strtok($us, " "));
    echo '</span></span>
        </div>
        <a href="/MindQuest/particles/handleLogout.php">
            <button type="button" class="btn btn-outline-success">Logout</button>
        </a>
    </form>';
} else {
    echo '<form name="search" class="d-flex align-items-center" role="search" method="get" action="/MindQuest/search.php">
            <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success mx-2" type="submit">Search</button>
          </form>
          <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModel">Login</button>
          <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#singupModel">Signup</button>';
}
echo '      </div>
            </div>
        </div>
      </nav>';

include './particles/login.php';
include './particles/singup.php';


// Alert Functions 

// showing singup alert
if (isset($_GET['singupsuccess']) && $_GET['singupsuccess'] == "true") {
    echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congratulations!</strong> Your account has been created Sucessfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
} else {
    if (isset($_GET['singupsuccess']) && $_GET['singupsuccess'] == "false") {
        $error = $_SESSION['error'];
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Can not singup!</strong> ' . $error . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        ';
    }
}

// showing Login alert
if (isset($_GET['login']) && $_GET['login'] == "false") {
    echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Can not Login!</strong> Check Email and Password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
}
// showing Logout alert
if (isset($_GET['logoutSucess']) && $_GET['logoutSucess'] == "true") {
    echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Your account has been logged out.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
}
