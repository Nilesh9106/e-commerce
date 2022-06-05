<?php
include "comp/config.php";
// $search = 'null';



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Engine</title>
    <?php include "comp/link.php" ?>
    <style>
        @media only screen and (max-width:784px) {
            .filter {
                width: 100%;
            }

            .single {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include "comp/nav.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $search = $_POST['search'];
        if (isset($_POST['radio']) and ($_POST['min']) != "" and ($_POST['max']) != "") {
            $radio = $_POST['radio'];
            $min = $_POST['min'];
            $max = $_POST['max'];
            $sql = "SELECT * FROM product WHERE name LIKE CONCAT('%','$search','%') AND type = '$radio' AND price <='$max' AND price >= '$min'";
        } else if (isset($_POST['radio']) and ($_POST['max']) != "") {
            $radio = $_POST['radio'];
            $max = $_POST['max'];
    
            $sql = "SELECT * FROM product WHERE name LIKE CONCAT('%','$search','%') AND type = '$radio' AND price <='$max'";
        } else if (isset($_POST['radio'])) {
            $radio = $_POST['radio'];
    
            $sql = "SELECT * FROM product WHERE name LIKE CONCAT('%','$search','%') AND type = '$radio'";
        } else {
    
            $sql = "SELECT * FROM product WHERE name LIKE CONCAT('%','$search','%') OR type='$search' OR brand ='$search'";
        }
    }
     ?>
    <section class="row" style="background-color: #eee;">
        <div class="accordion m-2 col-3 filter" id="accordionExample">
            <form action="search.php" method="post">
                <input type="hidden" name="search" value="<?= $search ?>">
                <h1 class="text-center">Filters</h1>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Price
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <input type="number" name="min" min="100" value="100" class="form-control m-2" placeholder="Min Price" aria-describedby="inputGroupPrepend">
                            <input type="number" name="max" min="1000" class="form-control m-2" placeholder="Max Price" aria-describedby="inputGroupPrepend">
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Catagories
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <select name="radio" class="form-select" id="">
                                <option value="mobile">mobile</option>
                                <option value="headphone">headphone</option>
                                <option value="tablet">tablet</option>
                                <option value="laptop">laptop</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" value="Apply " class="btn btn-primary m-2" name="submit">
                    <input type="reset" value="Reset" class="btn btn-outline-primary m-2" name="reset">
                </div>

            </form>
        </div>
        <div class=" col my-2 container-fluid">

            <?php
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    
                    include "comp/search_list.php";
           
                }
            } ?>
        </div>
    </section>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(search: <?= $search ?>, null, window.location.href);
        }
    </script>
</body>

</html>