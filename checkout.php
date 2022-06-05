<?php
include "comp/config.php";
$check = true;
$id = $_COOKIE['id'];


$r=$link->query("SELECT * FROM users WHERE id=$id");
$u=$r->fetch_assoc();
$username=$u['username'];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
    <?php include "comp/link.php";

    ?>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        @media (max-width: 768px) {
            
            div.invoice{
                padding: 5px !important;
            }
        }

    </style>

</head>

<body>
    <?php include "comp/nav.php";?>
        <div class="container">
            <main>
                <div class="py-5 text-center">
                    <!-- <img class="d-block mx-auto mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
                    <h2>Checkout form</h2>
                </div>
                <?php
                $sql = "SELECT * FROM cart WHERE id=$id";
                $result = $link->query($sql);
                $total = 0;
                ?>
                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Your cart</span>
                            <span class="badge bg-primary rounded-pill"><?= $result->num_rows ?></span>
                        </h4>
                        <ul class="list-group mb-3">
                            <?php while ($row = $result->fetch_assoc()) {
                                $pid = $row['pid'];
                                $sql = "SELECT * FROM product WHERE pid=$pid";
                                $result1 = $link->query($sql);
                                $row1 = $result1->fetch_assoc();
                                $total = $total + $row1['price'] * $row['qty'];
                            ?>
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0"><?= $row1['name'] ?></h6>
                                        <small class="text-muted"><?= $row1['brand'] ?></small>
                                    </div>
                                    <span class="text-muted">₹ <?= $row1['price']  ?>✕<?=$row['qty']?></span>
                                </li>
                            <?php } ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (₹)</span>
                                <strong>₹ <?= $total ?></strong>
                            </li>
                        </ul>
                    </div>

                    <?php
                    $sql = "SELECT * FROM users WHERE id=$id";
                    $result = $link->query($sql);
                    $row = $result->fetch_assoc();
                    $email = $row['email'];
                    $a = $row['address'];
                    $p = explode(' ', $a);
                    $city = $p[0];
                    $state = $p[1];
                    $address = $city . ' , ' . $state;
                    $pin = $row['pincode'];
                    ?>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Billing address</h4>
                        <form class="needs-validation" action="orders.php" method="POST" onsubmit="confirm('Do you really want to purchase products?')" novalidate>
                            <div class="row g-3">




                                <div class="col-12">
                                    <label for="email" class="form-label">Email </label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?? '' ?>" placeholder="you@example.com">
                                    <div class="invalid-feedback">
                                        Please enter a valid email address for shipping updates.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $address ?? '' ?>" placeholder="1234 Main St" required>
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
                                    <input type="text" class="form-control" name="address2" id="address2" placeholder="Apartment or suite">
                                </div>

                                <div class="col-md-4">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" value="<?php echo $city ?? '' ?>" id="city" placeholder="City">

                                    <div class="invalid-feedback">
                                        Please select a valid City.
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" name="state" class="form-control" value="<?php echo $state ?? '' ?>" id="state" placeholder="State">

                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <label for="zip" class="form-label">Pincode</label>
                                    <input type="text" class="form-control" name="pincode" id="zip" value="<?php echo $pin ?? '' ?>" placeholder="Pincode" required>
                                    <div class="invalid-feedback">
                                        Pincode code required.
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">
                            <h4 class="mb-3">Payment</h4>

                            <div class="form-check">
                                <input type="radio" name="radio" class="form-check-input" value="COD" id="same-address" checked>
                                <label class="form-check-label" for="same-address">Cash on Delivery</label>
                            </div>

                            <div class="form-check ">
                                <input type="radio" disabled name="radio" class="form-check-input" value="online" id="save-info">
                                <label class="form-check-label" for="save-info">Online Payment(Currently unavailable)</label>
                            </div>

                            <!-- <div class="my-3 d-none">
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                                <label class="form-check-label" for="credit">Credit card</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="debit">Debit card</label>
                            </div>
                            <div class="form-check">
                                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="paypal">PayPal</label>
                            </div>
                        </div>

                        <div class="row gy-3 d-none">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div> -->

                            <hr class="my-4">
                            
                            <button class="w-100 btn btn-primary btn-lg" name="checkout" type="submit">checkout</button>
                        </form>
                    </div>
                </div>
            </main>


        </div>
    
</body>

</html>