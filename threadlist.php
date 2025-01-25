<!-- making a getrequest for url -->
<?php

include 'partials/_dbconnect.php';

$id = $_GET["catId"];
$sql = "SELECT * from categories where category_id='$id'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    $categoryName = $row["category_name"];
    $categoryDiscription = $row["category_discription"];
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNetwork | <?php echo $categoryName; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- userful includes  -->
    <?php include 'partials/_signInModal.php'; ?>
    <?php include 'partials/_signUpModal.php'; ?>

    <!-- This is the Navbar for the iNetwork website -->
    <?php include 'partials/_navbar.php'; ?>

    <!-- get request from the threadlist page -->
    <?php
    $showalert = false;
   
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $problemTitle = $_POST["problemTitle"];
        $problemDesc = $_POST["problemDesc"];

        $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_description`, `thread_category_id`, `thread_user_id`, `date`) VALUES (NULL, '$problemTitle', '$problemDesc', '$id', '0', current_timestamp());";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showalert = true;
        }

        if ($showalert) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Question is posted successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
        }
    }
    ?>


    <!-- Main section starts here -->
    <div class="container">
        <div class="container">
            <div class="p-5 mb-4 mt-4 bg-light text-black rounded-3">
                <div class="container-fluid">
                    <h1 class="display-5 fw-bold">Welcome to <?php echo $categoryName; ?> Discussion.</h1>
                    <p class=" fs-5"><?php echo $categoryDiscription; ?></p>
                    <hr class="my-4">
                    <p class="fs-5">No Spam / Advertising / Self-promote in the forums. <br>Do not post
                        copyright-infringing material.<br> Do not post “offensive” posts, links or images.
                        <br> Remain respectful of other members at all times.
                    </p>
                    <!-- <button class="btn btn-primary btn-lg" type="button">Learn more</button> -->
                </div>
            </div>
        </div>

        <div class="container pb-4">
            <h1 class="my-4">Ask a Question:</h1>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="">
                <div class="mb-3">
                    <input type="text" name="problemTitle" class="form-control" placeholder="Title"
                        id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="problemDesc" placeholder="Description"
                        id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


        <div class="container">
            <h1 class="my-4">Asked Questions:</h1>

            <?php
            $sql = "SELECT * from threads where thread_category_id='$id'";
            $resultThreads = mysqli_query($conn, $sql);
            $content = false;

            while ($threadIds = mysqli_fetch_array($resultThreads)) {
                $threadTitle = $threadIds["thread_title"];
                $threadDesc = $threadIds["thread_description"];
                $userId = $threadIds["thread_user_id"];
                $threadId = $threadIds["thread_id"];
                $threadDate = $threadIds["date"];
                $content = true;

                echo '
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0">
                            <img src="assets/profile.png" width="54px" alt="profile picture">
                        </div>
                        <div class="flex-grow-1 ms-3 d-flex flex-column align-content-center justify-content-around w-100">
                            <h1 class="m-0 " style="line-height: 1.2; font-size: 1.3rem; font-weight: 700;">Anonamus User at ' . $threadDate . '</h1>
                            <h3><a class="text-black text-decoration-none" href="thread.php?threadCatId=' . $id . '&userId=' . $userId . '&threadId=' . $threadId . '">' . $threadTitle . '</a></h5>
                            <p class="m-0" style="line-height: 1.2;">' . $threadDesc . '</p>
                        </div>
                    </div>
            ';
            }

            if (!$content) {
                echo '<div class="p-5 mb-4 mt-4 bg-light text-black rounded-3">
                    <div class="container-fluid">
                        <h1 class="display-5">No Questions found!</h1>
                        <p class=" fs-4">Be the first person to ask a Question😊.</p>
                    </div>
                 </div>';
            }
            ?>
        </div>

    </div>





    <?php include("partials/_footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>