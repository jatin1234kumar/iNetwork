<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNetwork</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- This is the Navbar for the iNetwork website -->
    <?php include 'partials/_navbar.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_signInModal.php'; ?>
    <?php include 'partials/_signUpModal.php'; ?>
    


    <div class="container-fluid p-0">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="assets/slider_1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="assets/slider_2.jpg" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/slider_3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- categories section starts -->

    <div class="container" style="width: 80%">
        <h1 class="text-center my-3">iNetwork - Browse Catagories</h1>

        <!-- alter the cards with the help of while loop -->

        <div class="row">
            <?php
            $sql = "SELECT * from categories";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $categoryName = $row["category_name"];
                    $categoryDiscription = $row["category_discription"];
                    $catId = $row['category_id'];

                    echo '<div class="col-md-4 mt-4">
                                <div class="card mx-auto" style="width: 18rem;">
                                    <img src="assets/'. $categoryName .'.jpg" class="card-img-top" style="width:100%; height: 13rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $categoryName . '</h5>
                                        <p class="card-text">' . substr($categoryDiscription, 0, 80) . '...</p>
                                        <a href="threadlist.php?catId='. $catId .'" class="btn btn-primary">View threads</a>
                                    </div>
                                </div>
                            </div>';
                }
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