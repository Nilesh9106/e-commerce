<!DOCTYPE html>
<html lang="en">
<?php
include "auth.php";
$code = array('NILESH' => 50, 'NEPAL' => 40, 'KAILASH' => 40);
$dis = 0.1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $index = $_POST['code'];
    if (isset($code[$index])) {
        $dis = $code[$index] / 100;
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <?php include "comp/link.php"; ?>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        body {
            background-color: #eeeeee;
            font-family: 'Open Sans', serif;
            font-size: 14px
        }



        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.40rem
        }

        .img-sm {
            width: 80px;
            height: 80px
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .table-shopping-cart .price-wrap {
            line-height: 1.2
        }

        .table-shopping-cart .price {
            font-weight: bold;
            margin-right: 5px;
            display: block
        }

        .text-muted {
            color: #969696 !important
        }

        a {
            text-decoration: none !important
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .dlist-align {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        [class*="dlist-"] {
            margin-bottom: 5px;
        }

        .coupon {
            border-radius: 1px;
        }

        .price {
            font-weight: 600;
            color: #212529;
        }

        .btn.btn-out {
            outline: 1px solid #fff;
            outline-offset: -5px;
        }

        .mt-5 {
            margin-top: 100px !important;
        }

        .btn-main {
            border-radius: 2px;
            text-transform: capitalize;
            font-size: 15px;
            padding: 10px 19px;
            cursor: pointer;
            color: #fff;
            width: 100%;
        }

        .btn-light {
            color: #ffffff;
            background-color: #F44336;
            border-color: #f8f9fa;
            font-size: 12px;
        }

        .btn-light:hover {
            color: #ffffff;
            background-color: #F44336;
            border-color: #F44336;
        }

        .btn-apply {
            font-size: 11px;
        }

        .empty {
            margin: 20px auto;
            display: block;
            width: 600px;
        }
        @media only screen and (max-width:784px) {
            .empty{
                width: 320px;
            }
        }
    </style>
</head>

<body>
    <?php
    // include "comp/config.php";
    include "comp/nav.php";
    $id = $_COOKIE['id'];
    $total = 0;

    ?>

    <?php
    $sql = "SELECT * FROM `cart` WHERE id=$id";
    $result1 = mysqli_query($link, $sql);

    ?>
    <div class="container-fluid mt-5">
        <div class="row">
            <aside class="col-lg-9">
                <div class="card">
                    <div class="table-responsive">
                        <?php if (mysqli_num_rows($result1) > 0) {
                        ?>
                            <table class="table table-borderless table-shopping-cart">
                                <thead class="text-muted">
                                    <tr class="small text-uppercase">
                                        <th scope="col">Product</th>
                                        <th scope="col" width="120">Quantity</th>
                                        <th scope="col" width="120">Price</th>
                                        <th scope="col" class="text-right d-none d-md-block" width="200"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                        $pid = $row1['pid'];
                                        $sql = "SELECT * FROM product WHERE pid=$pid";
                                        $result = mysqli_query($link, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $total += $row1['qty'] * $row['price'];
                                    ?>
                                        <tr>
                                            <td>
                                                <figure class="itemside align-items-center">
                                                    <div class="aside"><img src="<?= $row['photo'] ?>" class="img-sm"></div>
                                                    <figcaption class="info"> <a href="product.php?id=<?= $row['pid'] ?>" class="title text-dark" data-abc="true"><?= $row['name'] ?></a>
                                                        <p class="text-muted small">SIZE: L <br> Brand: <?= $row['brand'] ?></p>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>
                                                <span><?= $row1['qty'] ?></span>
                                            </td>
                                            <td>
                                                <div class="price-wrap"> <var class="price">₹<?= $row['price'] ?></var> </div>
                                                <div class="d-inline d-md-none">
                                                    <a href="remove_to_cart.php?cid=<?= $row1['cid'] ?>&pid=<?= $row['pid'] ?>" class="btn btn-light" data-abc="true"> Remove</a>
                                                </div>
                                            </td>
                                            <td class="text-right d-none d-md-block"> <a href="remove_to_cart.php?cid=<?= $row1['cid'] ?>&pid=<?= $row['pid'] ?>" class="btn btn-light" data-abc="true"> Remove</a> </td>
                                        </tr>
                                <?php  }
                                } else {
                                    $d = "Please Add Something in the Cart";
                                    echo '<img src="assets/bg-cart.png" class="empty"  alt="Empty Cart">';
                                } ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </aside>
            <aside class="col-lg-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="cart.php" method="POST">
                            <div class="form-group"> <label>Have coupon?</label>
                                <div class="input-group"> <input type="text" class="form-control coupon" name="code" placeholder="Coupon code"> <span class="input-group-append"> <button name="apply" class="btn btn-primary btn-lg btn-apply coupon">Apply</button> </span> </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Total price:</dt>
                            <dd class="text-right ml-3">&nbsp; ₹ <?= $total ?></dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Discount:</dt>
                            <dd class="text-right text-success ml-3">&nbsp;- ₹ <?= $total * $dis ?> ( <?= $dis * 100 ?> % )</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right text-dark b ml-3"><strong>&nbsp; ₹ <?php echo $total * (1 - $dis); ?></strong></dd>
                        </dl>
                        <hr>
                        <?php if (!isset($d)) { ?>
                            <a href="checkout.php?dis=<?=$dis?>" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Make Purchase </a>
                        <?php } else {
                        ?>
                            <button onclick="alert('<?= $d ?>')" class="btn btn-out btn-primary btn-square btn-main"> Make Purchase </button>

                        <?php
                        } ?>
                        <a href="index.php" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>

                    </div>
                </div>
            </aside>
        </div>
    </div>

</body>

</html>