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

    <!-- php for getting serach queries -->
    <?php

    // if($_SERVER["REQUEST_METHOD"] == "GET"){
    $query = $_GET["searchQuery"];
    echo '
        <div class="container mt-2" style="width: 60%; height:62vh;">
            <h1>Search result for "<em>' . $query . '</em>"</h1>
            <div class="mt-4">
                <div class="mt-2">
                    <h3>
                        <a class="text-black text-decoration-none" href="thread.php?threadCatId=1&amp;userId=4&amp;threadId=9">
                            Html Problem 1
                        </a>
                    </h3>
                    <p class="m-0" style="line-height: 1.2; width:60%;">
                        Not getting the documentry of html
                    </p>
                </div>
                <hr>
                <div class="mt-2">
                    <h3>
                        <a class="text-black text-decoration-none" href="thread.php?threadCatId=1&amp;userId=4&amp;threadId=9">
                            Html Problem 1
                        </a>
                    </h3>
                    <p class="m-0" style="line-height: 1.2; width:60%;">
                        Not getting the documentry of html
                    </p>
                </div>
                <hr>
                <div class="mt-2">
                    <h3>
                        <a class="text-black text-decoration-none" href="thread.php?threadCatId=1&amp;userId=4&amp;threadId=9">
                            Html Problem 1
                        </a>
                    </h3>
                    <p class="m-0" style="line-height: 1.2; width:60%;">
                        Not getting the documentry of html
                    </p>
                </div>
            </div>
        </div>
        ';
    // }
    

    ?>



    



    <!-- This is the footer of the website. -->
    <?php include("partials/_footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>