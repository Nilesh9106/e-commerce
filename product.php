<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "comp/link.php" ?>
</head>

<body>
    <?php include "comp/nav.php" ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['id'];
        $sql = "SELECT * FROM `product` WHERE pid = $id";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        
    }

    ?>
    <section id="product" class="my-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img src="<?= $row['photo'] ?>" alt="product" width="500px" class="img-fluid">
                </div>
                <div class="col-sm-6 py-5 px-4">
                    <h5 class="font-baloo font-size-20"><?= $row['name'] ?></h5>
                    <small>by <?= $row['brand'] ?></small>
                    <?php if($row['max_qty']!=0){ ?>
                    <p class="text-success">In Stock</p>
                    <?php }else{
                        echo '<p class="text-danger">Out of Stock</p>';
                    } ?>
                    <hr class="m-2">

                    <!---    product price       -->
                    <table class="my-3">
                        <tr class="font-rale font-size-14">
                            <td>M.R.P:</td>
                            <td>₹<?= $row['price'] ?></td>
                        </tr>

                    </table>
                    <!---    !product price       -->

                    
                    <hr>

                    <!-- order-details -->
                    <div id="order-details" class="font-rale d-flex flex-column text-dark">
                        <small>Delivery by : Mar 29 - Apr 1</small>
                        <small>Sold by <a href="#">Amazon</a></small>
                        <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 424201</small>
                    </div>
                    <!-- !order-details -->

                    <div class="row">
                        <div class="pt-4">
                            <?php
                            if(isset($_COOKIE['id'])){
                            $uid=$_COOKIE['id'];
                            $sql = "SELECT * FROM cart WHERE pid=$id AND id=$uid";
                            $result=mysqli_query($link, $sql);
                            
                            $row5=mysqli_fetch_assoc($result);
                            if (mysqli_num_rows($result) != 0) {
                                echo '
                                <form action="remove_to_cart.php" method="post">
                                <input type="hidden" name="pid" value="'.$id.'">
                                <input type="hidden" name="cid" value="'.$row5['cid'].'">
                                
                                <button type="submit"  class="btn btn-outline-success form-control"><i class="fa-solid fa-cart-arrow-down"></i> Remove to Cart</button></form>';
                            } else {
                                echo '
                                <form action="add_to_cart.php?cid='.$id.'" method="post">
                                <input type="number" class="form-control m-2" value="1" min="1" max="'.$row['max_qty'].'" name="qty" aria-label="qty" aria-describedby="basic-addon1">
                                
                                <button type="submit"  class="btn btn-outline-success form-control"><i class="fa-solid fa-cart-arrow-down"></i> Add to Cart</button></form>';
                                
                            }
                        }else{
                            echo '<form action="add_to_cart.php" method="post">
                            <input type="number" class="form-control m-2" value="1" min="1" name="qty" aria-label="qty" aria-describedby="basic-addon1">
                            
                            <button type="submit"  class="btn btn-outline-success form-control"><i class="fa-solid fa-cart-arrow-down"></i> Add to Cart</button></form>';
                        }
                            ?>
                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <h6 class="font-rubik">Product Description</h6>
                    <hr>
                    <p class="font-rale font-size-14"><?= $row['description'] ?></p>

                </div>
            </div>
        </div>
    </section>
</body>

</html>