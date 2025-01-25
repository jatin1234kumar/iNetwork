<?php session_start(); ?>

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
                        Catogories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            <?php
            if (!isset($_SESSION["logdein"])) {
                echo '
                <button class="btn btn-outline-primary mx-2" data-bs-toggle="modal" data-bs-target="#signInModal"
                    type="submit">Sign in</button>
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signUpModal"
                    type="submit">Sign up</button>
            ';
            }
            
            if (isset($_SESSION['logdein']) && $_SESSION["logdein"]== true) {
                $userName = $_SESSION["username"];
                echo '
                        <p class="text-light mx-2 mt-3">' . $userName . '</p>
                        <a role="button" href="partials/_logout.php" class="btn btn-outline-success" type="submit">Logout</a>
                    ';
            }
            ?>
        </div>
    </div>
</nav>



<?php

if (isset($_GET["logout"])) {
    echo '
            <div class="alert alert-success alert-dismissible fade show" style="margin-bottom: 0;" role="alert">
                <strong>Success! </strong>You are now loged out.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
}

if (isset($_GET["logedin"]) && $_GET["logedin"] == "true") {
    echo '
            <div class="alert alert-success alert-dismissible fade show" style="margin-bottom: 0;" role="alert">
                <strong>Success! </strong>You are now loged in.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
}
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