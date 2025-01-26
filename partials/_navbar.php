<?php
session_start(); 
include "partials/_dbconnect.php";
include 'partials/_signInModal.php'; 
include 'partials/_signUpModal.php';

?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">iNetwork</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Top Catogories
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Php query for the top categories section -->
                        <?php
                        $sql = "SELECT category_name, category_id from categories limit 4";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <li><a class="dropdown-item" href="threadlist.php?catId='. $row["category_id"] .'">'. $row["category_name"] .'</a></li>
                            ';
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <!-- php query for search function -->
            <?php
            echo '
            <form class="d-flex" action="search.php?query=Hello" method="get" role="search">
                <input class="form-control me-2" type="search" name="searchQuery" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            ';
            ?>

            <?php
            if (!isset($_SESSION["logdein"])) {
                echo '
                <button class="btn btn-outline-primary mx-2" data-bs-toggle="modal" data-bs-target="#signInModal"
                    type="submit">Sign in</button>
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signUpModal"
                    type="submit">Sign up</button>
            ';
            }

            if (isset($_SESSION['logdein']) && $_SESSION["logdein"] == true) {
                $userName = $_SESSION["username"];
                echo '
                        <p class="text-light mx-2 mt-3">' . $userName . '</p>
                        <a role="button" href="partials/_logout.php" class="btn btn-outline-primary" type="submit">Logout</a>
                    ';
            }
            ?>
        </div>
    </div>
</nav>



<?php

// logout alert  (from _logout.php).
if (isset($_GET["logout"])) {
    echo '
            <div class="alert alert-success alert-dismissible fade show" style="margin-bottom: 0;" role="alert">
                <strong>Successfully! </strong> Logged out.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
}

// if user is loggedin successfully (from partials/_signin.php).
if (isset($_GET["logedin"]) && $_GET["logedin"] == "true") {
    echo '
            <div class="alert alert-success alert-dismissible fade show" style="margin-bottom: 0;" role="alert">
                <strong>Successfully! </strong>Logged In.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
}


// if user is Unable to login successfully (from partials/_signin.php).
if (isset($_GET["logedin"]) && $_GET["logedin"] == "false") {
    if (isset($_GET["error"])) {
        $showError = $_GET["error"];
    }
    echo '
            <div class="alert alert-danger alert-dismissible fade show" style="margin-bottom: 0;" role="alert">
                <strong>Error! </strong> ' . $showError . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
}

// if user is successfully signed up (from partials/_signup.php).
if (isset($_GET["signupsuccess"]) && $_GET["signupsuccess"] == "true") {
    if (isset($_GET["success"])) {
        $showAlert = $_GET["success"];
    }
    ;

    echo '
            <div class="alert alert-success alert-dismissible fade show" style="margin-bottom: 0;" role="alert">
                <strong>Success! </strong>' . $showAlert . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
}


// if user is not signed up successfully (from partials/_signup.php).
if (isset($_GET["signupsuccess"]) && $_GET["signupsuccess"] == "false") {
    if (isset($_GET["error"])) {
        $showError = $_GET["error"];
    }
    ;

    echo '
            <div class="alert alert-danger alert-dismissible fade show" style="margin-bottom: 0;" role="alert">
                <strong>Error! </strong>' . $showError . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
}

?>