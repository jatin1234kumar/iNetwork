<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNetwork | Contacts</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- This is the Navbar for the iNetwork website -->
    <?php include("partials/_navbar.php"); ?>

    <?php
    $query = $_GET["searchQuery"];
    echo '
             <div class="container mt-2" style="width: 80%; height:62vh;">
                <h1>Search result for "<em>' . $query . '</em>"</h1>
        ';

    ?>

    <!-- php for getting serach queries -->
    <?php
    $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_description) against ('$query')";
    $result = mysqli_query($conn, $sql);
    $numrow = mysqli_num_rows($result);

    // if there is no result related with the search then
    if ($numrow == 0) {
        echo '<div class="p-5 mb-4 mt-4 bg-light text-black rounded-3">
                <div class="container-fluid">
                    <h1 class="display-5">No result found!</h1>
                    <hr>
                    <p class=" fs-4">Suggestions:</p>
                    <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                        <li>Try fewer keywords.</li>
                    </ul>
                </div>
            </div>';
    }
    // if there are results related with the searched query.
    else {
        while ($row = mysqli_fetch_assoc($result)) {
            $threadUserId = $row["thread_user_id"];
            $sql2 = "SELECT * from `users` where User_id='$threadUserId'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $userEmail = $row2["User_email"];

            echo '
                <div class="mt-4">
                    <div class="mt-4">
                         <div class="d-flex mt-3 justify-content-between">
                            <h4>
                                <a class="text-black text-decoration-none" href="thread.php?threadCatId=' . $row["thread_category_id"] . '&amp;userId=' . $row["thread_user_id"] . '&amp;threadId=' . $row["thread_id"] . '">
                                    ' . $row["thread_title"] . '
                                </a>
                            </h4>
                            <h1 class="m-0 " style="line-height: 1.2; font-size: 1.1rem; font-weight: 700;">Asked by: ' . $userEmail . ' at ' . $row["date"] . '</h1>
                        </div> 
                        <p class="m-0" style="line-height: 1.2;">
                            ' . $row["thread_description"] . '
                        </p>
                    </div>
                    <hr>
                </div>
        ';
        }
    }
    
    ?>
    </div>

    <!-- This is the footer of the website. -->
    <?php include("partials/_footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>