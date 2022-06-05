<?php 
include "comp/config.php";
if(isset($_GET['r'])){
    $oid=$_GET['r'];
}else{
    header("Location: index.php?mess=you can go to this page directly");
}

$res=$link->query("SELECT * FROM orders WHERE oid=$oid");
$row=$res->fetch_assoc();
$qty=$row['qty'];
$pid=$row['pid'];

$sql="DELETE FROM orders WHERE oid=$oid";
$r=$link->query($sql);

if($r){
    $link->query("UPDATE product SET max_qty=max_qty+$qty WHERE pid=$pid");
    header("Location: orders.php");
}else{
    header("Location: order_details.php?r=".$oid);
}

?>