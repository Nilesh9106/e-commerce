<?php
include "comp/config.php";
include "auth.php";
$id = $_COOKIE['id'];
$sql = "SELECT * FROM cart WHERE id=$id";
$result = $link->query($sql);
$orders = array();
$dis = $_GET['dis'] ?? 0.1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otype = $_POST['radio'];
    $address = $_POST['address'];
    if ($_POST['address2'] != "") {
        $address = $_POST['address2'] . " , " . $address;
    }
    while ($row = $result->fetch_assoc()) {
        $pid = $row['pid'];
        $qty = $row['qty'];
        $cid = $row['cid'];
        $sql = "INSERT INTO orders(pid,qty,ordertype,address,id,status,discount) VALUES ($pid,$qty,'$otype','$address',$id,'Dispatched',$dis)";
        $r = $link->query($sql);
        if ($r) {
            $link->query("DELETE FROM `cart` WHERE cid=$cid");
            $link->query("UPDATE product SET max_qty=max_qty-$qty WHERE pid=$pid");
        }
        $oid = $link->insert_id;
        array_push($orders, $oid);
    }
    $mess = "Orders Added Successfully :)";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
    <?php include "comp/link.php" ?>
    <style>
        tbody {
            font-size: 17px;

        }

        .empty {
            width: 450px;
            margin: 20px auto;

        }

        @media only screen and (max-width:784px) {
            tbody {
                font-size: 11px;
            }

            .empty {
                width: 300px;
            }
        }
    </style>
</head>

<body>
    <?php include "comp/nav.php";
    $re = $link->query("SELECT * FROM users WHERE id=$id");
    $users = $re->fetch_assoc();
    if ($users['is_admin'] == 1) {
    ?>
        <div class="p-md-5 mx-md-5 p-3 d-flex flex-column justify-content-center">
            <?php
            $sql = "SELECT * FROM orders";
            $result = $link->query($sql);
            if ($result->num_rows == 0) {
                echo '<img src="assets/empty-cart.png"  class="empty" alt="emty cart">';
            } else {
            ?>

                <table class="table table-hover " style="overflow: scroll;">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Product</th>
                            <th scope="col">Time</th>
                            <th scope="col">Details</th>
                            <th scope="col">username</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <?php $pid = $row['pid'];
                                $r = $link->query("SELECT * FROM product WHERE pid=$pid");
                                $row1 = $r->fetch_assoc();
                                ?>
                                <th scope="row"><?= $row['oid'] ?></th>
                                <td><?= $row1['name'] ?></td>
                                <td><?= $row['time'] ?></td>
                                <td><a class="btn-sm btn-primary text-decoration-none" href="order_details.php?r=<?= $row['oid'] ?>">Details</a></td>
                                <?php
                                $ouid = $row['id'];
                                $res = $link->query("SELECT * FROM users WHERE id=$ouid");
                                $user = $res->fetch_assoc();
                                $username = $user['username'];
                                ?>
                                <td><?= $username ?></td>
                            </tr>
                    <?php }
                    } ?>
                    </tbody>
                </table>
        </div>
    <?php
    } else {
    ?>
        <?php if (isset($mess)) { ?>
            <div class="alert alert-success mx-3 my-1 alert-dismissible fade show" role="alert">
                <?= $mess ?>
                <button data-bs-dismiss="alert" aria-label="Close" class="btn-close"></button>
            </div>
        <?php } ?>
        <div class="p-md-5 mx-md-5 p-3 d-flex flex-column justify-content-center">
            <?php
            $sql = "SELECT * FROM orders WHERE id=$id";
            $result = $link->query($sql);
            if ($result->num_rows == 0) {
                echo '<img src="assets/empty-cart.png"  style="width: 450px; margin: 20px auto;" alt="emty cart">';
            } else {
            ?>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Product</th>
                            <th scope="col">Time</th>
                            <th scope="col">Details</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <?php $pid = $row['pid'];
                                $r = $link->query("SELECT * FROM product WHERE pid=$pid");
                                $row1 = $r->fetch_assoc();
                                ?>
                                <th scope="row"><?= $row['oid'] ?></th>
                                <td><?= $row1['name'] ?></td>
                                <td><?= $row['time'] ?></td>
                                <td><a class="btn-sm btn-primary text-decoration-none" href="order_details.php?r=<?= $row['oid'] ?>">Details</a></td>
                                <td><?= $row['status'] ?></td>
                            </tr>
                    <?php }
                    } ?>
                    </tbody>
                </table>
        </div>
    <?php } ?>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>
