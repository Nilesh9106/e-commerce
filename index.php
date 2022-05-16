<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php include "comp/link.php" ?>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php require_once "comp/nav.php" ?>
    <?php if(isset($_GET['mess'])){ ?>
    <div class="alert alert-warning mx-3 my-1 alert-dismissible fade show" role="alert">
        <?=$_GET['mess']?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } ?>
    <!-- main carousel -->
    <div id="carouselExampleCaptions" class=" carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner mt-4">
            <div class="carousel-item active">
                <img src="assets/3.jpg" class="c-img  d-block w-100" alt="...">
                <!-- <div class="d-block w-100 bg-primary"></div> -->

            </div>
            <div class="carousel-item">
                <img src="assets/2.jpg" class="c-img d-block w-100" alt="...">

            </div>
            <div class="carousel-item">
                <img src="assets/3.jpg" class="c-img d-block w-100" alt="...">

            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- !main carousel -->
    <!-- second navbar  -->
    <nav class="navbar navbar-expand-lg navbar-dark mx-4 my-3 bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Catagories:</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " href="#mobile">Mobile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#laptop">Laptops</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#tablet">Tablets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#headphone">Headphone</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#other">Other</a>
                    </li>
                </ul>
                <form action="search.php" method="post">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <!-- !second navbar  -->

    <!-- owl carousel  -->
    <section class="section-products">
        <!-- books start  -->
        <?php
        $pro = array("mobile", "laptop", "tablet", "headphone", "other");
        for ($i = 0; $i < 5; $i++) {
            $j = 0;
            $sql = "SELECT * FROM `product` WHERE type = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $type);
            $type = $pro[$i];
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result)) {
        ?>
                <div class="container " id="<?= $pro[$i] ?>">
                    <h1 class="text-center py-3 my-3" style="border-bottom: 4px solid gray; "><?= $pro[$i] ?></h1>
                    <div class="row">
                        <!-- Single Product -->
                        <?php

                        while ($row = mysqli_fetch_assoc($result) and $j < 4) {
                            $j++;

                        ?>
                            <div class="col-md-3 col-sm-6 rounded">
                                <div class="card rounded mb-30"><a class="card-img-tiles " href="product.php?id=<?= $row['pid'] ?>" data-abc="true">
                                        <div class="inner p-3">
                                            <img src="<?= $row['photo'] ?>" class="w-100" alt="Category">
                                        </div>
                                    </a>
                                    <div class="card-body text-center">
                                        <h4 class="card-title"><?= $row['name'] ?></h4>
                                        <p class="text-muted">Starting from ₹<?= $row['price'] ?></p><a class="btn btn-outline-primary btn-sm" href="product.php?id=<?= $row['pid'] ?>" data-abc="true">View Products</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- Single Product -->

                    <?php }  ?>
                    </div>
                </div>
            <?php } ?>
            <!-- books end -->



    </section>

    <?php include "comp/footer.php" ?>
</body>

</html>