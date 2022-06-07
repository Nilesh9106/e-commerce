<?php
include "comp/config.php";

if (isset($_GET['r'])) {
    $oid = $_GET['r'];
} else {
    header("Location: index.php");
}
$r = $link->query("SELECT * FROM orders WHERE oid = $oid");
$order = $r->fetch_array();
$pid = $order['pid'];
$id = $order['id'];
$dis = $order['discount'];
$r = $link->query("SELECT * FROM product WHERE pid =$pid");
$product = $r->fetch_assoc();
$r = $link->query("SELECT * FROM users WHERE id=$id");
$user = $r->fetch_array();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['name'] ?></title>
    <?php include "comp/link.php" ?>
</head>

<body>
    <?php include "comp/nav.php" ?>
    <div class="card" id="div">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-12">
                        <span style="color: #7e8d9f;font-size: 20px;">Invoice &gt;&gt; <strong>ID: #<?= $order['oid'] ?></strong></span>
                        <?php if ($order['status'] != 'placed') { ?>
                            <form action="cancel_order.php?r=<?= $oid ?>" method="POST" onsubmit="return foo()">
                                <button class="btn btn-danger btn-sm float-end" type="submit" id="invoice">Cancel Order</button>
                            </form>
                        <?php } ?>

                        <button class="btn btn-dark btn-sm float-end" id="invoice" onclick="fun()">Print Invoice</button>
                    </div>
                </div>
                <div class="container">
                    <div class="col-md-12 ">
                        <div class="text-center ">
                            <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i>
                            <p class="pt-2">Company Name</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted">To: <span style="color:#8f8061 ;"><?= $user['username'] ?></span></li>
                                <li class="text-muted"><?= $order['address'] ?></li>
                                <li class="text-muted"><i class="fas fa-phone mx-2 d-md-inline d-none"></i><?= $user['email'] ?></li>
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="fw-bold">ID:</span>#<?= $order['oid'] ?></li>
                                <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="fw-bold">Creation Date: </span><?= $order['time'] ?></li>
                                <li class="text-muted"><i class="fas fa-circle text-primary"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                                        <?= $order['status'] ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row my-2 mx-1 justify-content-center">
                        <div class="col-md-2 mb-4 mb-md-0">
                            <div class="
                        bg-image
                        ripple
                        rounded-5
                        mb-4
                        overflow-hidden
                        d-block
                        " data-ripple-color="light">
                                <img src="<?= $product['photo'] ?>" height="100px" alt="Elegant shoes and shirt" />
                                <a href="#!">
                                    <div class="hover-overlay">
                                        <div class="mask" style="background-color: hsla(0, 0%, 98.4%, 0.2)"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-7 col-6 mb-4 mb-md-0">
                            <p class="fw-bold"><?= $product['name'] ?></p>
                            <p class="mb-1">
                                <span class="text-muted me-2">By:</span><span><?= $product['brand'] ?></span>
                            </p>
                            <p>
                                <span class="text-muted me-2">Qty:</span><span><?= $order['qty'] ?></span>
                            </p>
                        </div>
                        <div class="col-md-3 col-6 mb-4 mb-md-0">
                            <h5 class="mb-2">
                                <span class="align-middle">₹ <?= ($product['price']) ?> ✕ <?= $order['qty'] ?></span>
                            </h5>
                            <p class="text-danger"><small>You save <?=$dis*100?>%</small></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3"><?= $product['description'] ?></p>
                        </div>
                        <div class="col-xl-3">
                            <ul class="list-unstyled">
                                <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>₹ <?= ($product['price'] * $order['qty']) ?></li>
                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Shipping</span>₹ 999</li>
                                <li class="text-muted ms-3 mt-2"><span class="text-success me-4">Discount</span >-<?=$dis*100?> %</li>
                            </ul>
                            <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span>
                            <span style="font-size: 18px; " class="text-decoration-line-through">₹ <?php echo ($product['price'] * $order['qty'] + 999 ); ?></span>
                            <span style="font-size: 22px; color:green;">₹ <?php echo ($product['price'] * $order['qty'] + 999 - ($product['price']*$order['qty']*$dis)); ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function fun() {
            document.getElementById('navbar').style.display = 'none';
            document.getElementById('invoice').style.display = 'none';
            window.print();
            document.getElementById('navbar').style.display = 'block';
            document.getElementById('invoice').style.display = 'block';
        }

        function foo() {
            if (confirm('ere you sure to cancel the order')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>