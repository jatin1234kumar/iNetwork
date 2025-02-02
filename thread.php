<!-- php for the jumbotron on line no. =========================================== 68 -->
<?php
include 'partials/_dbconnect.php';

// get requests from the URL
$threadCatId = $_GET["threadCatId"];
$userId = $_GET["userId"];
$threadId = $_GET["threadId"];

$sql = "SELECT * from threads where thread_category_id='$threadCatId' and thread_id='$threadId'";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * from users where user_id=$userId";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result2);
$userNamefromDatabase = $row["User_email"];

while ($row = mysqli_fetch_array($result)) {
    $threadTitle = $row["thread_title"];
    $threadDescription = $row["thread_description"];
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNetwork | Threads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- important features for navbar  -->
    <?php include 'partials/_signInModal.php'; ?>
    <?php include 'partials/_signUpModal.php'; ?>

    <!-- Navbar section starts here -->
    <?php include 'partials/_navbar.php'; ?>

    <!-- commets form php of line no. ================================================ 79 -->
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $commentDesc = $_POST["commentDesc"];
        $commentUserId = $_POST["commentUserId"]; 

        $sql = "INSERT INTO `comments` (`comment_id`, `comment_desc`, `thread_id`, `thread_cat_id`, `user_id`, `comment_time`) VALUES (NULL, '$commentDesc', '$threadId', '$threadCatId', '$commentUserId', current_timestamp());";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successfully!</strong> Posted a comment.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> There is some problem in posting you comment.Please try again after some time.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }

        
    }
    ?>

    <!-- Discussion and it's php is on line no. ==================================================== 2 -->
    <div class="container">
        <div class="container">
            <div class="p-5 mb-4 mt-4 bg-light text-black rounded-3">
                <div class="container-fluid">
                    <h1 class="display-5 fw-bold"><?php echo $threadTitle; ?></h1>
                    <p class=" fs-5 my-3"><?php echo $threadDescription; ?></p>
                    <hr class="my-4">
                    <p class="fs-5 fw-bold">Posted by: <?php echo $userNamefromDatabase; ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- comment form starts here and its php is on line no. ================================================== 40 -->
        <div class="container">
            <?php 
                if (isset($_SESSION["logdein"])) {
                    echo '
                        <h1 class="my-4">Post a comment:</h1>
                        <form action="'. $_SERVER['REQUEST_URI'] .'" method="post" class="">
                            <div class="mb-3">
                                <textarea placeholder="Type your comment" class="form-control" name="commentDesc"
                                    id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="hidden">
                                <input type="text" class="form-control d-none" name="commentUserId" value="' . $_SESSION["user_id"] . '" id="hiddenInput">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    ';
                }else {
                    echo '
                        <h1 class="my-4">Please login to post a comment:</h1>
                        <form action="" method="post" class="" disabled>
                            <div class="mb-3">
                                <textarea disabled placeholder="Type your comment" class="form-control" name="commentDesc"
                                    id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button type="submit" disabled class="btn btn-primary">Submit</button>
                        </form>
                    ';
                }
            
            ?>
           
        </div>

        <!-- discussion section starts here -->
        <div class="container">
            <h1 class="my-4">Discussions:</h1>

            <!-- php for displaying comments -->
            <?php
            $sql = "SELECT * from comments where thread_id='$threadId' and thread_cat_id='$threadCatId'";
            $resultThreads = mysqli_query($conn, $sql);
            $content = false;

            while ($rows = mysqli_fetch_array($resultThreads)) {
                $commentDesc = $rows["comment_desc"];
                $content = true;
                $commentTime = $rows["comment_time"];
                $commentUserId = $rows["user_id"];

                // collecting user email from user table
                $sql3 = "SELECT * from users where user_id='$commentUserId'";
                $result3 = mysqli_query($conn, $sql3);
                $rowUser = mysqli_fetch_assoc($result3);
                $userName = $rowUser["User_email"];

                echo '
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0">
                            <img src="assets/profile.png" width="54px" alt="profile picture">
                        </div>
                        <div class="flex-grow-1 ms-3 d-flex flex-column align-content-center justify-content-around w-100">
                            <h5>'. $userName .' at ' . $commentTime . '</h5>
                            <p class="m-0" style="line-height: 1.2;">' . $commentDesc . '</p>
                        </div>
                    </div>
            ';
            }

            if (!$content) {
                echo '<div class="p-5 mb-4 mt-4 bg-light text-black rounded-3">
                        <div class="container-fluid">
                            <h1 class="display-5">Discussion not started!</h1>
                                    <p class=" fs-4">Be the first person to start the discussion😊.</p>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>

    <!-- footer section starts here -->
    <?php include("partials/_footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>