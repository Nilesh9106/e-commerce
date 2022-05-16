<?php
include "auth.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cid = $_POST['cid'];
    $pid = $_POST['pid'];
    $id = $_COOKIE['id'];
    include "comp/config.php";
    $sql = "DELETE FROM `cart` WHERE `cid` = $cid";
    if (mysqli_query($link, $sql)) {
        header("Location: product.php?id=$pid");
    } else {
        header("Location: index.php");
    }
} else {
    $cid = $_GET['cid'];
    $pid = $_GET['pid'];
    $id = $_COOKIE['id'];
    include "comp/config.php";
    $sql = "DELETE FROM `cart` WHERE `cid` = $cid";
    if (mysqli_query($link, $sql)) {
        header("Location: cart.php");
    } else {
        header("Location: index.php");
    }
}
